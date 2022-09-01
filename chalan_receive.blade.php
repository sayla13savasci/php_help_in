@extends('_layout_shared._master')
@section('title','Manage Items')
@section('styles')

<link href="{{ url('public/site_resource/css/toast/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ url('public/site_resource/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ url('public/site_resource/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ url('public/site_resource/css/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ url('public/site_resource/css/salert/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ url('public/site_resource/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{ url('public/site_resource/css/toast/toastr.min.css')}}" rel="stylesheet" type="text/css"/>


<style>
    .swal2-icon.swal2-warning {
        font-size: 14px;
    }

    .swal2-html-container{
        font-size: 1.5em !important;
    }

    .panel-heading {
        padding: 5px 15px 2px 15px;
        margin-bottom: 0px;
    }

    .form-control {
        border-radius: 0px;
    }

    body {
        color: black;
    }

    .fnt_size {
        font-size: 12px;
        text-align: left;
    }

    .input-group-addon {
        border-radius: 0px;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    input[type=file]::-webkit-file-upload-button {
        width: 0;
        padding: 0;
        margin: 0;
        -webkit-appearance: none;
        border: none;
        border: 0px;
    }

    x::-webkit-file-upload-button, input[type=file]:after {
        content: 'Browse...';
        /*background-color: blue;*/
        left: 76%;
        /*margin-left:3px;*/
        position: relative;
        -webkit-appearance: button;
        padding: 2px 8px 2px;
        border: 0px;
    }

    .form-horizontal .control-label {
        padding-top: 3px;
        margin-bottom: 0;
        text-align: left;
    }

    /*Here starts styling of table section*/
    .table > thead > tr > th {
        padding: 2px;
        font-size: 12px;
    }

    .table > tbody > tr > td {
        padding: 2px;
        font-size: 11px;
    }

    .table > tfoot > tr > td {
        padding: 2px;
        font-size: 11px;
    }

    body {
        color: #000;
    }
    .odd{
        background-color: #FFF8FB !important;
    }
    .even{
        background-color: #DDEBF8 !important;
    }
    .select2-container{
        width: 100%!important;
    }
    .select2-search--dropdown .select2-search__field {
        width: 98%;
    }
    #insert_itemBtn{
        color: #fff;
        background-color: #9a4ef0;
        border-color: #9a4ef0;
    }
    #insert_itemBtn:hover{
        color: #fff;
        background-color: #9a4ef0;
        border-color: #9a4ef0;
    }
    .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
        outline: none;
    }

    fieldset.scheduler-border {
        border: 2px groove #337AC7 !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    fieldset.scheduler-border2 {
        border: 2px groove orangered !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow: 0px 0px 0px 0px #000;
        box-shadow: 0px 0px 0px 0px #000;
    }

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: center !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
        color: #337AC7;
    }

    legend.scheduler-border2 {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width: auto;
        padding: 0 10px;
        border-bottom: none;
        color: orangered;
    }
    .cls-req{
        color: red;
        font-weight: bold;
    }


