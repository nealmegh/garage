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
                        <h4>Create <strong>Customer</strong></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
            <form class="form-horizontal create_customer" role="form" method="POST" action="{{ route('customer.store')}}">

                    @csrf

                    <div class="box-body">

                      <div class="row">

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Customer Name</label><br>
                            <input type="text" class="form-control" name="customer_name" placeholder="Full name">
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>E-mail</label>
                            <input type="email" class="form-control" name="customer_email" placeholder="abc@xyz.com">
                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <div class="col-sm-12">
                          <div class="form-group">
                            <label>Address</label><br>
                            <textarea class="form-control" placeholder="Enter current address ... " name="customer_address"></textarea>
                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Contact Mobile</label><br>
                            <input type="text" name="customer_contact1" class ='form-control' placeholder = '' required="required" maxlength="11" minlength="10"/>
                          </div>
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group">
                            <label>Alternate Mobile</label><br>
                            <input type="text" name="customer_contact2" class ='form-control' placeholder = '' maxlength="11" minlength="10"/>
                          </div>
                        </div>

                      </div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button type="reset" class="btn btn-danger pull-left">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
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
