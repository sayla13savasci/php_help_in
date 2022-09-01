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
                    <div class="form-horizontal">
                        <form class="form-horizontal issue_item_id" >
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">

                                        <div class="col-md-3 col-sm-3">
                                            <label for="item_id_search" class="col-md-3 col-sm-3 control-label fnt_size"
                                                   style="padding-right:0px;"><b>Item ID</b></label>
                                            <div class="col-md-9 col-sm-9">
                                                <input type="text" class="form-control input-sm"
                                                       value="" placeholder="Choose an item" name="item_id_search"
                                                       id="item_id_search" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <label for="item_name"
                                                   class="col-md-3 col-sm-3 control-label fnt_size"
                                                   style="padding-right:0px;"><b>Item Name</b></label>
                                            <div class="col-md-9 col-sm-9">
                                                <select id="item_name" name="item_name"
                                                        class="form-control input-sm ">
                                                    <option value="" selected >Select Item Name</option>
                                                    @foreach($item_name as $name)
                                                        <option value="{{$name->item_id}}"  >{{$name->item_name}}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-3">
                                            <div class="form-group">
                                                <div class="col-md-6 col-sm-6 col-xs-6" >
                                                    <button type="button" id="item_dispaly_button" class="btn btn-warning btn-sm" style="float: right;">
                                                        <i class="fa fa-chevron-circle-up"></i> <b>Display</b>
                                                    </button>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-6" style="padding-left: 0px;">
                                                    <div id="export_buttons" style="float: left">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12">

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>

        <form action="" id="item_issue_form">
            <div class="panel-body" style="margin-top: 10px;">
                <div class="row" style="margin-bottom: 10px;">
                    <div class="col-md-12">
                        <div class="panel" style="padding: 20px">
                            <fieldset class="scheduler-border" >
                                <legend class="scheduler-border">Issue An Item</legend>
                                <div class="col-md-12 ">
                                    <p class="cls-req">*(Fields are required)</p>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="item_id" title="Chamber Storage Condition"><b>Item Id</b>:</b><span  class="cls-req">*</span></label>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="item_id" placeholder=""
                                                   name="item_id">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="item_name" title="Chamber Storage Condition"><b>Item Name</b>:</b><span  class="cls-req">*</span></label>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="item_id" placeholder=""
                                                   name="item_name">
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="gl" title="Chamber Storage Condition"><b>Cost Center</b>:</b><span  class="cls-req">*</span></label>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="gl" placeholder=""
                                                   name="gl">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="text"><b>GL:</b><span  class="cls-req">*</span></label>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="cost_center" placeholder=""
                                                   name="cost_center">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="number"><b>Product Quantity:</b><span  class="cls-req">*</span></label>
                                            <input type="number" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="pr_qty" placeholder="Enter Product Quantity"
                                                   name="pr_qty" required>
                                        </div>
                                    </div>

                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label for="dissolutionmethod"><b>Unit:</b></label>
                                            <input type="text" onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="unit"
                                                   placeholder="" name="unit" >
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="email"><b>Remarks:</b></label>
                                            <input type="text"onkeyup="this.value = this.value.toUpperCase();"
                                                   class="form-control input-xs" id="remarks"
                                                   placeholder="Remarks.." name="remarks">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-8 col-md-offset-2 text-center" style="padding-top: 20px;">
                            <button type="button" id="item_issue_save_btn" class="btn btn-info btn-sm">
                                <i class="fa fa-check"></i> <b>SAVE</b></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-md-12 col-sm-12" id="loader" style="display: none; margin-top: 5px;">
        <div class="col-md-4 col-sm-4 col-md-offset-4 text-center">
            <div class="panel">
                <img src="{{url('public/site_resource/images/preloader.gif')}}"
                     alt="Loading Report Please wait..." width="35px" height="35px"><br>
                <span><b><i>Please wait...</i></b></span>
            </div>
            <div class="col-md-offset-6 col-sm-offset-6 col-md-2 col-sm-2 col-xs-6">
                <div id="export_buttons">
                </div>
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

            var item_id_search;
            var item_name;
            var item_id;

            $('#item_name').change(function () {
                item_id_search = $(this).val();
                item_name = $('#item_name option:selected').text();
                $('#item_id_search').val(item_id_search);
            });

            $('#item_dispaly_button').on('click', function (e) {
                e.preventDefault();
                $.ajax({
                    type: 'get',
                    url: '{{  url('stationery/form/issueItem/displayIssueItem') }}',
                    data: {
                        'item_id_search':item_id_search,
                        '_token': "{{ csrf_token () }}"
                    },
                    success: function (response) {
                        if(response!='error'){
                            $('#item_issue_form').autofill(response[0]);

                            item_id = $('#item_id').val();
                            $("#item_id").prop('readonly', true);
                            $("#gl").prop('readonly', true);
                            $("#cost_center").prop('readonly', true);
                            $("#item_name").prop('readonly', true);

                        }else{
                            Swal.fire({
                                title: 'Error!',
                                text: 'Item Not Found',
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                            $("#item_issue_form").trigger('reset');
                            item_id = $('#item_id').val('');
                        }
                    },
                    error: function (e) {
                        console.log(e);
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to fetch item',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });

                    }
                });
            });

            function objectifyForm(formArray) {
                //serialize data function
                var returnArray = {};
                for (var i = 0; i < formArray.length; i++) {
                    returnArray[formArray[i]['name']] = formArray[i]['value'];
                }
                return returnArray;
            }

            $('#item_issue_save_btn').on('click', function (e) {
                e.preventDefault();
                var productQuantity = $('#pr_qty').val();
                var issueItem= $('#item_issue_form').serializeArray();
                issueItem = objectifyForm(issueItem);

                if(productQuantity=='' || !item_id || item_id.length<=1){
                    if(!item_id || item_id.length<=1){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please select an item',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return 0;
                    }

                    if(productQuantity==''){
                        Swal.fire({
                            title: 'Error!',
                            text: 'Please input product quantity',
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                        return 0;
                    }

                }else{
                    $.ajax({
                        type: 'post',
                        url: '{{  url('stationery/form/issueItem/createIssue') }}',
                        data: {
                            'issueItem': issueItem,'item_id':item_id,'item_name':item_name,
                            '_token': "{{ csrf_token() }}"
                        },
                        success: function (response) {

                            if ( response == 1 || response == true) {
                                Swal.fire({
                                    title: 'Success!',
                                    icon: 'success',
                                    text: 'New item has been inserted successfully',
                                    showConfirmButton: true,
                                    confirmButtonText: 'Ok'
                                })
                                $("#item_issue_form").trigger('reset');
                                item_id = $('#item_id').val('');
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Something was wrong! Data was not saved.',
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


        });

    </script>
    @endsection
    @section('footer-content')
    {{date('Y')}} &copy; Incepta Pharmaceuticals Ltd.
@endsection