</style>
@endsection
@section('right-content')
<div class="row">
    <div class="col-md-12 col-sm-12">
        <section class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <label class="text-default">
                                Challan Receive
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-body" style="padding-top: 2%">
                <div style="font-weight: bold">
                    <p> Input Challan Master Data <span style="color: red;font-size: 12px">*(Fields are required)</span> </p>
                </div>
                <form action="#" method="post" id="item_issue_form">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Challan No <span class='cls-req'>*</span></th>
                                <th class="text-center">SAP PR <span class='cls-req'>*</span></th>
                                <th class="text-center">SAP PO <span class='cls-req'>*</span></th>
                                <th class="text-center">Supplier Invoice/Challan No.</th>
                                <th class="text-center">Supplier Name</th>
                                <th class="text-center">Remarks</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            <tr>
                                <td>
                                    <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="challan_no_master"
                                           placeholder="" name="challan_no_master">
                                </td>

                                <td>
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="sap_pr"
                                           placeholder="" name="sap_pr">
                                </td>
                                <td>
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="sap_po"
                                           placeholder="" name="sap_po">
                                </td>
                                <td>
                                    <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="supp_invoice_or_chalan_no"
                                           placeholder="" name="supp_invoice_or_chalan_no">
                                </td>
                                <td>
                                    <select id="supplier_name" name="supplier_name"
                                            class="form-control input-sm ">
                                        <option value="" selected >Select Supplier Name</option>

                                        @if($supplier_name)
                                            @foreach($supplier_name as $supplier_names)
                                                <option value="{{$supplier_names->contact}}"  >{{$supplier_names->name}}</option>
                                            @endforeach
                                        @endif

                                    </select>

                                </td>
                                <td>
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="remarks"
                                           placeholder="" name="remarks">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <input type="button" id="add_details_info"  value="Add Details Data" class="btn btn-info">
                </form>



                <form action="#" method="post" id="item_details_form" style="display: none">
                    <div style="font-weight: bold; margin-top: 20px" >
                        <p> Input Challan Details Data</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="text-center">Challan No <span class='cls-req'>*</span></th>
                                <th class="text-center">Item ID <span class='cls-req'>*</span></th>
                                <th class="text-center">Item Name <span class='cls-req'>*</span></th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Total Price</th>
                                <th class="text-center">Expire Date</th>
                                <th class="text-center">Warranty</th>
                                <th class="text-center">SAP CWIP ID</th>
                                <th class="text-center">SAP GL</th>
                                <th class="text-center">SAP CC</th>
                                <th class="text-center">Product Serial</th>

                            </tr>
                            </thead>
                            <tbody id="tbody">
                            <tr>
                                <td>
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="challan_no_details"
                                           placeholder="" name="challan_no_details" >
                                </td>
                                <td>
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="item_id_d"
                                           placeholder="" name="item_id_d" onfocus="this.value=''">
                                </td>
                                <td>
                                    <select id="item_name_d" name="item_name_d"
                                            class="form-control input-sm ">
                                        <option value="" selected >Select Item Name</option>
                                        @if($item_name)
                                            @foreach($item_name as $name)
                                                <option value="{{ $name->item_id}}">{{$name->item_name}}</option>
                                            @endforeach
                                        @endif

                                    </select>
                                </td>
                                <td>
                                    <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="quantity_d"
                                           placeholder="" name="quantity_d" onfocus="this.value=''">
                                </td>

                                <td>
                                    <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="unit_price_d"
                                           placeholder="" name="unit_price_d" onfocus="this.value=''">
                                </td>
                                <td>
                                    <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="total_price_d"
                                           placeholder="" name="total_price_d" onfocus="this.value=''">
                                </td>
                                <td>
                                    <input type="text" name="expire_date_d" id="expire_date_d" class="form-control datepicker" placeholder="Select Date"/>
                                </td>
                                <td>
                                    <input type="input" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="warrenty_d"
                                           placeholder="" name="warrenty_d" onfocus="this.value=''">
                                </td>
                                <td>
                                    <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="sap_cwip_id_d"
                                           placeholder="" name="sap_cwip_id_d" onfocus="this.value=''">
                                </td>

                                <td>
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="sap_gl_d"
                                           placeholder="" name="sap_gl_d" onfocus="this.value=''">
                                </td>
                                <td>
                                    <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="sap_cc_d"
                                           placeholder="" name="sap_cc_d" onfocus="this.value=''">
                                </td>
                                <td>
                                    <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                           class="form-control input-xs" id="product_serial_d"
                                           placeholder="" name="product_serial_d" min="1" onfocus="this.value=''">
                                </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <input type="button"  class="add-row btn btn-info" value="Add To Submit">

                </form>


            </div>
            <div class="panel-body" style="margin-top:20px" id="display_data">
                <form action="#" method="post" id="issue_item_form">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="issueTable">
                            <thead>
                            <tr>
                                <th class="text-center">Select Item </th>

                                <th class="text-center">Challan No </th>
                                <th class="text-center">Item ID</th>
                                <th class="text-center">Item Name</th>
                                <th class="text-center">SAP PR</th>
                                <th class="text-center">SAP PO</th>
                                <th class="text-center">SAP GL</th>
                                <th class="text-center">SAP CC</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Total Price</th>
                                <th class="text-center">Expire Date</th>
                                <th class="text-center">Product Serial</th>
                                <th class="text-center">Warrenty</th>
                                <th class="text-center">SAP CWIP Id</th>
                                <th class="text-center">Supplier Invoice/Chalan No</th>
                                <th class="text-center">Supplier Name</th>
                                <th class="text-center">PR Quantity</th>
                                <th class="text-center">Remarks</th>
                            </tr>
                            </thead>
                            <tbody id="tbody" style="text-align:center">

                            </tbody>
                        </table>

                        <button type="button" class="delete-row btn btn-danger" style="display:none" id="delete_button">Delete Item</button>
                        <button type="button"  class="btn btn-info" style="display:none" id="submit_button">Submit</button>

                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection

