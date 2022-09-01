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
                                    Issue Items
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="padding-top: 2%">
                    <div style="color: red;font-weight: bold">
                        <p>*(Fields are required)</p>
                    </div>
                    <form action="#" method="post" id="item_issue_form">
                        <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Item Name<span class='cls-req'>*</span></th>
                                        <th class="text-center">Item ID<span class='cls-req'>*</span></th>
                                        <th class="text-center">Cwip Id</th>
                                        <th class="text-center">Main ID</th>
                                        <th class="text-center">PO Number</th>
                                        <th class="text-center">GL<span class='cls-req'>*</span></th>
                                        <th class="text-center">Cost Center</th>
                                        <th class="text-center">Transfer Reason</th>
                                        <th class="text-center">PR Quantity</th>
                                        <th class="text-center">Unit</th>
                                        <th class="text-center">Remarks</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    <tr>
                                        <td>
                                            <select id="item_name" name="item_name"
                                                            class="form-control input-sm ">
                                                <option value="" selected >Select Item Name</option>

                                                @if($item_name)
                                                    @foreach($item_name as $name)
                                                        <option value="{{$name->gl}}/{{ $name->item_id}}"  >{{$name->item_name}}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="item_id"
                                                   placeholder="" name="item_id">
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="cwip_id"
                                                   placeholder="" name="cwip_id">
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="main_id"
                                                   placeholder="" name="main_id">
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="po_number"
                                                   placeholder="" name="po_number">
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="item_gl"
                                                   placeholder="" name="item_gl">
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="cost_center"
                                                   placeholder="" name="cost_center" >
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="transfer_reason"
                                                   placeholder="" name="transfer_reason" >
                                        </td>
                                        <td>
                                            <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="pr_qty"
                                                   placeholder="" name="pr_qty" min="1">

                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="unit"
                                                   placeholder="" name="unit" >
                                        </td>
                                        <td>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="remarks"
                                                   placeholder="" name="remarks" >
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        <input type="button" class="add-row btn btn-info" value="Add To Submit">

                    </form>
                </div>
                <div class="panel-body" style="margin-top:20px" id="display_data">
                    <form action="#" method="post" id="issue_item_form">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="issueTable">
                                <thead>
                                <tr>
                                    <th class="text-center">Select Item</th>
                                    <th class="text-center">Item Name</th>
                                    <th class="text-center">Item ID</th>
                                    <th class="text-center">Cwip ID</th>
                                    <th class="text-center">Main ID</th>
                                    <th class="text-center">PO Number</th>
                                    <th class="text-center">GL</th>
                                    <th class="text-center">Cost Center</th>
                                    <th class="text-center">Transfer Reason</th>
                                    <th class="text-center">PR Quantity</th>
                                    <th class="text-center">Unit</th>
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

    <script type="text/javascript">
        $(document).ready(function () {

           /* Onselect Item Name*/
            $('#item_name').change(function () {
                var item_id_gl = $(this).val();
                /*split string*/
                var arrVars = item_id_gl.split("/");
                var item_id = arrVars.pop();
                var item_gl = arrVars.join("/");

                $('#item_gl').val(item_gl);
                $('#item_id').val(item_id);

                $('#item_gl').attr('readonly', true);
                $('#item_id').attr('readonly', true);

            });

            /*Add row on button click*/
            $(".add-row").click(function(){
                var item_name = $("#item_name option:selected").text();
                var item_id = $("#item_id").val();
                var item_gl = $("#item_gl").val();
                var cost_center = $("#cost_center").val();
                var pr_qty = $("#pr_qty").val();
                var unit = $("#unit").val();
                var remarks = $("#remarks").val();
                var cwip_id = $("#cwip_id").val();
                var main_id = $("#main_id").val();
                var po_number = $("#po_number").val();
                var transfer_reason = $("#transfer_reason").val();



                if(item_name=='Select Item Name'){

                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please select an item!',
                        icon: 'warning',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    })
                    return 0;

                }

                var markup = "<tr><td><input type='checkbox' name='record' id='record'></td><td>"+item_name+"</td><td>"+item_id+"</td><td>"
                    +cwip_id+"</td><td>"+main_id+"</td><td>"+po_number+"</td><td>"+item_gl+"</td><td>"
                    +cost_center+"</td><td>"+pr_qty+"</td><td>"+transfer_reason+"</td><td>"+unit+"</td><td>"+remarks+"</td></tr>";

                var delete_button ="<input type='button' value='Delete'>"

                $("#display_data table tbody").append(markup);
                $("#delete_button").css("display","inline-block");
                $("#submit_button").css("display","inline-block");

                $("#item_issue_form").trigger('reset');

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

            // Find and remove selected table rows
            $("#submit_button").click(function(){
                var itemArray = [];

                $("#issueTable tbody tr").each(function () {
                    var transferItemData = {};

                    var self = $(this);

                    var item_name = self.find("td:eq(1)").text().trim();
                    var item_id = self.find("td:eq(2)").text().trim();
                    var cwip_id = self.find("td:eq(3)").text().trim();
                    var main_id = self.find("td:eq(4)").text().trim();
                    var po_number = self.find("td:eq(5)").text().trim();
                    var item_gl = self.find("td:eq(6)").text().trim();
                    var cost_center = self.find("td:eq(7)").text().trim();
                    var transfer_reason = self.find("td:eq(8)").text().trim();
                    var pr_quantity = self.find("td:eq(9)").text().trim();
                    var unit = self.find("td:eq(10)").text().trim();
                    var remarks = self.find("td:eq(11)").text().trim();

                    transferItemData.item_name = item_name;
                    transferItemData.item_id = item_id;
                    transferItemData.cwip_id = cwip_id;
                    transferItemData.main_id = main_id;
                    transferItemData.po_number = po_number;
                    transferItemData.gl = item_gl;
                    transferItemData.cost_center = cost_center;
                    transferItemData.transfer_reason = transfer_reason;
                    transferItemData.qty = pr_quantity;
                    transferItemData.unit = unit;
                    transferItemData.remarks = remarks;

                    itemArray.push(transferItemData);

                });

                var itemData = JSON.stringify(itemArray);

                $.ajax({
                    type: 'post',
                    url: '{{  url('stationery/transferItem/itemTransferSubmit') }}',
                    data: {
                        'transferItemData': itemData,
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function (response) {

                        if ( response == 1 || response == 'success') {
                            Swal.fire({
                                title: 'Success!',
                                icon: 'success',
                                text: 'Issue created successfully',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok'
                            })
                            $("#item_issue_form").trigger('reset');
                            item_id = $('#item_id').val('');
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something was wrong! Issue creation failed.',
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
        });

    </script>

    @endsection
    @section('footer-content')
    {{date('Y')}} &copy; Incepta Pharmaceuticals Ltd.
@endsection