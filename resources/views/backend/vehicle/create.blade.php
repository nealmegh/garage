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
@endsection
@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Create <strong>Vehicle</strong></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{route('vehicle.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="type" class=" form-control-label">Select Vehicle Type</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="type" id="type" class="form-control selectpicker" >
                                <option value="" disabled>Please select</option>
                                <option value="1">CNG</option>
                                <option value="2">Micro-Bus</option>
                                <option value="3">Sedan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="owner_id" class=" form-control-label">Select Owner</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="owner_id" id="owner_id" class="form-control selectpicker" data-live-search="true">
                                <option value="" disabled>Please select</option>
                                @foreach($owners as $owner)
                                <option value="{{$owner->id}}">{{$owner->user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Registration Number</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="registration_number" name="registration_number" placeholder="" class="form-control">
                            <small class="form-text text-muted">Eg. Dhaka Metro La 15-3593</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="tax_token" class=" form-control-label">Tax Token</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="tax_token" name="tax_token"  class="form-control">
                            <small class="help-block form-text">Tax Token</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="tax_token_validity" class=" form-control-label">Tax Token Validity</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="tax_token_validity" name="tax_token_validity" placeholder="Enter Date" class="form-control date">
                            <small class="help-block form-text">Last Valid Date</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="route_permit_number" class=" form-control-label">Route Permit</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="route_permit_number" name="route_permit_number"  class="form-control">
                            <small class="help-block form-text">Route Permit Number</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="route_permit_validity" class=" form-control-label">Route Permit Validity</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="route_permit_validity" name="route_permit_validity" placeholder="Enter Date" class="form-control date">
                            <small class="help-block form-text">Last Valid Date</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Fitness Number</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="fitness_number" name="fitness_number" placeholder="" class="form-control">
                            <small class="form-text text-muted">Eg. Dhaka Metro La 15-3593</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">Fitness Validity</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="fitness_validity" name="fitness_validity" placeholder="Enter Date" class="form-control date">
                            <small class="help-block form-text">Last Valid Date</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="text-input" class=" form-control-label">Insurance Number</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="insurance_number" name="insurance_number" placeholder="" class="form-control">
                            <small class="form-text text-muted">Eg. Dhaka Metro <La></La> 15-3593</small>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">Insurance Validity</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="insurance_validity" name="insurance_validity" placeholder="Enter Date" class="form-control date">
                            <small class="help-block form-text">Last Valid Date</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="asset_value" class=" form-control-label">Asset Value</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="asset_value" name="asset_value" class="form-control ">
                            <small class="help-block form-text">Asset Value</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="registration_img" class=" form-control-label">Registration Photo</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="registration_img" name="registration_img"  class="form-control" >
                            <small class="help-block form-text">Registration Photo</small>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="tax_img" class=" form-control-label">Tax Token Photo</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="tax_img" name="tax_img"  class="form-control" >
                            <small class="help-block form-text">Tax Token Photo</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="route_permit_img" class=" form-control-label">Route Permit Photo</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="route_permit_img" name="route_permit_img"  class="form-control " >
                            <small class="help-block form-text">Route Permit Photo</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="fitness_img" class=" form-control-label">Fitness Photo</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="fitness_img" name="fitness_img"  class="form-control " >
                            <small class="help-block form-text">Fitness Photo</small>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="insurance_img" class=" form-control-label">Insurance Photo</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="insurance_img" name="insurance_img"  class="form-control " >
                            <small class="help-block form-text">Insurance Photo</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-dot-circle"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                            <i class="fa fa-ban"></i> Reset
                        </button>
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
    <script src="{{asset('base/plugins/select2/custom-select2.js')}}"></script>
    <script src="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('base/plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('base/plugins/flatpickr/custom-flatpickr.js')}}"></script>
    <script src="{{asset('base/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>

    <script>
        //First upload
        // var firstUpload = new FileUploadWithPreview('photo')
    </script>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
   <script>
       var nowDate = new Date();
       var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
       $(function() {
           $('.date').daterangepicker({
               singleDatePicker: true,
               showDropdowns: true,
               minDate: today,
               locale: {
                   format: 'MM/DD/YYYY'
               }
           });
       });

   </script>
@endsection
