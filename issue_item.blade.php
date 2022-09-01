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
                        SHow Issued Items
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
                                                       class="col-md-3 col-sm-3 control-label"><b>IR No.:</b></label>
                                                <div class="col-md-9 col-sm-9">
                                                    <select class="form-control" id="ir_no_selectTo" >


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="form-group">
                                                <div class="col-md-offset-1 col-sm-offset-1 col-md-2 col-sm-2 col-xs-6">
                                                    <button type="button" id="display_ir_datatable" class="btn btn-warning btn-sm">
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
                                    <th>IR No.</th>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>GL</th>
                                    <th>Cost Center</th>
                                    <th>Product Qty</th>
                                    <th>Remarks</th>
                                    <th>UNIT</th>
                                    <th>Approve</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody ></tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>


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
                                    <th class="text-center">GL<span class='cls-req'>*</span></th>
                                    <th class="text-center">Cost Center<span class='cls-req'>*</span></th>
                                    <th class="text-center">PR Quantity<span class='cls-req'>*</span></th>
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
                                               class="form-control input-xs" id="item_gl"
                                               placeholder="" name="item_gl">
                                    </td>
                                    <td>
                                        <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                               class="form-control input-xs" id="cost_center"
                                               placeholder="" name="cost_center" >
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
                                    <th class="text-center">GL</th>
                                    <th class="text-center">Cost Center</th>
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

    {{--Modal for datatable--}}
    <div id="editItemDisplayModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Issued Item</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="edit_ir_no" class="control-label col-sm-2">IR NO:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_ir_no" value="" disabled="disabled">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_item_id" class="control-label col-sm-2">Item ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_item_id" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_item_name" class="control-label col-sm-2">Item Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_item_name" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_gl" class="control-label col-sm-2">GL:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_gl" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_cost_center" class="control-label col-sm-2">Cost Center</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_cost_center" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_pr_qty" class="control-label col-sm-2">PR Qty</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_pr_qty" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_unit" class="control-label col-sm-2">Unit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_unit" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_remarks" class="control-label col-sm-2">Remarks</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_remarks" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-info" id="update_issue">Update</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                        <input type="hidden"  id="table_id">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="approveQtyDisplayModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Issued Item</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="edit_ir_no" class="control-label col-sm-2">IR NO:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="appr_ir_no" value="" disabled="disabled">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_item_id" class="control-label col-sm-2">Item ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="appr_item_id" value="" disabled="disabled">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_item_name" class="control-label col-sm-2">Item Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="appr_item_name" value="" disabled="disabled">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_unit" class="control-label col-sm-2">Unit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="appr_unit" value="" disabled="disabled">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_pr_qty" class="control-label col-sm-2">PR Qty</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="appr_pr_qty" value="" disabled="disabled">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_remarks" class="control-label col-sm-2">Approve Qty<span class='cls-req'>*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="appprove_qty" value="" placeholder="Approve Quantity">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-info" id="approve_qty_button">Approve</button>
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

            /*  Select two val*/
            var data;
            var approve_qty;


            $('#ir_no_selectTo').select2({
                placeholder: 'Select IR No.',
                ajax: {
                    url: '{{  url('stationery/form/issueItem/getIssuedItem') }}',
                    method:'get',
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        console.log("select two data")
                        console.log(data)
                        return {
                            results:  $.map(data, function (item) {
                                console.log("select two item status")
                                console.log(item)
                                return {
                                    text: item.ir_no,
                                    id: item.ir_no
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            /* Display datatable after search*/
            $('#display_ir_datatable').on('click', function (e) {

                var ir_no = $('#ir_no_selectTo').select2("val");
                data = { ir_no:ir_no,"_token": "{{ csrf_token() }}"};
                $.ajax({
                    type: "post",
                    dataType: 'json',
                    data: data,
                    url: "{{ url('stationery/form/issueItem/showIrdata') }}",
                    success: function (resp) {

                        console.log("ir display");
                        console.log(resp);
                        console.log(resp['issuedItems']);


                        $("#loader").hide();
                        $("#report-body").show();


                        $("#blk_list").DataTable().destroy();
                        table = $("#blk_list").DataTable({
                            data: resp.issuedItems,
                            autoWidth: true,
                            columns: [
                                {data: "ir_no"},
                                {data: "item_id"},
                                {data: "item_name"},
                                {data: "gl"},
                                {data: "cost_center"},
                                {data: "pr_qty"},
                                {data: "remarks"},
                                {data: "unit"},
                                {

                                    data: 'aprv_qty',
                                    orderable: false,

                                 'render': function (data, type, row) {
                                      if(row.aprv_qty==0){
                                            return '<button class=\"btn btn-sm btn-info row-edit ' +
                                                'dt-center\" id="' + row.id + '" ' +
                                                'onclick="approveRecord(' + "'" + row.id + "','" + row.C + "','" + row.item_id + "','" + row.item_name + "','" + row.gl + "','" + row.cost_center + "','" + row.pr_qty + "','" + row.unit + "','" + row.remarks + "')" + '">Approve</button>'

                                        }else{
                                            return '<button class="btn btn-sm btn-success" id="btn_approved">Approved</button>'

                                        }

                                      /*  return '<button class=\"btn btn-sm btn-success row-edit ' +
                                            'dt-center\" id="' + row.id + '" ' +
                                            'onclick="approveRecord(' + "'" + row.id + "','" + row.C + "','" + row.item_id + "','" + row.item_name + "','" + row.gl + "','" + row.cost_center + "','" + row.pr_qty + "','" + row.unit + "','" + row.remarks + "')" + '">Approve</button>'
                                  */  }

                                },
                                { data: null,
                                    orderable: false,
                                    'render': function (data, type, row) {
                                        return '<button class=\"btn btn-sm btn-info row-edit ' +
                                            'dt-center\" id="' + row.id + '" ' +
                                            'onclick="editThisRecord(' + "'" + row.id + "','" + row.C + "','" + row.item_id + "','" + row.item_name + "','" + row.gl + "','" + row.cost_center + "','" + row.pr_qty + "','" + row.unit + "','" + row.remarks + "')" + '">EDIT</button>'
                                    }
                                },
                                {
                                    data: null,
                                    orderable: false,
                                       'render': function (data, type, row) {
                                           return '<button class=\"btn btn-sm btn-danger row-remove ' +
                                               'dt-center\" id="' + row.id +'" ' +
                                               'onclick="deleteThisRecord('+"'"+row.id+"','"+row.ir_no+"')"+'">Delete</button>'
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


                if(item_name=='Select Item Name'){

                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please select an item!',
                        icon: 'warning',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    })
                    return 0;

                }else if(cost_center ==''){
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please input cost center',
                        icon: 'warning',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    })
                    return 0;

                }else if(pr_qty==''){
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please input product quantity',
                        icon: 'warning',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    })
                    return 0;

                }

                var markup = "<tr><td><input type='checkbox' name='record' id='record'></td><td>"+item_name+"</td><td>"+item_id+"</td><td>"+item_gl+"</td><td>"
                    +cost_center+"</td><td>"+pr_qty+"</td><td>"+unit+"</td><td>"+remarks+"</td></tr>";

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
                    var issueItemData = {};

                    var self = $(this);

                    var item_name = self.find("td:eq(1)").text().trim();
                    var item_id = self.find("td:eq(2)").text().trim();
                    var item_gl = self.find("td:eq(3)").text().trim();
                    var cost_center = self.find("td:eq(4)").text().trim();
                    var pr_quantity = self.find("td:eq(5)").text().trim();
                    var unit = self.find("td:eq(6)").text().trim();
                    var remarks = self.find("td:eq(7)").text().trim();

                    issueItemData.item_name = item_name;
                    issueItemData.item_id = item_id;
                    issueItemData.gl = item_gl;
                    issueItemData.cost_center = cost_center;
                    issueItemData.pr_qty = pr_quantity;
                    issueItemData.unit = unit;
                    issueItemData.remarks = remarks;

                    itemArray.push(issueItemData);

                });

                var itemData = JSON.stringify(itemArray);

                $.ajax({
                    type: 'post',
                    url: '{{  url('stationery/form/issueItem/createIssue') }}',
                    data: {
                        'issueItemData': itemData,
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
                            })
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            });

            $("#update_issue").on('click',function (){
                var edit_ir_no = $("#edit_ir_no").val();
                var edit_item_id = $("#edit_item_id").val();
                var edit_item_name = $("#edit_item_name").val();
                var edit_gl = $("#edit_gl").val();
                var edit_cost_center = $("#edit_cost_center").val();
                var edit_pr_qty = $("#edit_pr_qty").val();
                var edit_unit = $("#edit_unit").val();
                var edit_remarks = $("#edit_remarks").val();
                var table_id  = $("#table_id").val();

                var itemArray = {};

                itemArray.edit_ir_no=edit_ir_no;
                itemArray.edit_item_id=edit_item_id;
                itemArray.edit_item_name=edit_item_name;
                itemArray.edit_gl=edit_gl;
                itemArray.edit_cost_center=edit_cost_center;
                itemArray.edit_pr_qty=edit_pr_qty;
                itemArray.edit_unit=edit_unit;
                itemArray.edit_remarks=edit_remarks;

                var itemArrayData = JSON.stringify(itemArray);


                $.ajax({
                    type: 'post',
                    url: '{{  url('stationery/form/issueItem/updateIssuedItem') }}',
                    data: { 'id':table_id, 'itemArray':itemArrayData, '_token': "{{ csrf_token () }}"},
                    success: function (data) {

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
                       console.log(e)

                    }
                });

            });


            $("#approve_qty_button").on('click',function (){

                var appprove_qty = $("#appprove_qty").val();
                var apprv_pr_qty = $("#appr_pr_qty").val();
                var table_id  = $("#table_id").val();

                if(appprove_qty==''){
                    Swal.fire({
                    title: 'Warning!',
                    icon: 'warning',
                    text: 'Please input approve Qty!!',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                })
                    return 0;
                }

                if(parseInt(appprove_qty)>parseInt(apprv_pr_qty)){
                    Swal.fire({
                        title: 'Opps!!',
                        icon: 'warning',
                        text: 'Approve quantity must be less then or equal to product quantity',
                        showConfirmButton: true,
                        confirmButtonText: 'Ok'
                    })
                    return 0;
                }else{
                    $.ajax({
                        type: 'post',
                        url: '{{  url('stationery/form/issueItem/approveQtyItem') }}',
                        data: { 'id':table_id, 'appprove_qty':appprove_qty, '_token': "{{ csrf_token () }}"},
                        success: function (data) {
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
                                })
                            }
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                }
            });


            $(document).on("click","#btn_approved",function() {
                Swal.fire({
                    title: 'Great!',
                    icon: 'success',
                    text: 'Already Approved',
                    showConfirmButton: true,
                    confirmButtonText: 'Ok'
                })
            });



        });

        function editThisRecord(id,ir_no,item_id,item_name,gl,cost_center,pr_qty,unit,remarks){
            $("#table_id").val(id);
            $("#edit_ir_no").val(ir_no);
            $("#edit_item_id").val(item_id);
            $("#edit_item_name").val(item_name);
            $("#edit_gl").val(gl);
            $("#edit_cost_center").val(cost_center);
            $("#edit_pr_qty").val(pr_qty);
            $("#edit_unit").val(unit);
            $("#edit_remarks").val(remarks);


            if(remarks=='null'){
                $("#edit_remarks").val("");
            }else{
                $("#edit_remarks").val(remarks);
            }

            if(unit=='null'){
                $("#edit_unit").val("");
            }else{
                $("#edit_unit").val(unit);
            }

            if(pr_qty=='null'){
                $("#edit_pr_qty").val("");
            }else{
                $("#edit_pr_qty").val(pr_qty);
            }


            $("#editItemDisplayModal").modal('show');

        }

        function deleteThisRecord(id, ir_no){

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'post',
                        url: '{{  url('stationery/form/issueItem/delete_my_issues') }}',
                        data: { 'id':id,'ir_no':ir_no, '_token': "{{ csrf_token () }}"},
                        success: function (data) {

                            if(data.result == 1 || data.result == true|| data.result == 'true' ){
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
                            console.log(e);
                        }
                    });
                }
            })
        }

        function approveRecord(id,ir_no,item_id,item_name,gl,cost_center,pr_qty,unit,remarks){
            console.log("approve qty");
            console.log(id);
            console.log(ir_no);
            $("#table_id").val(id);
            $("#appr_ir_no").val(ir_no);
            $("#appr_item_id").val(item_id);
            $("#appr_item_name").val(item_name);
            $("#appr_pr_qty").val(pr_qty);
            $("#appr_unit").val(unit);


            $("#approveQtyDisplayModal").modal('show');

        }

    </script>



    @endsection
    @section('footer-content')
    {{date('Y')}} &copy; Incepta Pharmaceuticals Ltd.
@endsection