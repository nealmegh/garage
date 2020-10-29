@extends('layouts.base2')
@section('head')

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('base/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link href="{{asset('base/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <!--  END CUSTOM STYLE FILE  -->
@endsection

@section('content')


<div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
    <div class="statbox widget box box-shadow">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h4>Create <strong>Rent</strong></h4>
                </div>
            </div>
        </div>
        <div class="widget-content widget-content-area">
            <form action="{{route('rent.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="rent_type" class=" form-control-label">Rent Type</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="rent_type" id="rent_type" class="form-control selectpicker" required>
                            <option value="" disabled selected>Select Trip Type</option>
                            <option value="1">1st Half</option>
                            <option value="2">2nd Half</option>
                            <option value="3">Full-Day</option>
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="vehicle_id" class=" form-control-label">Vehicle</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="vehicle_id" id="vehicle_id" class="form-control basic" required>
                            <option value="" disabled selected>Select Vehicle</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{$vehicle->id}}">{{$vehicle->registration_number}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="driver_id" class=" form-control-label">Driver</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <select name="driver_id" id="driver_id" class="form-control basic" required>
                            <option value="" disabled selected>Select Driver</option>
                            @foreach($drivers as $driver)
                                <option value="{{$driver->id}}">{{$driver->user->name}} - {{$driver->phone_number}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="rent_date" class=" form-control-label">Rent Date</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="rent_date" name="rent_date" placeholder="Enter Date" class="form-control date">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="start_time" class=" form-control-label">Starting Time</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="start_time" name="start_time" class="form-control time">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="end_time" class=" form-control-label">Ending Time</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="end_time" name="end_time" class="form-control time">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="Remarks" class=" form-control-label">Remarks</label>
                    </div>
                    <div class="col-12 col-md-9">
                        <input type="text" id="remarks" name="remarks" placeholder="Remarks" class="form-control">
                        <small class="help-block form-text">E.g. Any Broken Parts</small>
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
       var ss = $(".basic").select2({
           tags: true,
       });
   </script>
    <script>
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        var now = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), nowDate.getHours(), nowDate.getMinutes());
        // console.log(now);
        $('.time').daterangepicker({

            timePicker: true,
            singleDatePicker: true,
            timePicker24Hour: false,
            startDate: now,
            timePickerIncrement: 15,
            timePickerSeconds: false,
            locale: {
                format: 'HH:mm'
            }
        }).on('show.daterangepicker', function (ev, picker) {
            picker.container.find(".calendar-table").hide();
        });
    </script>
   <script>
       var nowDate = new Date();
       var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
       var now = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), nowDate.getHours(), nowDate.getMinutes());
       // console.log(now);
       $('#end_time').daterangepicker({

           timePicker: true,
           singleDatePicker: true,
           timePicker24Hour: false,
           startDate: '00:00',
           timePickerIncrement: 15,
           timePickerSeconds: false,
           locale: {
               format: 'HH:mm'
           }
       }).on('show.daterangepicker', function (ev, picker) {
           picker.container.find(".calendar-table").hide();
       });
   </script>
@endsection
