
<!-- Modal -->
@foreach($vehicles as $vehicle)

<div class="modal fade" id="{{$vehicle->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1140px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$vehicle->registration_number}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="amount" class=" form-control-label">Asset Value </label>
                    </div>
                    <div class="col col-md-9">
                        <label for="amount" class=" form-control-label">{{$vehicle->asset_value}}</label>
                    </div>
                </div>
{{--                <div class="row form-group">--}}
{{--                    <div class="col col-md-3">--}}
{{--                        <label for="amount" class=" form-control-label">Total Maintenance</label>--}}
{{--                    </div>--}}
{{--                    <div class="col col-md-9">--}}
{{--                        <label for="amount" class=" form-control-label">{{20}}</label>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-12" style="display: block">
                    <div class="col col-md-6" style="float: left">
                        <label class=" form-control-label" style="display: block; text-align: center;">Vehicle Registration</label>

                        <img src='{{ asset('storage/'.$vehicle->details->registration_img) }}' style="height: 300px; width: 538px;">
                        <a class="btn btn-primary" style="display: block; text-align: center;" href="{{ asset('storage/'.$vehicle->details->registration_img) }}" target="_blank">View</a>
                    </div>
                    <div class="col col-md-6" style="float: left">
                        <label class=" form-control-label" style="display: block; text-align: center;">Fitness</label>
                        <img src='{{ asset('storage/'.$vehicle->details->fitness_img) }}' style="height: 300px; width: 538px;">
                        <a class="btn btn-primary" style="display: block; text-align: center;" href="{{ asset('storage/'.$vehicle->details->fitness_img) }}" target="_blank">View</a>
                    </div>
                </div>
                <div class="col-12" style="display: block">
                    <div class="col col-md-6" style="float: left">
                        <label class=" form-control-label" style="display: block; text-align: center;">Tax Token</label>

                        <img src='{{ asset('storage/'.$vehicle->details->tax_img) }}' style="height: 300px; width: 538px;">
                        <a class="btn btn-primary" style="display: block; text-align: center;" href="{{ asset('storage/'.$vehicle->details->tax_img) }}" target="_blank">View</a>
                    </div>
                    <div class="col col-md-6" style="float: left">
                        <label class=" form-control-label" style="display: block; text-align: center;">Insurance</label>
                        <img src='{{ asset('storage/'.$vehicle->details->insurance_img) }}' style="height: 300px; width: 538px;">
                        <a class="btn btn-primary" style="display: block; text-align: center;" href="{{ asset('storage/'.$vehicle->details->insurance_img) }}" target="_blank">View</a>
                    </div>
                </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </div>

        </div>
    </div>
</div>
@endforeach

