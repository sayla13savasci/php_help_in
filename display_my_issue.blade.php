<?php
/**
 * Created by PhpStorm.
 * User: masroor
 * Date: 10/25/2018
 * Time: 9:30 AM
 */ ?>
@extends('_layout_shared._master')
@section('title','My Application')
@section('styles')
    <link href="{{ url('public/site_resource/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/site_resource/css/toast/toastr.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/site_resource/css/buttons.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/site_resource/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>

    <!--pickers css-->
    <link href="{{ url('public/site_resource/css/salert/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/site_resource/css/datepicker3.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/site_resource/css/bootstrap-lightbox.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/site_resource/select2/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('public/site_resource/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

    <style>

        body {
            color: #000;
        }
        .odd{
            background-color: #FFF8FB !important;
        }
        .even{
            background-color: #DDEBF8 !important;
        }

        .panel-heading {
            padding: 5px 15px 2px 15px;
            margin-bottom: 0px;
        }

        .form-control {
            border-radius: 0px;
            font-size: x-small;
        }

        .input-group-addon {
            border-radius: 0px;
        }

        .table > thead > tr > th {
            padding: 4px;
            font-size: 12px;
        }

        .table > tbody > tr > td {
            padding: 4px;
            font-size: 11px;
        }

        body {
            color: black;
        }

        .help-block {
            color: red;
        }

        .btn-file {
            position: relative;
            overflow: hidden;
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

        input {
            color: black;
        }

        .emp_info > thead > tr > th {
            text-align: center;
        }

        .cnt {
            text-align: center;
        }


        .fnt_size {
            font-size: 12px;
            text-align: left;
        }

        .form-horizontal .control-label {
            padding-top: 3px;
            margin-bottom: 0;
            text-align: left;
        }


        .vertical-alignment-helper {
            display: table;
            height: 100%;
            width: 100%;
        }

        .vertical-align-center {
            /*To center vertically */
            display: table-cell;
            vertical-align: middle;
        }


        .form-control {
            height: 24px;

        }

        .lightbox{
            z-index: 1041;
        }
        .small-img{
            width: 100px;height: 100px;
        }

        .swal2-icon.swal2-warning {

            font-size: 15px !important;

        }
        .cls-req{
            color: red;
            font-weight: bold;
        }


    </style>
@endsection
@section('right-content')
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <section class="panel panel-info" id="data_table">
                <header class="panel-heading">
                    <label class="text-default">
                        My Application Status
                    </label>
                </header>

                <div class="panel-body">

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <form class="form-horizontal" method="get" action="">
                                <div class="col-md-8 col-sm-8 col-xs-8">
                                    <div class="form-group">
                                        <label class="col-sm-2 col-sm-2 control-label input-sm">Year: </label>
                                        <div class="col-sm-6 col-xs-6 col-md-6">
                                            <select name="req_year" id="req_year"
                                                    class="form-control input-sm m-bot15">
                                                <option value="" disabled>Select Year</option>
                                                <option value="all">All</option>
                                                @foreach($appData as $ei)
                                                    <option value="{{$ei->leave_year}}">{{$ei->leave_year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group">
                                        <div class="col-md-offset-2 col-sm-offset-2 col-md-2 col-sm-2 col-xs-2">
                                            <button type="button" id="btn_display" class="btn btn-default btn-sm">
                                                <i class="fa fa-check"></i> <b>Display Report</b></button>
                                        </div>
                                        <div class="col-md-offset-6 col-sm-offset-6 col-md-2 col-sm-2 col-xs-6">
                                            <div id="export_buttons">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12" id="loader" style="display: none; margin-top: 5px;">
            <div class="col-md-4 col-sm-4 col-md-offset-4 text-center">
                <div class="panel">
                    <img src="{{url('public/site_resource/images/preloader.gif')}}"
                         alt="Loading Report Please wait..." width="35px" height="35px"><br>
                    <span><b><i>Please wait...</i></b></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="report-body" style="display: none;">
        <div class="col-sm-12 col-md-12 col-xs-12">
            <section class="panel" id="data_table">
                <div class="panel-body">
                    <div class="table table-responsive">
                        <table id="leaveTbl" class="display table table-bordered table-striped" style="width:100%;text-align: center">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>IR No. </th>
                                <th>Item Name</th>
                                <th>GL</th>
                                <th>Cost Center</th>
                                <th>Product Quantity</th>
                                <th>Unit</th>
                                <th>Approval</th>
                                <th>Remarks</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Update Issue</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="edit_ir_no" class="control-label col-sm-2">IR No.</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_ir_no" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_item_id" class="control-label col-sm-2">Item Name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_item_id" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_gl_id" class="control-label col-sm-2">GL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_gl_id" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_cost_center" class="control-label col-sm-2">Cost Center <span class='cls-req'>*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_cost_center" value="" >
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="edit_pr_qty" class="control-label col-sm-2">Product Quantity <span class='cls-req'>*</span></label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="edit_pr_qty" value="" min="1">
                                <small style="display: none;color: red" id="pr_qty_sml_txt">Quantity must be greater than 0</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_unit" class="control-label col-sm-2">Unit <span class='cls-req'>*</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_unit" value="" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_apr_date" class="control-label col-sm-2">Approve Date</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_apr_date" value="" disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="edit_remarks" class="control-label col-sm-2">Remarks</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="edit_remarks" onkeyup="this.value = this.value.toUpperCase();" value="">
                            </div>
                        </div>
                        <input type="hidden" id="edit_item_tbl_id" value="">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-info" id="edit_item_btn">Update</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('footer-content')
    {{date('Y')}} &copy; Incepta Pharmaceuticals Ltd.
@endsection
@section('scripts')

    {{Html::script('public/site_resource/js/bootstrap-lightbox.min.js')}}

    {{Html::script('public/site_resource/js/bootstrap-datepicker.js')}}
    {{Html::script('public/site_resource/js/toast/toastr.min.js')}}
    {{Html::script('public/site_resource/js/jquery.dataTables.min.js')}}
    {{Html::script('public/site_resource/js/dataTables.bootstrap.min.js')}}

    {{Html::script('public/site_resource/js/dataTables.buttons.min.js')}}
    {{Html::script('public/site_resource/js/buttons.bootstrap.min.js')}}
    {{Html::script('public/site_resource/js/buttons.flash.min.js')}}

    {{Html::script('public/site_resource/js/jszip.min.js')}}
    {{Html::script('public/site_resource/js/pdfmake.min.js')}}
    {{Html::script('public/site_resource/js/vfs_fonts.js')}}

    {{Html::script('public/site_resource/js/buttons.html5.min.js')}}

    {{--Date--}}
    {{--{{Html::script('public/site_resource/dpicker/moment-with-locales.js')}}--}}
    {{--{{Html::script('public/site_resource/dpicker/bootstrap-datetimepicker.js')}}--}}

    {{Html::script('public/site_resource/select2/select2.min.js')}}
    {{Html::script('public/site_resource/js/salert/sweetalert2@11.js')}}


    <script type="text/javascript">

        $(document).ready(function () {

            $("#edit_pr_qty").keyup(function(){
                var pr_qty = $("#edit_pr_qty").val();
                if(pr_qty<=0){
                    $("#pr_qty_sml_txt").css('display','block');
                }else{
                    $("#pr_qty_sml_txt").css('display','none');
                }



            });

            $('#req_year').select2();
            var rsp_idx;
            var dat1, dat2;
            var rsp_eename, rsp_eemail;
            var current_image = '';


            $('#btn_display').on('click',function(){
                console.log($('#req_year').val());
                var req_year = $('#req_year').val();
                var req_emp_id = "{{ Auth::user()->user_id }}";

                if ($("#report-body").is(":visible")) {
                    $("#report-body").hide();
                }

                $("#loader").show();

                $.ajax({
                    type: "GET",
                    dataType: 'json',
                    data: {emp_id: req_emp_id,req_year:req_year},
                    url: "{{ url('stationery/issueItem/get_my_issues') }}",
                    success: function (resp) {
                        $("#loader").hide();
                        $("#report-body").show();

                        console.log('Output data: ');
                        console.log(resp)

                        $("#leaveTbl").DataTable().destroy();
                        table = $("#leaveTbl").DataTable({
                            data: resp,
                            autoWidth: true,
                            dom: 'Bfrtip',
                            buttons: [
                                'copyHtml5',
                                'excelHtml5',
                                'csvHtml5',
                                'pdfHtml5'
                            ],
                            columns: [
                                {data: "id"},
                                {data: "ir_no"},
                                {data: "item_name"},
                                {data: "gl"},
                                {data: "cost_center"},
                                {data: "pr_qty"},
                                {data: "unit"},
                                {data: "approved_date",

                                    'render': function (data, type, row) {
                                        if(data!=null){
                                            return '<button class="btn btn-success btn-sm">Approved</button>'
                                        }else{
                                            return '<button class="btn btn-danger btn-sm">Pending</button>'
                                        }

                                    }
                                },
                                {data: "remarks"},


                                {
                                    data: null,
                                    orderable: false,
                                    'render': function (data, type, row) {

                                        if(row.approved_date==null){
                                            return '<button class=\"btn btn-sm btn-primary row-edit ' +
                                                'dt-center\" id="' + row.id +'" ' +
                                                'onclick="editThisRecord('+"'"+row.id+"','"+row.ir_no+"','"+row.item_name+"','"+row.gl+"','"
                                                +row.cost_center+"','"+row.pr_qty+"','"+row.unit+"','"+row.approved_date+"','"+row.remarks+"')"+'">EDIT</button>'

                                        }else{
                                            return '<button class="btn btn-primary"  onclick="showEditFn()">Edit</button>'

                                        }

                                    }

                                },
                                {
                                    data: null,
                                    orderable: false,
                                    'render': function (data, type, row) {

                                        if(row.approved_date==null){
                                            return '<button class=\"btn btn-sm btn-danger row-remove ' +
                                                'dt-center\" id="' + row.id +'" ' +
                                                'onclick="deleteThisRecord('+"'"+row.id+"','"+row.ir_no+"')"+'">Delete</button>'

                                        }else{
                                            return '<button class="btn btn-sm btn-danger"  onclick="showDeleteFn()">Delete</button>'

                                        }

                                    }

                                },
                            ],
                            order:[],
                            fixedHeader: {
                                header: true,
                                headerOffset: $('#fix').height()

                            },
                            language: {
                                "emptyTable": "No Matching Records Found."
                            },
                            columnDefs: [
                                {
                                    "targets": [ 0 ],
                                    "visible": false
                                }
                            ],
                            info: true,
                            paging: true,
                            filter: true

                        });

                    },
                    error: function (err) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to Fetch Data',
                            icon: 'error',
                            showConfirmButton: true,
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                });

            });

            $('#edit_item_btn').on('click', function (e) {
                e.preventDefault();
                var edit_item_tbl_id = $('#edit_item_tbl_id').val();
                var edit_pr_qty = $('#edit_pr_qty').val();
                var edit_remarks = $('#edit_remarks').val();
                var edit_ir_no = $('#edit_ir_no').val();
                var edit_apr_date = $('#edit_apr_date').val();
                var edit_unit = $('#edit_unit').val();
                var edit_cost_center = $('#edit_cost_center').val();

                if(edit_pr_qty === ""||edit_cost_center === ""||edit_unit === ""){
                    if(edit_pr_qty === ""){

                        Swal.fire({
                            title: 'Error!',
                            text: 'Please input Product quantity!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })

                    }else if(edit_cost_center === ""){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please input cost center!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })

                    }else if(edit_unit === ""){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please input unit!',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        })

                    }

                }
                else{
                    $.ajax({
                        type: 'post',
                        url: '{{  url('stationery/issueItem/update_my_issues') }}',
                        data: {'edit_item_tbl_id':edit_item_tbl_id, 'edit_pr_qty':edit_pr_qty,'edit_remarks':edit_remarks,
                            'edit_ir_no':edit_ir_no,'edit_unit':edit_unit,'edit_cost_center':edit_cost_center, '_token': "{{csrf_token() }}"},
                        success: function (data) {
                            $("#editItemModal").modal('hide');
                            if(data.response == 1 || data.response == true){
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: 'Item has been updated Successfully',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.reload();
                                    }
                                })
                            }else if(data.response == 2){
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Insufficient Input',
                                    icon: 'error',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                })
                            }else{
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Failed to Update',
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

            $(function () {
                $('#modal').modal('toggle');
            });

        });

        function showDeleteFn(){
            Swal.fire({
                title: 'Opps!',
                text: 'Already approved can not delete',
                icon: 'error',
                showConfirmButton: true,
                confirmButtonText: 'Ok'
            })
        }

        function showEditFn(){
            Swal.fire({
                title: 'Opps!',
                text: 'Already approved can not update',
                icon: 'error',
                showConfirmButton: true,
                confirmButtonText: 'Ok'
            })

        }

        function editThisRecord(id, ir_no, item_name, gl, cost_center, pr_qty, unit,approved_date,remarks ){
            $('#edit_ir_no').val(ir_no);
            $('#edit_item_id').val(item_name);
            $('#edit_gl_id').val(gl);
            $('#edit_cost_center').val(cost_center);
            $('#edit_unit').val(unit);
            $('#edit_apr_date').val(approved_date);
            $('#edit_item_tbl_id').val(id);

            if(pr_qty =='null'){
                $('#edit_pr_qty').val('');
            }else{
                $('#edit_pr_qty').val(pr_qty);
            }

            if(approved_date =='null'){
                $('#edit_apr_date').val('');
            }else{
                $('#edit_apr_date').val(approved_date);
            }

            if(remarks =='null'){
                $('#edit_remarks').val('');
            }else{
                $('#edit_remarks').val(remarks);

            }

            if(unit =='null'){
                $('#edit_unit').val('');
            }else{
                $('#edit_unit').val(unit);

            }

            $("#editItemModal").modal('show');
        }

        function deleteThisRecord(id, ir_no){
            console.log(ir_no);

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
                        url: '{{  url('stationery/issueItem/delete_my_issues') }}',
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

        @if(Session::has('message'))
        var type = "";
        type = "{{ Session::get('alert-type', 'info') }}";
        switch (type) {

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif


    </script>

@endsection
