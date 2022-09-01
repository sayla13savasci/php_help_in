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

    {{--select cwip id and show details--}}
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <section class="panel" >
                <header class="panel-heading">
                    <label class="text-primary">
                        Upgrade CWIP Id to Main Id
                    </label>
                </header>
                <div class="panel-body">
                    <div class="form-horizontal">
                        <div class="col-md-12 col-sm-12">
                            <div class="col-md-12 col-sm-12">
                                <form action="" class="form-horizontal" role="form" method="post">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="cmp"
                                                       class="col-md-3 col-sm-3 control-label"><b>CWIP ID:</b></label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select class="form-control" id="cwip_id_selectTo" >

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-sm-offset-1 col-md-2 col-sm-2 col-xs-6">
                                                    <button type="button" id="display_cwips_data" class="btn btn-warning btn-sm">
                                                        <i class="fa fa-check"></i> <b>Material Details</b></button>
                                                </div>
                                                <div class="col-md-offset-6 col-sm-offset-6 col-md-2 col-sm-2 col-xs-6">
                                                    <div id="export_buttons">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

   {{-- Datatable html--}}
    <div class="row" id="report-body" style="display: none;">
        <div class="">
            <div class="col-sm-12 col-md-12">
                <section class="panel" id="data_table">
                    <div class="panel-body">
                        <div style="background-color: #5AB6DF;">
                            <p style="font-size: 13px;font-weight: bold;color: white">CWIP Id to Main ID Details</p>
                        </div>
                        <div class="table-responsive">
                            <table id="blk_list" class="table table-striped table-bordered" style="width:100%;">
                                <thead style="background-color: #3CB371">
                                <tr style="color: white">
                                    <th>CWIP ID</th>
                                    <th>IST ID</th>
                                    <th>IST NAME</th>
                                    <th>Item ID</th>
                                    <th>GR QTY</th>
                                    <th>UNIT</th>
                                    <th>SAP PR</th>
                                    <th>EXIST PLANT</th>
                                    <th>NEW PLANT</th>
                                    <th>SPLIT QTY</th>
                                    <th>MAIN ID</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody ></tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>-
                </section>
            </div>
        </div>
    </div>

   {{-- Cwip id to main id convert form--}}
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <section class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <label class="text-default">
                                    Upgrade CWIP ID to Main ID
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="padding-top: 2%">
                    <div style="color: red;font-weight: bold">
                        <p>*(Fields are required)</p>
                    </div>
                    <form action="#" method="post" id="cwip_to_mainId_form">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">CWIP ID<span class='cls-req'>*</span></th>
                                    <th class="text-center">IST ID<span class='cls-req'>*</span></th>
                                    <th class="text-center">IST Name<span class='cls-req'>*</span></th>
                                    <th class="text-center">Item Id<span class='cls-req'>*</span></th>
                                    <th class="text-center">GR Quantity<span class='cls-req'>*</span></th>
                                    <th class="text-center">Unit<span class='cls-req'>*</span></th>
                                    <th class="text-center">SAP PR<span class='cls-req'>*</span></th>
                                    <th class="text-center">Exist Plant<span class='cls-req'>*</span></th>
                                    <th class="text-center">Split Qty<span class='cls-req'>*</span></th>
                                    <th class="text-center">Main Id<span class='cls-req'>*</span></th>
                                    <th class="text-center">New Plant<span class='cls-req'>*</span></th>
                                </tr>
                                </thead>
                                <tbody id="tbody">
                                <tr>
                                    <td>
                                        <select id="cwip_id" name="cwip_id"
                                                class="form-control input-sm ">
                                            <option value="" selected >Select CWIP ID</option>
                                            @if($challan_id)
                                                @foreach($challan_id as $challan_ids)
                                                    <option value="{{$challan_ids->challan_no}}" >{{$challan_ids->challan_no}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="ist_id"
                                               placeholder="" name="ist_id">
                                    </td>
                                    <td>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="ist_name"
                                                   placeholder="" name="ist_name" >
                                    </td>
                                    <td>
                                        <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="item_id"
                                               placeholder="" name="item_id">
                                    </td>
                                    <td>
                                        <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="gr_qty"
                                               placeholder="" name="gr_qty">
                                    </td>
                                    <td>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="unit"
                                               placeholder="" name="unit" >
                                    </td>
                                    <td>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="sap_pr"
                                               placeholder="" name="sap_pr">
                                    </td>
                                    <td>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="exist_plant"
                                               placeholder="" name="exist_plant" value="{{$exist_plant}}" readonly>
                                    </td>
                                    <td>
                                        <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="split_qty"
                                               placeholder="" name="split_qty">
                                    </td>
                                    <td>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="main_id"
                                               placeholder="" name="main_id">
                                    </td>
                                    <td>
                                        <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="new_plant"
                                               placeholder="" name="new_plant">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="col-md-3">
                                    <input type="button" class="add-row btn btn-info" id="add_new_row" value="Add new row">
                                </div>
                                <div class="col-md-2">
                                    <input type="button" class="add-row btn btn-info" id="save_item" value="Update Item">
                                </div>

                            </div>
                            <div class="col-md-7">

                            </div>

                        </div>
                    </form>
                </div>

            </section>
        </div>
    </div>

    {{--Modal for datatable--}}
    <div id="editTypeSubtypeModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Item Subtype</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="cwip_id_edit" class="control-label col-sm-2">CWIP Id</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="cwip_id_edit" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_ist_id" class="control-label col-sm-2">IST Id:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_ist_id" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_ist_name" class="control-label col-sm-2">IST Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_ist_name" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_item_id" class="control-label col-sm-2">Item ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_item_id" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_gr_qty" class="control-label col-sm-2">GR Quantity</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_gr_qty" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_unit" class="control-label col-sm-2">Unit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_unit" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_sap_pr" class="control-label col-sm-2">SAP PR</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_sap_pr" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_exist_plant" class="control-label col-sm-2">Exist Plant</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_exist_plant" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_split_qty" class="control-label col-sm-2">Split Qty</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_split_qty" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_main_id" class="control-label col-sm-2">Main Id</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_main_id" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_new_plant" class="control-label col-sm-2">New Plant</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_new_plant" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-info" id="update_cwip_details">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                        <input type="hidden"  id="table_id">
                    </form>
                </div>
            </div>
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
            // Denotes total number of rows
            var rowIdx = 0;

            /*  Validation for Main form*/
            $("#cwip_id").change(function (){
                var cwip_id = $("#cwip_id").val();
                if(cwip_id != ''){
                    $('#cwip_id').css("border", "1px solid #ccc");
                }
            });
            $("#ist_name").keyup(function (){
                var ist_name = $("#ist_name").val();
                if(ist_name != ''){
                    $('#ist_name').css("border", "1px solid #ccc");
                }
            });
            $("#ist_id").change(function (){
                var ist_id = $("#ist_id").val();
                if(ist_id != ''){
                    $('#ist_id').css("border", "1px solid #ccc");
                }

            });
            $("#item_id").change(function (){
                var item_id = $("#item_id").val();
                if(item_id != ''){
                    $('#item_id').css("border", "1px solid #ccc");
                }

            });
            $("#gr_qty").change(function (){
                var gr_qty = $("#gr_qty").val();
                if(gr_qty != ''){
                    $('#gr_qty').css("border", "1px solid #ccc");
                }

            });
            $("#sap_pr").keyup(function (){
                var sap_pr = $("#sap_pr").val();
                if(sap_pr != ''){
                    $('#sap_pr').css("border", "1px solid #ccc");
                }

            });
            $("#unit").keyup(function (){
                var unit = $("#unit").val();
                if(unit != ''){
                    $('#unit').css("border", "1px solid #ccc");
                }
            });
            $("#split_qty").keyup(function (){
                var split_qty = $("#split_qty").val();
                if(split_qty != ''){
                    $('#split_qty').css("border", "1px solid #ccc");
                }
            });
            $("#main_id").keyup(function (){
                var main_id = $("#main_id").val();
                if(main_id != ''){
                    $('#main_id').css("border", "1px solid #ccc");
                }
            });
            $("#new_plant").keyup(function (){
                var new_plant = $("#new_plant").val();
                if(new_plant != ''){
                    $('#new_plant').css("border", "1px solid #ccc");
                }
            });



            $("#new_plant").keyup(function (){
                var new_plant = $("#new_plant").val();
                if(new_plant != ''){
                    $('#new_plant').css("border", "1px solid #ccc");
                }
            });
            /* Validation Ends*/

            /*  Select two val*/
            var data;
            $('#cwip_id_selectTo').select2({
                placeholder: 'Select an CWIP ID',
                ajax: {
                    url: '{{  url('stationery/form/cwiptomainid/showCwipIds') }}',
                    method:'get',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        console.log("select two data")
                        console.log(data)
                        return {
                            results:  $.map(data, function (item) {
                                return {
                                    text: item.cwip_id,
                                    id: item.cwip_id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

           /* Display datatable after search*/
            $('#display_cwips_data').on('click', function (e) {
                var cwip_id = $('#cwip_id_selectTo').select2("val");
                dataxx = { cwip_id:cwip_id,"_token": "{{ csrf_token() }}"};
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: dataxx,
                    url: "{{ url('stationery/form/cwiptomainid/showCwipData') }}",
                    success: function (resp) {

                        console.log("Here is response");
                        console.log(resp);

                        $("#loader").hide();
                        $("#report-body").show();


                        $("#blk_list").DataTable().destroy();
                        table = $("#blk_list").DataTable({
                            data: resp,
                            autoWidth: true,
                            columns: [
                                {data: "cwip_id"},
                                {data: "ist_id"},
                                {data: "ist_name"},
                                {data: "item_id"},
                                {data: "gr_qty"},
                                {data: "unit"},
                                {data: "sap_pr"},
                                {data: "exist_plant"},
                                {data: "split_qty"},
                                {data: "main_id"},
                                {data: "new_plant"},
                                { data: null,
                                    orderable: false,
                                    'render': function (data, type, row) {
                                        return '<button class=\"btn btn-sm btn-info row-edit ' +
                                            'dt-center\" id="' + row.id +'" ' +
                                            'onclick="editThisRecord('+"'"+row.id+"','"+row.cwip_id+"','"+row.ist_id+"','"+row.ist_name+"','"+row.item_id+"','"+row.gr_qty+"','"+row.unit+"','"+row.sap_pr+"','"
                                            +row.exist_plant+"','"+row.split_qty+"','"+row.main_id+"','"+row.new_plant+"')"+'">EDIT</button>'
                                    }
                                },
                                {
                                    data: null,
                                    orderable: false,
                                    'render': function (data, type, row) {
                                        return '<button type="button"  class="btn btn-danger"  onclick="deleteThisRecord('+row.id+','+"'"+row.cwip_id+"'"+')">Delete</button>'
                                    }
                                }

                            ],
                            columnDefs: [

                                {
                                    "defaultContent": " ",
                                    "targets": "_all"
                                }


                            ],

                            scrollCollapse: true,
                            info: true,


                        });

                        // table.fixedHeader.enable();
                        new $.fn.dataTable.Buttons(table, {
                            buttons: [
                                {
                                    extend: 'collection',
                                    text: '<i class="fa fa-save"></i> Save As <span class="caret"></span>',
                                    buttons: [
                                        {
                                            extend: 'excel',
                                            text: 'Save As Excel',
                                            footer: true,
                                            action: function (e, dt, node, config) {
                                                exportExtension = 'Excel';
                                                $.fn.DataTable.ext.buttons.excelHtml5.action.call(this, e, dt, node, config);
                                            }
                                        }, {
                                            extend: 'pdf',
                                            text: 'Save As PDF',
                                            orientation: 'landscape',
                                            footer: true,
                                            action: function (e, dt, node, config) {
                                                exportExtension = 'PDF';
                                                $.fn.DataTable.ext.buttons.pdfHtml5.action.call(this, e, dt, node, config);
                                            }
                                        }
                                    ],
                                    className: 'btn btn-sm btn-primary'
                                }
                            ]
                        }).container().appendTo($('#export_buttons'));


                    },
                    error: function (err) {
                        console.log(err);
                        $("#loader").hide();
                        $("#report-body").show();
                    }
                });

                console.log(data);
            });

            // jQuery button click event to add a row
            $('#add_new_row').on('click', function () {

                var cwip_id = $("#cwip_id option:selected").text();
                var ist_id = $("#ist_id").val();
                var ist_name = $("#ist_name").val();
                var item_id = $("#item_id").val();
                var gr_qty = $("#gr_qty").val();
                var unit = $("#unit").val();
                var sap_pr = $("#sap_pr").val();
                var exist_plant = $("#exist_plant").val();
                var split_qty = $("#split_qty").val();
                var main_id = $("#main_id").val();
                var new_plant = $("#new_plant").val();


                console.log("split qty is here");
                console.log(split_qty);



                if(cwip_id=='Select CWIP ID'||cwip_id==''||ist_id==''||ist_name==''||item_id==''||gr_qty==''||sap_pr==''
                   ||exist_plant=='' ||unit==''||split_qty==''||main_id==''||new_plant==''){

                    if(cwip_id==''||cwip_id=='Select CWIP ID'){
                        $('#cwip_id').css("border", "1px solid red");
                    }
                    if(ist_id==''){
                        $('#ist_id').css("border", "1px solid red");
                    }
                    if(ist_name==''){
                        $('#ist_name').css("border", "1px solid red");
                    }
                    if(item_id==''){
                        $('#item_id').css("border", "1px solid red");
                    }
                    if(gr_qty==''){
                        $('#gr_qty').css("border", "1px solid red");
                    }
                    if(sap_pr==''){
                        $('#sap_pr').css("border", "1px solid red");
                    }
                    if(ist_id==''){
                        $('#sap_pr').css("border", "1px solid red");
                    }
                    if(exist_plant==''){
                        $('#exist_plant').css("border", "1px solid red");
                    }
                    if(unit==''){
                        $('#unit').css("border", "1px solid red");
                    }
                    if(split_qty==''){
                        $('#split_qty').css("border", "1px solid red");
                    }
                    if(main_id==''){
                        $('#main_id').css("border", "1px solid red");
                    }
                    if(new_plant==''){
                        $('#new_plant').css("border", "1px solid red");
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

                $('#cwip_id').attr('disabled', true);
                $('#ist_id').attr('readonly', true);
                $('#ist_name').attr('readonly', true);
                $('#item_id').attr('readonly', true);
                $('#gr_qty').attr('readonly', true);
                $('#unit').attr('readonly', true);
                $('#sap_pr').attr('readonly', true);
                $('#exist_plant').attr('readonly', true);
                $('#split_qty').attr('readonly', true);
                $('#main_id').attr('readonly', true);
                $('#new_plant').attr('readonly', true);



                var markup = "<tr><td><input  value='"+ cwip_id +"'  class='form-control' readonly></td><td><input type='number' value='"+ ist_id +"'  class='form-control' readonly></td>" +
                    "<td><input  type='text' value='"+ ist_name +"'  class='form-control' type='number' readonly></td><td><input type='number' value='"+ item_id +"'  class='form-control' readonly></td>" +
                    "<td><input  type='number' value='"+ gr_qty +"'  class='form-control' readonly></td><td><input type='text' value='"+ unit +"'  class='form-control' readonly></td>" +
                    "<td><input type='text' value='"+ sap_pr +"'  class='form-control' readonly></td>" +
                    "<td><input type='number' value='"+ exist_plant +"'  class='form-control' readonly></td><td><input type='number' value=''  class='form-control'></td>" +
                    "<td><input type='number' value='' class='form-control' ></td><td><input type='number' value='' class='form-control' ></tr>";

                // Adding a row inside the tbody.
                $('#cwip_to_mainId_form table').append(markup);


            });

            // Find and remove selected table rows
            $("#save_item").click(function(){
                var cwip_id_main = $("#cwip_id").find(':selected').val();
                // console.log("here is cwip id");
                // console.log(cwip)

                var itemArrayDetails = [];

                $("#cwip_to_mainId_form tbody tr").each(function () {
                    var challanItemData = {};

                    var self = $(this);

                    var cwip_id = cwip_id_main;
                    var ist_id = self.find("td:eq(1)").find("input").val().trim();
                    var ist_name = self.find("td:eq(2)").find("input").val().trim();
                    var item_id = self.find("td:eq(3)").find("input").val().trim();
                    var gr_qty = self.find("td:eq(4)").find("input").val().trim();
                    var unit = self.find("td:eq(5)").find("input").val().trim();
                    var sap_pr = self.find("td:eq(6)").find("input").val().trim();
                    var exist_plant = self.find("td:eq(7)").find("input").val().trim();
                    var split_qty = self.find("td:eq(8)").find("input").val().trim();
                    var main_id = self.find("td:eq(9)").find("input").val().trim();
                    var new_plant = self.find("td:eq(10)").find("input").val().trim();

                    challanItemData.cwip_id = cwip_id;
                    challanItemData.ist_id = ist_id;
                    challanItemData.ist_name = ist_name;
                    challanItemData.item_id = item_id;
                    challanItemData.gr_qty = gr_qty;
                    challanItemData.unit = unit;
                    challanItemData.sap_pr = sap_pr;
                    challanItemData.exist_plant = exist_plant;
                    challanItemData.split_qty = split_qty;
                    challanItemData.main_id = main_id;
                    challanItemData.new_plant = new_plant;

                    itemArrayDetails.push(challanItemData);

                });

                console.log("item array details")
                console.log(itemArrayDetails)

                var itemArrayDetailsData = JSON.stringify(itemArrayDetails);
                $.ajax({
                    type: 'post',
                    url: '{{  url('stationery/form/cwiptomainid/saveCwipIdToMainId') }}',
                    data: {
                        'cwipItemData': itemArrayDetailsData,
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function (response) {
                        console.log("save response")
                        console.log(response);



                        if ( response == 1 || response == 'success') {
                            Swal.fire({
                                title: 'Success!',
                                icon: 'success',
                                text: 'Main id created successfully',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })

                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something was wrong! Issue creation failed.',
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });

            $("#update_cwip_details").on('click',function (){
                var cwip_id_edit = $("#cwip_id_edit").val();
                var edit_ist_id = $("#edit_ist_id").val();
                var edit_ist_name = $("#edit_ist_name").val();
                var edit_item_id = $("#edit_item_id").val();
                var edit_gr_qty = $("#edit_gr_qty").val();
                var edit_unit = $("#edit_unit").val();
                var edit_sap_pr = $("#edit_sap_pr").val();
                var edit_exist_plant = $("#edit_exist_plant").val();
                var edit_split_qty = $("#edit_split_qty").val();
                var edit_main_id = $("#edit_main_id").val();
                var edit_new_plant = $("#edit_new_plant").val();

                var table_id  = $("#table_id").val();


                var itemArray = {};

                itemArray.cwip_id_edit=cwip_id_edit;
                itemArray.edit_ist_id=edit_ist_id;
                itemArray.edit_ist_name=edit_ist_name;
                itemArray.edit_item_id=edit_item_id;
                itemArray.edit_gr_qty=edit_gr_qty;
                itemArray.edit_unit=edit_unit;
                itemArray.edit_sap_pr=edit_sap_pr;
                itemArray.edit_exist_plant=edit_exist_plant;
                itemArray.edit_split_qty=edit_split_qty;
                itemArray.edit_main_id=edit_main_id;
                itemArray.edit_new_plant=edit_new_plant;

                var itemArrayData = JSON.stringify(itemArray);


                console.log("item array")
                console.log(itemArrayData)

                $.ajax({
                    type: 'post',
                    url: '{{  url('stationery/form/cwiptomainid/updateCwipIdToMainId') }}',
                    data: { 'id':table_id, 'itemArray':itemArrayData, '_token': "{{ csrf_token () }}"},
                    success: function (data) {
                        console.log("update response data")
                        console.log(data)

                        if(data.result == 1 || data.result == "success"){
                            Swal.fire({
                                title: 'Success!',
                                icon: 'success',
                                text: 'Item subtype has been updated Successfully',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: 'Failed to update',
                                icon: 'error',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            })
                        }
                    },
                    error: function (e) {
                        console.log("update respinse")
                        console.log(e);
                    }
                });

            })

        });
        function editThisRecord(id,cwip_id,ist_id,ist_name,item_id,gr_qty,unit,sap_pr,exist_plant,split_qty,main_id,new_plant){
            $("#table_id").val(id);
            $("#cwip_id_edit").val(cwip_id);
            $("#edit_ist_id").val(ist_id);
            $("#edit_ist_name").val(ist_name);
            $("#edit_item_id").val(item_id);
            $("#edit_gr_qty").val(gr_qty);
            $("#edit_unit").val(unit);
            $("#edit_sap_pr").val(sap_pr);
            $("#edit_exist_plant").val(exist_plant);
            $("#edit_split_qty").val(split_qty);
            $("#edit_main_id").val(main_id);
            $("#edit_new_plant").val(new_plant);
            $("#editTypeSubtypeModal").modal('show');
        }

        function deleteThisRecord(id,cwip_id){
            console.log("in delete ")
            console.log(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete  it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'delete',
                        url: '{{  url('stationery/form/cwiptomainid/deleteCwipIdToMainId') }}',
                        data: { 'id':id, '_token': "{{ csrf_token () }}"},
                        success: function (data) {
                            console.log("delete response data")
                            console.log(data.status)

                            if(data.status == "success"){
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: 'Item has been deleted Successfully',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                })
                            }else{
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to Delete',
                                    icon: 'error',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                })
                            }
                        },
                        error: function (e) {
                            console.log("update response")
                            console.log(e);
                        }
                    });
                }
            })
        }
    </script>


    @endsection
    @section('footer-content')
    {{date('Y')}} &copy; Incepta Pharmaceuticals Ltd.
@endsection