@section('scripts')

{{Html::script('public/site_resource/js/toast/toastr.min.js')}}

{{Html::script('public/site_resource/js/jquery.dataTables.min.js')}}
{{Html::script('public/site_resource/js/dataTables.bootstrap.min.js')}}
{{Html::script('public/site_resource/js/dataTables.fixedHeader.min.js')}}

{{Html::script('public/site_resource/js/dataTables.buttons.min.js')}}
{{Html::script('public/site_resource/js/buttons.bootstrap.min.js')}}
{{Html::script('public/site_resource/js/buttons.flash.min.js')}}

{{Html::script('public/site_resource/js/jszip.min.js')}}
{{Html::script('public/site_resource/js/pdfmake.min.js')}}
{{Html::script('public/site_resource/js/vfs_fonts.js')}}

{{Html::script('public/site_resource/js/buttons.html5.min.js')}}
{{Html::script('public/site_resource/dpicker/moment-with-locales.js')}}
{{Html::script('public/site_resource/dpicker/bootstrap-datetimepicker.js')}}
{{Html::script('public/site_resource/select2/select2.min.js')}}
{{Html::script('public/site_resource/js/salert/sweetalert2@11.js')}}

{{Html::script('public/site_resource/js/jquery.formautofill.min.js')}}

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>


