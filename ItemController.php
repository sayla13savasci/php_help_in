<?php

namespace App\Http\Controllers\Stationery;

use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Services\PayUService\Exception;
use mysql_xdevapi\Table;


class ItemController extends Controller
{
    public function index(){
        $catData = DB::select("SELECT * FROM MIS.IT_CATEGORY");
        return view('stationery.itemcat', ['catData' => $catData]);
    }
    public function itemTypes(){
        $types = DB::select("SELECT DISTINCT(IT_NAME) TYPE,IT_ID  FROM MIS.IT_ITEM_TYPE_MASTER");
        return view('stationery.itemTypes', ['types'=>$types]);
    }
    public function getItems(){
        $catData = DB::select("SELECT * FROM MIS.IT_CATEGORY");
        $types = DB::select("SELECT DISTINCT(IT_NAME) TYPE,IT_ID  FROM MIS.IT_ITEM_TYPE_MASTER");
        return view('stationery.items', ['types'=>$types,'cats'=>$catData]);
    }
    public function getCategory(Request $request){
        $catData = DB::select("SELECT * FROM MIS.IT_CATEGORY
        WHERE ICAT_NO = decode ('$request->cat_no','All',ICAT_NO,'$request->cat_no')");
        return response()->json($catData);
    }
    public function getISTnames(Request $request){
        $istData = DB::select("SELECT * FROM MIS.IT_ITEM_TYPE_MASTER
        WHERE IT_ID = decode ('$request->it_id','All',IT_ID,'$request->it_id')");
        return response()->json($istData);
    }
    public function getItemNames(Request $request){
        $it_id = $request->it_id;
        $ist_id = $request->ist_id;
        $icat_no = $request->icat_no;

        $itemData = DB::select("SELECT * FROM MIS.IT_ITEM_MASTER
        WHERE IT_ID = decode ('$it_id','All',IT_ID,'$it_id') AND 
              IST_ID = decode ('$ist_id','All',IST_ID,'$ist_id') AND 
              ICAT_NO = decode ('$icat_no','All',ICAT_NO,'$icat_no')
        ");
        return response()->json($itemData);
    }
    public function getTypeSubtypeData(Request $request){
        $istData = DB::select("SELECT * FROM MIS.IT_ITEM_TYPE_MASTER
        WHERE IT_ID = decode ('$request->it_id','All',IT_ID,'$request->it_id') AND IST_ID = decode ('$request->ist_id','All',IST_ID,'$request->ist_id')");
        return response()->json($istData);
    }
    public function getItemReport(Request $request){
        $it_id = $request->it_id;
        $ist_id = $request->ist_id;
        $icat_no = $request->icat_no;
        $item_id = $request->item_id;

        $itemData = DB::select("SELECT * FROM MIS.IT_ITEM_MASTER
        WHERE IT_ID = decode ('$it_id','All',IT_ID,'$it_id') AND 
              IST_ID = decode ('$ist_id','All',IST_ID,'$ist_id') AND 
              ICAT_NO = decode ('$icat_no','All',ICAT_NO,'$icat_no') AND
              ITEM_ID = decode ('$item_id','All',ITEM_ID,'$item_id')
        ");
        return response()->json($itemData);
    }

    public function editICategory(Request $request){
        $uid = Auth::user()->user_id;
        $icat_no = $request->icat_no;
        $icat_name = $request->icat_name;
        $icat_id = $request->icat_id;
        $date = Carbon::now()->format('Y-m-d H:m:s');
        if($icat_no != "" && $icat_name != "" && $icat_id != ""){
            $result =  DB::UPDATE("
                        UPDATE MIS.IT_CATEGORY
                        SET ICAT_NAME = '$icat_name',
                            UPDATE_USER = '$uid',
                            UPDATE_DATE = '$date'
                        WHERE ICAT_NO = '$icat_no'");
            return response()->json(['response'=> $result]);
        }else{
            return response()->json(['response'=> 2]);
        }
    }
    public function editItemData(Request $request){
        $uid = Auth::user()->user_id;
        $edit_item_tbl_id = $request->edit_item_tbl_id;
        $edit_item_name = $request->edit_item_name;
        $edit_gl = $request->edit_gl;
        $date = Carbon::now()->format('Y-m-d H:m:s');
        if($edit_item_tbl_id != "" && $edit_item_name != ""){
            $result =  DB::UPDATE("
                        UPDATE MIS.IT_ITEM_MASTER
                        SET ITEM_NAME = '$edit_item_name',
                            GL = '$edit_gl',
                            UPDATE_USER = '$uid',
                            UPDATE_DATE = '$date'
                        WHERE ID = '$edit_item_tbl_id'");
            return response()->json(['response'=> $result]);
        }else{
            return response()->json(['response'=> 2]);
        }
    }
    public function createItype(Request $request){
        $uid = Auth::user()->user_id;
        $itype_name = $request->itype_name;
        $create_istID = $request->create_istID;
        $create_istName = $request->create_istName;
        $create_gl = $request->create_gl;
        $date = Carbon::now()->format('Y-m-d H:m:s');

        $data = DB::select("SELECT MAX(SUBSTR( IT_ID, 4 )) max_id FROM MIS.IT_ITEM_TYPE_MASTER");
        $max_id = $data[0]->max_id;

        if($max_id != ""){
            $max_id++;
            $new_it_no = "IT-".$max_id;
        }else{
            $new_it_no = "IT-1";
        }
        if($itype_name != ""){
            $result =  DB::insert('insert into MIS.IT_ITEM_TYPE_MASTER ( IT_ID, IT_NAME, IST_ID, IST_NAME, GL, CREATE_DATE, CREATE_USER )
                               values (?,?,?,?,?,?,?)',[$new_it_no, $itype_name, $create_istID, $create_istName, $create_gl, $date, $uid]);
            return response()->json(['response'=> $result]);
        }else{
            return response()->json(['response'=> 2]);
        }
    }
    public function createItem(Request $request){
        $uid = Auth::user()->user_id;
        $itype_id = $request->itype_id;
        $itype_name = $request->itype_name;
        $istID = $request->istID;
        $istName = $request->istName;
        $icatNo = $request->icatNo;
        $icatName = $request->icatName;
        $itemName = $request->itemName;
        $gl = $request->gl;
        $date = Carbon::now()->format('Y-m-d H:m:s');

        $data = DB::select("SELECT MAX(SUBSTR( ITEM_ID, 5 )) max_id FROM MIS.IT_ITEM_MASTER");
        $max_id = $data[0]->max_id;

        if($max_id != ""){
            $max_id++;
            $new_item_id = "ITM-".$max_id;
        }else{
            $new_item_id = "ITM-1";
        }
        if($itype_name != ""){
            $result =  DB::insert('insert into MIS.IT_ITEM_MASTER ( IT_ID, IT_NAME, IST_ID, IST_NAME, ICAT_NO, ICAT_NAME, ITEM_ID, ITEM_NAME, GL, CREATE_DATE, CREATE_USER )
                               values (?,?,?,?,?,?,?,?,?,?,?)',[$itype_id, $itype_name, $istID, $istName, $icatNo,
                $icatName, $new_item_id, $itemName,$gl, $date, $uid]);
            return response()->json(['response'=> $result]);
        }else{
            return response()->json(['response'=> 2]);
        }
    }
    public function createISubtype(Request $request){
        $uid = Auth::user()->user_id;
        $create_oitID = $request->create_oitID;
        $create_oitName = $request->create_oitName;
        $create_oistID = $request->create_oistID;
        $create_oistName = $request->create_oistName;
        $create_ogl = $request->create_ogl;
        $date = Carbon::now()->format('Y-m-d H:m:s');

        if($create_oitID != "" || $create_oitName != "" || $create_oistName != ""){

            if($create_oitName == "STATIONARY"){
                $data = DB::select("SELECT MAX(IST_ID) max_id FROM MIS.IT_ITEM_TYPE_MASTER WHERE IT_NAME = 'STATIONARY'");
                $max_id = $data[0]->max_id;

                if($max_id != ""){
                    $max_id++;
                    $new_ist_no = $max_id;
                }else{
                    $new_ist_no = 1;
                }
                $result =  DB::insert('insert into MIS.IT_ITEM_TYPE_MASTER ( IT_ID, IT_NAME, IST_ID, IST_NAME, GL, CREATE_DATE, CREATE_USER )
                               values (?,?,?,?,?,?,?)',[$create_oitID, $create_oitName, $new_ist_no, $create_oistName, $create_ogl, $date, $uid]);
            }else{
                $result =  DB::insert('insert into MIS.IT_ITEM_TYPE_MASTER ( IT_ID, IT_NAME, IST_ID, IST_NAME, GL, CREATE_DATE, CREATE_USER )
                               values (?,?,?,?,?,?,?)',[$create_oitID, $create_oitName, $create_oistID, $create_oistName, $create_ogl, $date, $uid]);
            }
            return response()->json(['response'=> $result]);
        }else{
            return response()->json(['response'=> 2]);
        }
    }
    public function editTypeSubtypeData(Request $request){
        $uid = Auth::user()->user_id;
        $edit_it_ID = $request->edit_it_ID;
        $edit_ist_id = $request->edit_ist_id;
        $edit_ist_name = $request->edit_ist_name;
        $edit_gl = $request->edit_gl;
        $edit_it_name = $request->edit_it_name;
        $row_ID = $request->row_ID;
        $date = Carbon::now()->format('Y-m-d H:m:s');

        if($edit_it_ID != "" && $edit_ist_id != "" && $edit_ist_name != "" && $edit_it_name != "" && $row_ID != ""){
            if($edit_it_name === "CAPEX"){
                $result =  DB::UPDATE("
                        UPDATE MIS.IT_ITEM_TYPE_MASTER
                        SET IST_NAME = '$edit_ist_name',
                            IST_ID = '$edit_ist_id',
                            GL = '$edit_gl',
                            UPDATE_USER = '$uid',
                            UPDATE_DATE = '$date'
                        WHERE ID = '$row_ID'");
            }else{
                $result =  DB::UPDATE("
                        UPDATE MIS.IT_ITEM_TYPE_MASTER
                        SET IST_NAME = '$edit_ist_name',
                            GL = '$edit_gl',
                            UPDATE_USER = '$uid',
                            UPDATE_DATE = '$date'
                        WHERE ID = '$row_ID' AND IT_ID = '$edit_it_ID' AND IST_ID = '$edit_ist_id'");
            }

            return response()->json(['response'=> $result]);
        }else{
            return response()->json(['response'=> 2]);
        }
    }
    public function deleteICategory(Request $request){
        $icat_no = $request->icat_no;
        $icat_name = $request->icat_name;

        if($icat_no != "" && $icat_name != ""){
            $result =  DB::DELETE('DELETE FROM MIS.IT_CATEGORY WHERE ICAT_NO = ? AND ICAT_NAME = ?',[$icat_no,$icat_name]);
            return response()->json(['result'=> $result]);
        }else{
            return response()->json(['result'=> 2]);
        }
    }
    public function deleteItem(Request $request){
        $id = $request->id;

        if($id != ""){
            $result =  DB::DELETE('DELETE FROM MIS.IT_ITEM_MASTER WHERE ID = ?',[$id]);
            return response()->json(['result'=> $result]);
        }else{
            return response()->json(['result'=> 2]);
        }
    }
    public function deleteItypeSubtype(Request $request){
        $id = $request->id;
        if($id != ""){
            $result =  DB::DELETE('DELETE FROM MIS.IT_ITEM_TYPE_MASTER WHERE ID = ?',[$id]);
            return response()->json(['result'=> $result]);
        }else{
            return response()->json(['result'=> 2]);
        }
    }
    public function createIcategory(Request $request){
        $uid = Auth::user()->user_id;
        $icat_name = $request->icat_name;
        $date = Carbon::now()->format('Y-m-d H:m:s');
        $data = DB::select("SELECT MAX(SUBSTR( ICAT_NO, 5 )) max_id FROM MIS.IT_CATEGORY");
        $max_id = $data[0]->max_id;

        if($max_id != ""){
            $max_id++;
            $new_icat_no = "ICT-".$max_id;
        }else{
            $new_icat_no = "ICT-1";
        }
        if($icat_name != ""){
            $result =  DB::insert('insert into MIS.IT_CATEGORY ( ICAT_NO, ICAT_NAME, CREATE_DATE, CREATE_USER )
                               values (?,?,?,?)',[$new_icat_no, $icat_name, $date, $uid]);
            return response()->json(['response'=> $result]);
        }else{
            return response()->json(['response'=> 2]);
        }
    }


    /*Issue Item sayla starts*/
   /* sayla starts*/
    public function issueItem(){

        $item_name = DB::select("SELECT DISTINCT ITEM_NAME,ITEM_ID,GL FROM MIS.IT_ITEM_MASTER");
       // dd($item_name);
        return view('stationery.issue_item', ['item_name'=>$item_name]);

    }

    /*Display Issue Item*/
    public function displayIssueItem(Request $request){

        try {

            $item_details = DB::select("SELECT DISTINCT ITEM_NAME,ITEM_ID,GL,COST_CENTER,PR_NUMBER,UNIT  FROM MIS.IT_OPENING_STOCK where ITEM_ID='$request->item_id_search'");

            if($item_details){
                return response()->json($item_details);
            }else{
                return response()->json('error');
            }

        }
        catch (customException $e) {
            echo $e->errorMessage();
        }


    }

   /* Create Issue*/
    public function createIssue(Request $request){

        $uid= Auth::user()->user_id;
        $plant_id = DB::select("Select PLANT_ID from MIS.EMP_HIS_INFO where EMP_ID='$uid'");
        $plant_id= $plant_id[0]->plant_id;

        $data = DB::select("SELECT MAX(SUBSTR( IR_NO, 8 )) max_id FROM  MIS.IT_ITEM_REQUISITION_M");
        $max_id = $data[0]->max_id;
        $max_idd = (int)$max_id;

        $date = Carbon::now()->format('Y-m-d H:m:s');

        if($max_id!=''){
            $max_idd++;
            $new_ir_no = "IR".$plant_id.'-'.$max_idd;
        }else{
            $new_ir_no = "IR".$plant_id.'-1';
        }

        $issueItemData = json_decode($request->issueItemData, true);

        for($i=0;$i<sizeof($issueItemData);$i++){
               $issueItemData[$i]['IR_NO']= $new_ir_no;
               $issueItemData[$i]['CREATE_USER']= Auth::user()->user_id;
               $issueItemData[$i]['CREATE_DATE']= $date;
               $issueItemData[$i]['RECEIVE_DATE']= '';
               $issueItemData[$i]['APPROVED_DATE']= '';

        }


        $issueItemMaster['IR_NO']= $new_ir_no;
        $issueItemMaster['PR_DATE']= $date;
        $issueItemMaster['COMPANY_CODE']= '2000';
        $issueItemMaster['PLANT_ID']= $plant_id;
        $issueItemMaster['CREATE_USER']= Auth::user()->user_id;
        $issueItemMaster['CREATE_DATE']= $date;
        $issueItemMaster['RECEIVE_DATE']= '';
        $issueItemMaster['APPROVED_DATE']= '';

        $status = DB::table('MIS.IT_ITEM_REQUISITION_M')->insert($issueItemMaster);
        if($status){
                for($i=0;$i<sizeof($issueItemData);$i++){
                    $issueItemData[$i]['IR_NO']= $new_ir_no;
                    $issueItemData[$i]['CREATE_USER']= Auth::user()->user_id;
                    $issueItemData[$i]['CREATE_DATE']= $date;
                    $issueItemData[$i]['RECEIVE_DATE']= '';
                    $issueItemData[$i]['APPROVED_DATE']= '';

                }
                $status = DB::table('MIS.IT_ITEM_REQUISITION_D')->insert($issueItemData);
                if($status){
                    return response()->json("success");
                }else{
                    return response()->json("error");
                }
            }else{
            return response()->json("error");
        }

    }

    /*All Issue List*/
    public function showMyIssue(){
        $uid = Auth::user()->user_id;

        $issue_year = DB::select(" select distinct EXTRACT(YEAR FROM Create_date) leave_year from MIS.IT_ITEM_REQUISITION_M where  CREATE_USER='$uid' ");

        return view('stationery.display_my_issue', ['appData' => $issue_year]);
    }

    /*Get My Issus*/
    public function getMyIssues(Request $request){
        $user_id = Auth::user()->user_id;
        $req_year = $request->req_year;

        if($req_year=='all'){
            $issue_year = DB::select(" select ID,IR_NO,ITEM_ID,ITEM_NAME,GL,COST_CENTER,PR_QTY,APRV_QTY,UNIT,REMARKS,APRV_QTY,APPROVED_DATE from MIS.IT_ITEM_REQUISITION_D 
            where create_user = '$user_id' order by  IR_NO");

        }else{
            $issue_year = DB::select(" select ID,IR_NO,ITEM_ID,ITEM_NAME,GL,COST_CENTER,PR_QTY,APRV_QTY,UNIT,REMARKS,APRV_QTY,APPROVED_DATE from MIS.IT_ITEM_REQUISITION_D where 
            EXTRACT(YEAR FROM Create_date) = '$req_year' and create_user = '$user_id' order by  IR_NO");
        }

        return response()->json($issue_year);

    }

    /*Delete Issue*/
    public function deleteMyIssue(Request $request){

            $id = $request->id;
            $ir_no = $request->ir_no;

            if($id != ""){
                $result =  DB::DELETE('DELETE FROM MIS.IT_ITEM_REQUISITION_D WHERE ID = ?',[$id]);
                if($result){

                    $result =  DB::SELECT('select ir_no FROM MIS.IT_ITEM_REQUISITION_D WHERE IR_NO = ?',[$ir_no]);
                    if($result){
                        return response()->json(['result'=> 'true']);
                    }else{
                        $result =  DB::DELETE('DELETE FROM MIS.IT_ITEM_REQUISITION_M WHERE IR_NO = ?',[$ir_no]);
                        if($result){
                            return response()->json(['result'=> 'true']);
                        }else{
                            return response()->json(['result'=> 'false']);
                        }
                    }

                }else{
                    return response()->json(['result'=> 'false']);
                }

            }else{
                return response()->json(['result'=> 2]);
            }
    }

   /* Get Issued Item for Select Two*/
    public function getIssuedItem(){
        $user_id = Auth::user()->user_id;
        if(Auth::user()->user_id == 'IPLCDM1050'){
            $ir_no = DB::SELECT("Select distinct IR_NO from MIS.IT_ITEM_REQUISITION_D");
        }else{

            $ir_no = DB::SELECT("Select DISTINCT ir_no from  MIS.IT_ITEM_REQUISITION_D WHERE APPROVED_DATE IS NULL AND CREATE_USER ='$user_id'");

        }

        if($ir_no){
            return response()->json($ir_no);
        }else{
            return response()->json("error");
        }
    }

   /* Upodate Issue*/
    public function updateIssuedItem(Request $request){


        $table_id = $request->id;

        $decoded_data = json_decode($request->itemArray);


        $edit_ir_no = $decoded_data->edit_ir_no;
        $edit_item_id = $decoded_data->edit_item_id;
        $edit_item_name = $decoded_data->edit_item_name;
        $edit_gl = $decoded_data->edit_gl;
        $edit_cost_center = $decoded_data->edit_cost_center;
        $edit_pr_qty = $decoded_data->edit_pr_qty;
        $unit = $decoded_data->edit_unit;
        $remarks = $decoded_data->edit_remarks;


        $uid = Auth::user()->user_id;
        $date = Carbon::now()->format('Y-m-d H:m:s');


       // return response()->json("hhwllo update");


        if($edit_ir_no!=''){

            //return response()->json("hhwllo update");

            $result =  DB::UPDATE("
                        UPDATE MIS.IT_ITEM_REQUISITION_D
                        SET
                            ITEM_ID = '$edit_item_id',
                            ITEM_NAME = '$edit_item_name',
                            GL = '$edit_gl',
                            COST_CENTER = '$edit_cost_center',
                            PR_QTY = '$edit_pr_qty',
                            UNIT = '$unit',
                            REMARKS = '$remarks',
                             UPDATE_USER = '$uid',
                            UPDATE_DATE = '$date'
                        WHERE ID = '$table_id'");


            return response()->json(['result'=> "success"]);

        }else{

            return response()->json(['result'=> "error"]);

        }

    }

    /*Get issued item for datatable*/
    public function showIrdata(Request $request){
        $issuedItems= DB::SELECT("Select * from MIS.IT_ITEM_REQUISITION_D where ir_no = '$request->ir_no'");
        return response()->json(['issuedItems'=>$issuedItems]);

    }
    /*Issue Item sayla ends*/
    
    /*Item transfer starts*/
    public function transferItem(){
        $uid= Auth::user()->user_id;


        $item_name = DB::SELECT("SELECT DISTINCT ITEM_NAME,ITEM_ID,GL FROM MIS.IT_ITEM_MASTER");
        $transItems = DB::SELECT("SELECT DISTINCT a.ITR_NO FROM IT_ITEM_TRANSFER_RECEIVE_M a INNER JOIN IT_ITEM_TRANSFER_D b ON a.IT_NO = b.IT_NO  
                                INNER JOIN IT_ITEM_TRANSFER_RECEIVE_D c ON c.ITEM_ID = b.ITEM_ID
                                WHERE b.RECEIVE_DATE IS NOT NULL AND a.CREATE_USER = 'IPLCDM1050' AND b.UPDATE_USER = 'IPLCDM1050' AND b.id NOT IN (SELECT REF_ID FROM MIS.IT_ITEM_TRANSFER_D WHERE REF_ID IS NOT NULL)");
        return view('stationery.item_transfer', ['item_name'=>$item_name,'uid'=>$uid,'transItems'=>$transItems]);
    }

    public function getIt_no(Request $request){
        $itr_no = $request->itr_no;
        $data = DB::SELECT("SELECT a.IT_NO FROM IT_ITEM_TRANSFER_RECEIVE_M a INNER JOIN IT_ITEM_TRANSFER_D b ON a.IT_NO = b.IT_NO WHERE a.CREATE_USER = 'IPLCDM1050' AND a.ITR_NO = '$itr_no'");
        return response()->json($data);
    }

    public function getRecvedItemDetails(Request $request){
        $itr_no = $request->itr_no;
        $itemDetails = DB::SELECT("SELECT b.*,a.IT_NO,c.IT_NAME FROM IT_ITEM_TRANSFER_RECEIVE_M a INNER JOIN IT_ITEM_TRANSFER_RECEIVE_D b on a.ITR_NO = b.ITR_NO INNER JOIN IT_ITEM_MASTER c on b.ITEM_ID = c.ITEM_ID WHERE  a.ITR_NO = '$itr_no'");
        return response()->json(['itemDetails'=>$itemDetails]);
    }

    public function itemTransferbyCDM(Request $request){
        $uid = Auth::user()->user_id;
        $finalARr = $request->finalARr;
        $itr_no = $request->itr_no;
        $it_no = $request->it_no;
        $plantId = Auth::user()->plant_id;
        $date = Carbon::now()->format('Y-m-d H:m:s');
        $status = 0;

        for ($i = 0; $i < count($finalARr); $i++){
            if($finalARr[$i]['it_name'] == 'STATIONARY'){
                if($finalARr[$i]['gl'] != null && $finalARr[$i]['cc'] != null && $finalARr[$i]['tr'] != null){
                    $status = 1;
                }else{
                    $status = 0;
                }
            }else if($finalARr[$i]['it_name'] == 'CAPEX'){
                if($finalARr[$i]['cwip'] != null && $finalARr[$i]['main'] != null && $finalARr[$i]['tr'] != null){
                    $status = 1;
                }else{
                    $status = 0;
                }
            }
            if($status === 0){
                break;
            }
        }
        if($status === 0){
            return response()->json(['response'=>5]);
        }else{
            $data = DB::select("SELECT MAX(SUBSTR( IT_NO, 8 )) max_id FROM MIS.IT_ITEM_TRANSFER_M");
            $max_id = $data[0]->max_id;
            if($max_id != ""){
                $max_id++;
                $new_ID = "IT".$plantId."-".$max_id;
            }else{
                $new_ID = "IT".$plantId."-1";
            }

            $result =  DB::insert('insert into MIS.IT_ITEM_TRANSFER_M ( IT_NO, IT_DATE, COMPANY_CODE, PLANT_ID, CREATE_DATE, CREATE_USER )
                               values (?,?,?,?,?,?)',[$new_ID, $date,'1000',  $plantId, $date, $uid]);

            for ($i=0; $i<count($finalARr); $i++){

                $info = DB::SELECT("SELECT id FROM MIS.IT_ITEM_TRANSFER_D WHERE IT_NO='$it_no' AND ITEM_ID = '"
                    .$finalARr[$i]['item_id']."'");

                $result =  DB::insert('insert into MIS.IT_ITEM_TRANSFER_D ( IT_NO, ITEM_ID, ITEM_NAME, CWIP_ID, MAIN_ID, PO_NUMBER, PR_NUMBER, GL, COST_CENTER, TRANSFER_REASON, QTY, UNIT, REMARKS, CREATE_DATE, CREATE_USER, REF_ID )
                               values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$new_ID, $finalARr[$i]['item_id'],
                    $finalARr[$i]['item_name'],$finalARr[$i]['cwip'],$finalARr[$i]['main'],$finalARr[$i]['po'],
                    $finalARr[$i]['pr'],$finalARr[$i]['gl'],$finalARr[$i]['cc'],$finalARr[$i]['tr'],
                    $finalARr[$i]['qty'],$finalARr[$i]['unit'], $finalARr[$i]['remarks'],$date,$uid, $info[0]->id]);
            }
            return response()->json(['response'=>$result]);
        }
    }
    public function saveTransferItem(Request $request){
        $uid= Auth::user()->user_id;
        $plant_id= Auth::user()->plant_id;

        $data = DB::select("SELECT MAX(SUBSTR( IT_NO, 8 )) max_id FROM  MIS.IT_ITEM_TRANSFER_M");
        $max_id = $data[0]->max_id;
        $max_idd = (int)$max_id;

        $date = Carbon::now()->format('Y-m-d H:m:s');

        if($max_id!=''){
            $max_idd++;
            $new_ir_no = "IT".$plant_id.'-'.$max_idd;
        }else{
            $new_ir_no = "IT".$plant_id.'-1';
        }

        $transferItemMaster['IT_NO']= $new_ir_no;
        $transferItemMaster['IT_DATE']= $date;
        $transferItemMaster['COMPANY_CODE']= '1000';
        $transferItemMaster['PLANT_ID']= $plant_id;
        $transferItemMaster['CREATE_USER']= Auth::user()->user_id;
        $transferItemMaster['CREATE_DATE']= $date;
        $transferItemMaster['RECEIVE_DATE']= '';


        $status = DB::table('MIS.IT_ITEM_TRANSFER_M')->insert($transferItemMaster);

        $transferItemData = json_decode($request->transferItemData, true);

        if($status){
            for($i=0;$i<sizeof($transferItemData);$i++){

                $itemData = DB::SELECT("SELECT MAIN_ID, CWIP_ID, PO_NUMBER, PR_NUMBER, COST_CENTER FROM MIS.IT_OPENING_STOCK 
                                WHERE ITEM_ID = '".$transferItemData[$i]['item_id']."'");

                $transferItemData[$i]['IT_NO']= $new_ir_no;
                if(count($itemData) > 0){
                    $transferItemData[$i]['CWIP_ID']= $itemData[0]->cwip_id;
                    $transferItemData[$i]['MAIN_ID']= $itemData[0]->main_id;
                    $transferItemData[$i]['PO_NUMBER']= $itemData[0]->po_number;
                    $transferItemData[$i]['PR_NUMBER']= $itemData[0]->pr_number;
                    $transferItemData[$i]['COST_CENTER']= $itemData[0]->cost_center;
                }else{
                    $transferItemData[$i]['CWIP_ID']= '';
                    $transferItemData[$i]['MAIN_ID']= '';
                    $transferItemData[$i]['PO_NUMBER']= '';
                    $transferItemData[$i]['PR_NUMBER']= '';
                    $transferItemData[$i]['COST_CENTER']= '';
                }
                $transferItemData[$i]['CREATE_USER']= Auth::user()->user_id;
                $transferItemData[$i]['CREATE_DATE']= $date;
                $transferItemData[$i]['RECEIVE_DATE']= '';

            }
            $status = DB::table('MIS.IT_ITEM_TRANSFER_D')->insert($transferItemData);
            if($status){
                return response()->json("success");
            }else{
                return response()->json("error");
            }
        }else{
            return response()->json("error");
        }
    }

    public function getMyTransferedItem(){
        $uid= Auth::user()->user_id;
        $displayMyItems = DB::SELECT("SELECT DISTINCT IT_NO FROM MIS.IT_ITEM_TRANSFER_D WHERE CREATE_USER='$uid'");
        return response()->json($displayMyItems);

    }

    public function displayTransferedData(Request $request){
        $transferedData = DB::SELECT("select * FROM  MIS.IT_ITEM_TRANSFER_D where it_no='$request->it_no' ");
        return response()->json(['transferedData'=>$transferedData]);
    }

    public function updateTransferedItem(Request $request){
        $table_id = $request->id;

        $decoded_data = json_decode($request->itemArray);

        $edit_item_id = $decoded_data->edit_item_id;
        $edit_item_name = $decoded_data->edit_item_name;
        $edit_gl = $decoded_data->edit_gl;
        $edit_transfer_reason = $decoded_data->edit_transfer_reason;
        $edit_pr_qty = $decoded_data->edit_pr_qty;
        $edit_unit = $decoded_data->edit_unit;
        $edit_remarks = $decoded_data->edit_remarks;


        $uid = Auth::user()->user_id;
        $date = Carbon::now()->format('Y-m-d H:m:s');


        // return response()->json("hhwllo update");


        if($edit_item_id!=''){

            //return response()->json("hhwllo update");

            $result =  DB::UPDATE("
                        UPDATE MIS.IT_ITEM_TRANSFER_D 
                        SET
                            ITEM_ID = '$edit_item_id',
                            ITEM_NAME = '$edit_item_name',
                            GL = '$edit_gl',
                            TRANSFER_REASON = '$edit_transfer_reason',
                            QTY = '$edit_pr_qty',
                            UNIT = '$edit_unit',
                            REMARKS = '$edit_remarks',
                             UPDATE_USER = '$uid',
                            UPDATE_DATE = '$date'
                        WHERE ID = '$table_id'");


            return response()->json(['result'=> "success"]);

        }else{

            return response()->json(['result'=> "error"]);

        }


    }

    public function deleteTransferItem(Request $request){
        $id = $request->id;
        $it_no = $request->it_no;

        if($id != ""){
            $result =  DB::DELETE('DELETE FROM MIS.IT_ITEM_TRANSFER_D WHERE ID = ?',[$id]);
            if($result){

                $result =  DB::SELECT('select it_no FROM MIS.IT_ITEM_TRANSFER_D WHERE IT_NO = ?',[$it_no]);
                if($result){
                    return response()->json(['result'=> 'true']);
                }else{
                    $result =  DB::DELETE('DELETE FROM MIS.IT_ITEM_TRANSFER_M WHERE IT_NO = ?',[$it_no]);
                    if($result){
                        return response()->json(['result'=> 'true']);
                    }else{
                        return response()->json(['result'=> 'false']);
                    }
                }

            }else{
                return response()->json(['result'=> 'false']);
            }

        }else{
            return response()->json(['result'=> 2]);
        }

    }

    /*Item transfer ends*/

    /* CWIP to main id starts*/
    /*Display Chalan*/
    public function displayChalan(){

        $item_name = DB::select("SELECT DISTINCT ITEM_NAME,ITEM_ID,GL FROM MIS.IT_ITEM_MASTER");
        $suppliers = DB::select("SELECT DISTINCT NAME,CONTACT FROM MIS.IT_VENDOR_SUPPLIER where USER_TYPE='supplier'");
        return view('stationery.chalan_receive', ['item_name'=>$item_name,'supplier_name'=>$suppliers]);

    }
    /*Save Chalan*/
    public function saveReceivedChallan(Request $request){

        $uid= Auth::user()->user_id;
        $plant_id = DB::select("Select PLANT_ID from MIS.EMP_HIS_INFO where EMP_ID='$uid'");
        $plant_id= $plant_id[0]->plant_id;
        $date = Carbon::now()->format('Y-m-d H:m:s');


        $challanReceiveMasterData = $request->challanReceiveMaster;

        $challanReceiveMaster['PLANT_ID']= $plant_id;
        $challanReceiveMaster['CHALLAN_NO']= $challanReceiveMasterData['challan_no'];
        $challanReceiveMaster['SAP_PR']= $challanReceiveMasterData['sap_pr'];
        $challanReceiveMaster['SAP_PO']= $challanReceiveMasterData['sap_po'];
        $challanReceiveMaster['SUP_INVOICE_OR_CH_NO']= $challanReceiveMasterData['sup_invoice_or_ch_no'];
        $challanReceiveMaster['SUPPLIER_NAME']= $challanReceiveMasterData['supplier_name'];
        $challanReceiveMaster['REMARKS']= $challanReceiveMasterData['remarks'];
        $challanReceiveMaster['CREATE_USER']= Auth::user()->user_id;
        $challanReceiveMaster['UPDATE_USER']= Auth::user()->user_id;
        $challanReceiveMaster['CREATE_DATE']= $date;
        $challanReceiveMaster['UPDATE_DATE']= '';


        $status = DB::table('MIS.IT_CHALLAN_RECEIVE_M')->insert($challanReceiveMaster);

        $ChallanReceiveDataDetails = json_decode($request->challanReceiveDetails, true);

        //return response()->json($ChallanReceiveDataDetails[0]['product_serial']);

        if($status){
            for($i=0;$i<sizeof($ChallanReceiveDataDetails);$i++){
                $ChallanReceiveData[$i]['CHALLAN_NO']= $ChallanReceiveDataDetails[$i]['challan_no'];
                $ChallanReceiveData[$i]['ITEM_ID']= $ChallanReceiveDataDetails[$i]['item_id'];
                $ChallanReceiveData[$i]['ITEM_NAME']= $ChallanReceiveDataDetails[$i]['item_name'];
                $ChallanReceiveData[$i]['QTY']= $ChallanReceiveDataDetails[$i]['pr_qty'];
                $ChallanReceiveData[$i]['UNIT_PRICE']= $ChallanReceiveDataDetails[$i]['unit_price'];
                $ChallanReceiveData[$i]['TOTAL_PRICE']= $ChallanReceiveDataDetails[$i]['total_price'];
                $ChallanReceiveData[$i]['EXPIRE_DATE']= $ChallanReceiveDataDetails[$i]['expire_date'];
                $ChallanReceiveData[$i]['WARRENTY']= $ChallanReceiveDataDetails[$i]['warrenty'];
                $ChallanReceiveData[$i]['SAP_CWIP_ID']= $ChallanReceiveDataDetails[$i]['sap_cwip_id'];
                $ChallanReceiveData[$i]['SAP_GL']= $ChallanReceiveDataDetails[$i]['sap_gl'];
                $ChallanReceiveData[$i]['SAP_CC']= $ChallanReceiveDataDetails[$i]['sap_cc'];
                $ChallanReceiveData[$i]['PRODUCT_SERIAL']= $ChallanReceiveDataDetails[$i]['product_serial'];
                $ChallanReceiveData[$i]['CREATE_USER']= Auth::user()->user_id;
                $ChallanReceiveData[$i]['UPDATE_USER']= Auth::user()->user_id;
                $ChallanReceiveData[$i]['CREATE_DATE']= $date;
                $ChallanReceiveData[$i]['UPDATE_DATE']= '';

            }
            $status = DB::table('MIS.IT_CHALLAN_RECEIVE_D')->insert($ChallanReceiveData);
            if($status){
                return response()->json("success");
            }else{
                return response()->json("error");
            }
            return response()->json("success");

        }else{
            return response()->json("error");

        }

    }

    /*View CWIP to Main ID*/
    public function cwipIdToMainID(){
        $challan_id = DB::select("SELECT DISTINCT CHALLAN_NO FROM MIS.IT_CHALLAN_RECEIVE_M");

        $uid= Auth::user()->user_id;

        $plant_id = DB::select("Select PLANT_ID from MIS.EMP_HIS_INFO where EMP_ID='$uid'");
        $plant_id= $plant_id[0]->plant_id;

        return view('stationery.cwipIdToMAinId', ['challan_id'=>$challan_id,'exist_plant'=>$plant_id]);


    }

    /*Get All CWIP for Select Two*/
    public function getAllCwipNo(){
        $cwip_id = DB::select("Select distinct cwip_id from MIS.IT_UPGRADE_CWIPID_TO_MAINID");
        return response()->json($cwip_id);

    }

    /*Get CWIP including other id*/
    public function showCwipData(Request $request){

        $cwip_id = $request->cwip_id;

        $challan_id = DB::select("SELECT DISTINCT * FROM MIS.IT_UPGRADE_CWIPID_TO_MAINID where cwip_id= '$cwip_id'");
        return response()->json($challan_id);
    }

    public function saveCwipIdToMainID(Request $request){
        $uid = Auth::user()->user_id;

         $data = DB::select("SELECT MAX(AU_ID) au_id FROM  MIS.IT_UPGRADE_CWIPID_TO_MAINID");
         $date = Carbon::now()->format('Y-m-d H:m:s');

        if(!($data[0]->au_id)){
             $au_id = 1;
         }else{
             $au_id = $data[0]->au_id;
         }

         $cwipItemData = json_decode($request->cwipItemData,true);

        log::info($cwipItemData);

         for($i=0;$i<sizeof($cwipItemData);$i++){
            $cwipItemData[$i]['AU_ID']='1';
            $cwipItemData[$i]['COMPANY_CODE']= '1000';
            $cwipItemData[$i]['CREATE_USER']= $uid;
            $cwipItemData[$i]['UPDATE_USER']= '';
            $cwipItemData[$i]['CREATE_DATE']= $date;
            $cwipItemData[$i]['UPDATE_DATE']= '';

        }
         $status = DB::table('MIS.IT_UPGRADE_CWIPID_TO_MAINID')->insert($cwipItemData);
         if($status){
             return response()->json("success");
         }else{
             return response()->json("error");
         }


    }

    public function updateCwipIdToMainId(Request $request){

        $table_id = $request->id;

        $decoded_data = json_decode($request->itemArray);


        $edit_ist_id = $decoded_data->edit_ist_id;
        $edit_ist_name = $decoded_data->edit_ist_name;
        $edit_item_id = $decoded_data->edit_item_id;
        $edit_gr_qty = $decoded_data->edit_gr_qty;
        $edit_unit = $decoded_data->edit_unit;
        $edit_sap_pr = $decoded_data->edit_sap_pr;
        $edit_exist_plant = $decoded_data->edit_exist_plant;
        $edit_split_qty = $decoded_data->edit_split_qty;
        $edit_main_id = $decoded_data->edit_main_id;
        $edit_new_plant = $decoded_data->edit_new_plant;


        $uid = Auth::user()->user_id;
        $date = Carbon::now()->format('Y-m-d H:m:s');


        if($edit_ist_id!=''){

           // return response()->json($edit_new_plant);

            $result =  DB::UPDATE("
                        UPDATE MIS.IT_UPGRADE_CWIPID_TO_MAINID
                        SET
                            IST_ID = '$edit_ist_id',
                            IST_NAME = '$edit_ist_name',
                            ITEM_ID = '$edit_item_id',
                            GR_QTY = '$edit_gr_qty',
                            UNIT = '$edit_unit',
                            SAP_PR = '$edit_sap_pr',
                            EXIST_PLANT = '$edit_exist_plant',
                            SPLIT_QTY = '$edit_split_qty',
                            MAIN_ID = '$edit_main_id',
                            NEW_PLANT = '$edit_new_plant',
                             UPDATE_USER = '$uid',
                            UPDATE_DATE = '$date'
                        WHERE ID = '$table_id'");


            return response()->json(['result'=> "success"]);

        }else{

            return response()->json(['result'=> "error"]);

        }


    }

    public function approveQtyItem(Request $request){
        $table_id = $request->id;
        $approve_qty = $request->appprove_qty;


        if($approve_qty!=''){


            $result =  DB::UPDATE("
                        UPDATE MIS.IT_ITEM_REQUISITION_D 
                        SET
                            APRV_QTY = '$approve_qty'
                           
                        WHERE ID = '$table_id'");


            return response()->json(['result'=> "success"]);

        }else{

            return response()->json(['result'=> "error"]);

        }
    }

    public function deleteCwipIdToMainId(Request $request){

        $table_id = $request->id;

        if($request->id!=''){

            $status =DB::DELETE("DELETE FROM  MIS.IT_UPGRADE_CWIPID_TO_MAINID WHERE id = '$table_id'");
            return response()->json(['status'=>'success']);

        }else{
            return response()->json(['status'=>'error']);

        }

    }
    /*CWIP to main id ends*/




    /*Item repair starts*/
    public function itemRepair(){
        $item_name = DB::select("SELECT DISTINCT ITEM_NAME,ITEM_ID,GL FROM MIS.IT_ITEM_MASTER");
        $itr_no = DB::select("SELECT DISTINCT ITR_NO FROM MIS.IT_ITEM_TRANSFER_RECEIVE_D");
        $vendors = DB::select("SELECT * FROM MIS.IT_VENDOR_SUPPLIER where USER_TYPE='vendor'");
        return view('stationery.itemRepair',['item_name'=>$item_name,'itr_no'=>$itr_no,'vendor'=>$vendors]);

    }

    public function getRequisitionData(Request $request){


        $itr_no = $request->itr_no;

        if($itr_no!=""){
            $req_data = DB::select("SELECT * from  MIS.IT_ITEM_TRANSFER_RECEIVE_D where itr_no='$itr_no'");
            if($req_data){
                return response()->json(['result'=>$req_data]);

            }else{
                return response()->json(['result'=>'error']);
            }

        }else{
            return response()->json(['result'=>2]);
        }


    }public function getvendordata(Request $request){


        $vendor_id = $request->vendor_id;

        if($vendor_id!=""){
            $vendor_data = DB::select("SELECT * from  MIS.IT_VENDOR_SUPPLIER where id='$vendor_id'");
            if($vendor_data){
                return response()->json(['result'=>$vendor_data]);

            }else{
                return response()->json(['result'=>'error']);
            }

        }else{
            return response()->json(['result'=>2]);
        }


    }

    public function saveItemRepair(Request $request){
        $uid= Auth::user()->user_id;
        $plant_id = DB::select("Select PLANT_ID from MIS.EMP_HIS_INFO where EMP_ID='$uid'");
        $plant_id= $plant_id[0]->plant_id;


        $data = DB::select("SELECT MAX(SUBSTR( SERVICE_ID, 10 )) max_id FROM MIS.IT_ITEM_REPAIR");
        $max_id = $data[0]->max_id;
        $max_idd = (int)$max_id;


        $itemRepairData = json_decode($request->issueItemData,true);
        $date = Carbon::now()->format('Y-m-d H:m:s');

        $check =0;
        if($max_idd == ''){
            $max_idd = "SRVC".$plant_id.'-1';
            $new_srvc_id = $max_idd;
            $check = 1;

        }

        for($i=0;$i<sizeof($itemRepairData);$i++){

            if($check==1){
                if($i>0){
                    $new_srvc_id++;
                }
            }else
            {
                $max_idd++;
                $new_srvc_id = $max_idd;
                $new_srvc_id = "SRVC".$plant_id.'-'.$max_idd;
            }


            $itemRepairData[$i]['CREATE_USER']= Auth::user()->user_id;
            $itemRepairData[$i]['SERVICE_ID']=$new_srvc_id;
            $itemRepairData[$i]['CREATE_DATE']= $date;
        }

        $status = DB::table('MIS.IT_ITEM_REPAIR')->insert($itemRepairData);

        if($status){
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'error']);
        }

    }


    public function getRepaireItem(){
        $service_id = DB::SELECT("SELECT DISTINCT service_id from MIS.IT_ITEM_REPAIR");
        if($service_id!=""){
            return response()->json($service_id);
        }else{
            return response()->json("");
        }
    }

    public function getAllService(Request $request){

        $all_services = DB::SELECT("SELECT DISTINCT * from MIS.IT_ITEM_REPAIR where service_id = '$request->service_no'");
        if($all_services!=""){
            return response()->json($all_services);
        }else{
            return response()->json("no data here");
        }
    }

    public function updateRepairItem(Request $request){

        $service_id = $request->id;

        $decoded_data = json_decode($request->itemArray);


        $edit_req_no = $decoded_data->edit_req_no;
        $edit_vendor_id = $decoded_data->edit_vendor_id;
        $edit_vendor_name = $decoded_data->edit_vendor_name;
        $edit_vendor_mobile = $decoded_data->edit_vendor_mobile;
        $edit_vendor_address = $decoded_data->edit_vendor_address;
        $edit_bill_no = $decoded_data->edit_bill_no;
        $edit_description = $decoded_data->edit_description;
        $edit_user_name = $decoded_data->edit_user_name;
        $edit_repair_type = $decoded_data->edit_repair_type;
        $edit_item_id = $decoded_data->edit_item_id;
        $edit_item_name = $decoded_data->edit_item_name;
        $edit_product_serial_no = $decoded_data->edit_product_serial_no;
        $edit_prev_srvc_date = $decoded_data->edit_prev_srvc_date;
        $edit_cwip_id_or_main_id = $decoded_data->edit_cwip_id_or_main_id;
        $edit_gl = $decoded_data->edit_gl;
        $edit_cost_center = $decoded_data->edit_cost_center;
        $edit_quantity = $decoded_data->edit_quantity;
        $edit_unit_cost = $decoded_data->edit_unit_cost;
        $edit_total_cost = $decoded_data->edit_total_cost;


        $uid = Auth::user()->user_id;
        $date = Carbon::now()->format('Y-m-d H:m:s');
        $table_id = $request->table_id;

        if($service_id!=''){

            $result =  DB::UPDATE("
                        UPDATE MIS.IT_ITEM_REPAIR
                        SET
                           REQUISITION_NO = '$edit_req_no',
                            VENDOR_ID = '$edit_vendor_id',
                            VENDOR_NAME = '$edit_vendor_name',
                            VENDOR_MOBILE = '$edit_vendor_mobile',
                            VENDOR_ADDRESS = '$edit_vendor_address',
                            BILL_NO = '$edit_bill_no',
                            DESCRIPTION = '$edit_description',
                            REPAIR_TYPE = '$edit_repair_type',
                            ITEM_ID = '$edit_item_id',
                            ITEM_NAME = '$edit_item_name',
                            PRODUCT_SERIAL_NO = '$edit_product_serial_no',
                            PREVIOUS_SERVICE_DATE = '$edit_prev_srvc_date',
                            CWIP_ID_OR_MAIN_ID = '$edit_cwip_id_or_main_id',
                            GL = '$edit_gl',
                            COST_CENTER = '$edit_cost_center',
                            QUANTITY = '$edit_quantity',
                            UNIT_COST = '$edit_unit_cost',
                            TOTAL_COST = '$edit_total_cost',
                   
                             UPDATE_USER = '$uid',
                            UPDATE_DATE = '$date'
                        
                        WHERE ID = '$service_id'");

            if($result){
                return response()->json(['result'=> "success"]);
            }else{
                return response()->json(['result'=> "error"]);
            }

        }else{

            return response()->json(['result'=> "2"]);

        }

    }

    public function deleteRepairdItem(Request $request){
        $table_id = $request->id;

        if($request->id!=''){

            $status =DB::DELETE("DELETE FROM  MIS.IT_ITEM_REPAIR WHERE id = '$table_id'");
            if ($status){
                return response()->json(['status'=>'success']);
            }
            else{
                return response()->json(['status'=>'error']);
            }



        }else{
            return response()->json(['status'=>'error']);

        }


    }



    /*sayla ends*/

}


