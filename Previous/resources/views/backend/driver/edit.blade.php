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
                        <h4>Edit <strong>Driver</strong></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
                <form action="{{route('driver.update', $driver->id)}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="name" class=" form-control-label">Name</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="name" name="name" placeholder="" class="form-control" value="{{$driver->user->name}}">

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="address" class=" form-control-label">Address</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="address" name="address" placeholder="" class="form-control" value="{{$driver->address}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nid" class=" form-control-label">NID</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="nid" name="nid" placeholder="Enter NID" class="form-control" value="{{$driver->details->nid}}" >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="phone_number" class=" form-control-label">Phone Number</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="phone_number" minlength="11" name="phone_number" placeholder="Phone" class="form-control" required value="{{$driver->phone_number}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="license_number" class=" form-control-label">License Number</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="license_number" minlength="15" name="license_number" placeholder="License" class="form-control" required value="{{$driver->license_number}}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="license_validity" class=" form-control-label">License Validity</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="license_validity" name="license_validity" placeholder="Enter Date" class="form-control date" required value="{{$driver->license_validity}}">
                            <small class="help-block form-text">Last Valid Date</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="ref_name" class=" form-control-label">Reference</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="ref_name" name="ref_name" placeholder="" class="form-control" value="{{$driver->ref_name}}">

                        </div>
                    </div>
					<div class="row form-group">
                        <div class="col col-md-3">
                            <label for="ref_phone" class=" form-control-label">Reference Phone</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="ref_phone" name="ref_phone" placeholder="" class="form-control" value="{{$driver->ref_phone}}">

                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="license_photo" class=" form-control-label">License Photo</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="license_photo" name="license_photo"  class="form-control " >
                            <small class="help-block form-text">Driving License Photo</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="nid_photo" class=" form-control-label">NID Photo</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="nid_photo" name="nid_photo"  class="form-control "  value="{{ asset('storage/'.$driver->details->nid_photo) }}">
                            <small class="help-block form-text">NID Photo</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="driver_photo" class=" form-control-label">Driver Photo</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="file" id="driver_photo" name="driver_photo"  class="form-control " >
                            <small class="help-block form-text">Driver Photo</small>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" value="submit" class="btn btn-primary">
                            <i class="far fa-dot-circle"></i> Submit
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
            let whatIs = {!! $driver->license_validity !!}
            console.log(whatIs);
            // $('#license_validity').daterangepicker('setDate', date);
            $('#license_validity').daterangepicker({

                singleDatePicker: true,
                showDropdowns: true,
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: ' - ',
                }
            },function(start, end, label) {
                // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
@endsection
