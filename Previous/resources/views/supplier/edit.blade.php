@extends('layouts.base2')
@section('head')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('base/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link href="{{asset('base/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="{{asset('base/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <style>
        .ui-autocomplete {
            position: absolute;
            z-index: 1000;
            cursor: default;
            padding: 0;
            margin-top: 2px;
            list-style: none;
            background-color: #ffffff;
            border: 1px solid #ccc;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .ui-autocomplete > li {
            padding: 3px 20px;
        }
        .ui-autocomplete > li.ui-state-focus {
            background-color: #DDD;
        }
        .ui-helper-hidden-accessible {
            display: none;
        }
        .ui-menu-item a.ui-state-focus {
            background: #faa; !important;
        }
    </style>

@endsection
@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Edit <strong>Supplier</strong></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
            <form class="form-horizontal create_supplier" role="form" method="POST" action="{{ route('supplier.update', $supplier->id)}}">

                @csrf

                <div class="box-body">

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Supplier Name</label><br>
                                <input type="text" class="form-control" name="supplier_name" placeholder="Full name" value="{{$supplier->supplier_name}}">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" name="supplier_email" placeholder="abc@xyz.com" value="{{$supplier->supplier_email}}">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label><br>
                                <textarea class="form-control" placeholder="Enter current address ... " name="supplier_address">{{$supplier->supplier_address}}</textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Contact Mobile</label><br>
                                <input type="text" name="supplier_contact1" class ='form-control' placeholder = '' required="required" maxlength="11" minlength="10" value="{{$supplier->supplier_contact1}}"/>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alternate Mobile</label><br>
                                <input type="text" name="supplier_contact2" class ='form-control' placeholder = '' maxlength="11" minlength="10" value="{{$supplier->supplier_contact2}}"/>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Save</button>
                </div>
            </form>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script src="{{asset('base/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('base/plugins/select2/select2.min.js')}}"></script>
    {{--    <script src="{{asset('base/plugins/select2/custom-select2.js')}}"></script>--}}
    <script src="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    {{--    <script src="{{asset('base/plugins/flatpickr/flatpickr.js')}}"></script>--}}
    {{--    <script src="{{asset('base/plugins/flatpickr/custom-flatpickr.js')}}"></script>--}}
    <script src="{{asset('base/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        //First upload
        // var firstUpload = new FileUploadWithPreview('photo')
    </script>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
@endsection
