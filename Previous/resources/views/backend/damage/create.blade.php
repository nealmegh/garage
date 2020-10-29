@extends('layouts.base')

@section('content')
{{--    <div class="col-lg-6">--}}
        <div class="card">
            <div class="card-header">
                Create <strong>Rent</strong>
            </div>
            <div class="card-body card-block">
                <form action="{{route('rent.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="rent_type" class=" form-control-label">Rent Type</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="rent_type" id="rent_type" class="form-control">
                                <option value="0">Please select</option>
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
                            <select name="vehicle_id" id="vehicle_id" class="form-control">
                                <option value="0">Please select</option>
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
                            <select name="driver_id" id="driver_id" class="form-control">
                                <option value="0">Please select</option>
                                @foreach($drivers as $driver)
                                <option value="{{$driver->id}}">{{$driver->user->name}}</option>
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
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </form>
            </div>

        </div>

{{--    </div>--}}

@endsection

@section('js')
@section('js')

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