<script type="text/javascript">

    $(function(){
        $('.datepicker').datepicker({
            format: 'mm-dd-yyyy'
        });
    });


    $(document).ready(function () {

        $("#supplier_name").change

        $("#challan_no_master").change(function (){
            var challan_no_master = $("#challan_no_master").val();
            if(challan_no_master != ''){
                $('#challan_no_master').css("border", "1px solid #ccc");
            }

        })
        $("#challan_no_master").keyup(function (){
            var challan_no_master = $("#challan_no_master").val();
            if(challan_no_master != ''){
                $('#challan_no_master').css("border", "1px solid #ccc");
            }

        })
        $("#sap_pr").keyup(function (){
            var sap_pr = $("#sap_pr").val();
            if(sap_pr != ''){
                $('#sap_pr').css("border", "1px solid #ccc");
            }

        })
        $("#sap_po").keyup(function (){
            var sap_po = $("#sap_po").val();
            if(sap_po != ''){
                $('#sap_po').css("border", "1px solid #ccc");
            }

        })
        $("#item_name_d").change(function (){
            var item_name_d = $("#item_name_d option:selected" ).text();
            if(item_name_d != 'Select Item Name'){
                $('#item_name_d').css("border", "1px solid #ccc");
            }

        })

        /*Add Details Button Click*/
        $("#add_details_info").click(function (){
            var challan_no = $('#challan_no_master').val();
            var sap_pr = $("#sap_pr").val();
            var sap_po = $("#sap_po").val();
            var supp_invoice_or_chalan_no = $("#supp_invoice_or_chalan_no").val();
            var supplier_name = $("#supplier_name").val();
            var remarks = $("#remarks").val();

            if(challanNo==''||sap_pr==''||sap_po==''){

                if(challan_no==''){
                    $('#challan_no_master').css("border", "1px solid red");
                }
                if(sap_pr==''){
                    $('#sap_pr').css("border", "1px solid red");
                }
                 if(sap_po==''){
                    $('#sap_po').css("border", "1px solid red");
                }

                Swal.fire({
                    title: 'Warning!',
                    text: 'Please Input Required Field',
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                })
                return 0;
            }else{
                $("#item_details_form").css("display","block")
                var challanNo = $('#challan_no_master').val();
                $('#challan_no_details').val(challanNo);
                $('#challan_no_details').attr('readonly', true);
            }
        });

        $('#challan_no_master').keyup(function(){

            var challanNo = $('#challan_no_master').val();
            $('#challan_no_details').val(challanNo);
        });


        /* Onselect Item Name*/
        $('#item_name_d').change(function () {
            var item_id =   $("#item_name_d option:selected" ).val();
            $('#item_id_d').val(item_id);
            $('#item_id_d').attr('readonly', true);

        });

        /*Add row on button click*/
        $(".add-row").click(function(){
            var challan_no_master = $("#challan_no_master").val();

            var challan_no = $("#challan_no_details").val();
            var item_id_d = $("#item_id_d").val();
            var item_name_d = $("#item_name_d option:selected" ).text();
            var quantity_d = $("#quantity_d").val();
            var unit_price_d = $("#unit_price_d").val();
            var total_price_d = $("#total_price_d").val();
            var expire_date_d = $("#expire_date_d").val();
            var warrenty_d = $("#warrenty_d").val();
            var sap_cwip_id_d = $("#sap_cwip_id_d").val();
            var sap_gl_d = $("#sap_gl_d").val();
            var sap_cc_d = $("#sap_cc_d").val();
            var product_serial_d = $("#product_serial_d").val();


            /*Master Table Data*/

            var supplier_name= $("#supplier_name option:selected").text();

            var remarks = $("#remarks").val();
            var sap_pr = $("#sap_pr").val();
            var sap_po = $("#sap_po").val();
            var supp_invoice_or_chalan_no = $("#supp_invoice_or_chalan_no").val();


            if(challan_no==''||sap_pr==''||sap_po==''||item_name_d=='Select Item Name'){

                if(challan_no_master==''){
                    $('#challan_no_master').css("border", "1px solid red");
                }
                if(sap_pr==''){
                    $('#sap_pr').css("border", "1px solid red");
                }
                if(sap_po==''){
                    $('#sap_po').css("border", "1px solid red");
                }
                if(item_name_d=='Select Item Name'){
                    $('#item_name_d').css("border", "1px solid red");
                }

                Swal.fire({
                    title: 'Warning!',
                    text: 'Please Input Required Field',
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                })
                return 0;
            }

            var markup = "<tr><td><input type='checkbox' name='record' id='record'></td><td>"+challan_no+"</td><td>"+item_id_d+"</td><td>"+item_name_d+"</td><td>"+sap_pr+"</td><td>"
                +sap_po+"</td><td>"+sap_gl_d+"</td><td>"+sap_cc_d+"</td><td>"+unit_price_d+"</td><td>"+total_price_d+"</td><td>"+expire_date_d+"</td><td>"+product_serial_d+"</td><td>"
                +warrenty_d+"</td><td>"+sap_cwip_id_d+"</td><td>"+supp_invoice_or_chalan_no+"</td><td>"+supplier_name+"</td><td>"+quantity_d+"</td><td>"+remarks+"</td></tr>";

            var delete_button ="<input type='button' value='Delete'>"

            $("#display_data table tbody").append(markup);
            $("#delete_button").css("display","inline-block");
            $("#submit_button").css("display","inline-block");

        });

        // Find and remove selected table rows
        $(".delete-row").click(function(){
            count =0

            $("table tbody").find('input[name="record"]').each(function(){
                if($(this).is(":checked")){
                    count++;
                }
            });

            if(count!=''){
                $("table tbody").find('input[name="record"]').each(function(){
                    if($(this).is(":checked")){
                        $(this).parents("tr").remove();
                    }
                });
            }else{
                Swal.fire({
                    title: 'Warning!',
                    text: 'Please select an item',
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                })
                return 0;
            }
        });
        });

        // Find and remove selected table rows
        $("#submit_button").click(function(){

            var itemArrayMaster={} ;
            var challan_no = $("#challan_no_master").val();
            var sap_pr = $("#sap_pr").val();
            var sap_po = $("#sap_po").val();
            var supp_invoice_or_chalan_no = $("#supp_invoice_or_chalan_no").val();
            var supplier_name = $("#supplier_name").val();
            var remarks = $("#remarks").val();



            if(challan_no==''||sap_pr==''||sap_po==''||item_name_d=='Select Item Name'){

                if(challan_no==''){
                    $('#challan_no_master').css("border", "1px solid red");
                }
                if(sap_pr==''){
                    $('#sap_pr').css("border", "1px solid red");
                }
                if(sap_po==''){
                    $('#sap_po').css("border", "1px solid red");
                }
                if(item_name_d=='Select Item Name'){
                    $('#item_name_d').css("border", "1px solid red");
                }

                Swal.fire({
                    title: 'Warning!',
                    text: 'Please Input Required Field',
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                })
                return 0;
            }



            console.log("gfhjlkjf");
            console.log(supp_invoice_or_chalan_no);

            itemArrayMaster.challan_no=challan_no;
            itemArrayMaster.sap_pr=sap_pr;
            itemArrayMaster.sap_po=sap_po;
            itemArrayMaster.sup_invoice_or_ch_no=supp_invoice_or_chalan_no;
            itemArrayMaster.supplier_name=supplier_name;
            itemArrayMaster.remarks=remarks;




            var itemArrayDetails = [];

            $("#issueTable tbody tr").each(function () {
                var challanItemData = {};

                var self = $(this);

                var challan_no = self.find("td:eq(1)").text().trim();
                var item_id = self.find("td:eq(2)").text().trim();
                var item_name = self.find("td:eq(3)").text().trim();
                var sap_pr = self.find("td:eq(4)").text().trim();
                var sap_po = self.find("td:eq(5)").text().trim();
                var sap_gl = self.find("td:eq(6)").text().trim();
                var sap_cc = self.find("td:eq(7)").text().trim();
                var cost_center = self.find("td:eq(8)").text().trim();
                var unit_price = self.find("td:eq(9)").text().trim();
                var total_price = self.find("td:eq(10)").text().trim();
                var expire_date = self.find("td:eq(11)").text().trim();
                var product_serial = self.find("td:eq(12)").text().trim();
                var warrenty = self.find("td:eq(13)").text().trim();
                var sap_cwip_id = self.find("td:eq(14)").text().trim();
                var supp_inv_or_chal_no = self.find("td:eq(15)").text().trim();
                var supplier_name = self.find("td:eq(16)").text().trim();
                var pr_qty = self.find("td:eq(17)").text().trim();
                var remarks = self.find("td:eq(18)").text().trim();


                challanItemData.challan_no = item_name;
                challanItemData.item_id = item_id;
                challanItemData.item_name = item_name;
                challanItemData.sap_pr = sap_pr;
                challanItemData.sap_po = sap_po;
                challanItemData.sap_gl = sap_gl;
                challanItemData.sap_cc = sap_cc;
                challanItemData.cost_center = cost_center;
                challanItemData.unit_price = unit_price;
                challanItemData.total_price = total_price;
                challanItemData.expire_date = expire_date;
                challanItemData.warrenty = warrenty;
                challanItemData.sap_cwip_id = sap_cwip_id;
                challanItemData.supp_inv_or_chal_no = supp_inv_or_chal_no;
                challanItemData.supplier_name = supplier_name;
                challanItemData.pr_qty = pr_qty;
                challanItemData.remarks = remarks;
                challanItemData.product_serial = product_serial;

                itemArrayDetails.push(challanItemData);

            });

            console.log(itemArrayDetails);

            var itemArrayDetailsData = JSON.stringify(itemArrayDetails);

            $.ajax({
                type: 'post',
                url: '{{  url('stationery/chalan/saveReceivedChallan') }}',
                data: {
                'challanReceiveMaster': itemArrayMaster,  'challanReceiveDetails': itemArrayDetailsData,
                    '_token': "{{ csrf_token() }}"
            },
            success: function (response) {
                    console.log(response);

                if ( response == 1 || response == 'success') {
                    Swal.fire({
                        title: 'Success!',
                        icon: 'success',
                        text: 'Challan created successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    })
                    $("#item_issue_form").trigger('reset');
                    item_id = $('#item_id').val('');
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something was wrong! Challan creation failed.',
                        icon: 'error',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    })
                }
            },
            error: function (e) {
                console.log(e);
            }
        });
    });

</script>

@endsection
@section('footer-content')
{{date('Y')}} &copy; Incepta Pharmaceuticals Ltd.
@endsection