
<!-- Modal -->
@foreach($drivers as $driver)
    @php
        $loans = $driver->loans->sum('due_amount');
        $due = $driver->rents->sum('due');
        $damage = $driver->damages->sum('driver_due_amount');
        $total_due = $loans + $due + $damage;
    @endphp
<div class="modal fade" id="{{$driver->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1140px" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{$driver->user->name}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="amount" class=" form-control-label">Rent Due </label>
                        </div>
                        <div class="col col-md-9">
                            <label for="amount" class=" form-control-label">{{$due}}</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="amount" class=" form-control-label">Loan Due</label>
                        </div>
                        <div class="col col-md-9">
                            <label for="amount" class=" form-control-label">{{$loans}}</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="amount" class=" form-control-label">Damage Due</label>
                        </div>
                        <div class="col col-md-9">
                            <label for="amount" class=" form-control-label">{{$damage}}</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="amount" class=" form-control-label">Total Due Amount</label>
                        </div>
                        <div class="col col-md-9">
                            <label for="amount" class=" form-control-label">{{$total_due}}</label>
                        </div>
                    </div>
                <div class="col-12" style="display: block">
                    <div class="col col-md-4" style="float: left">
                    <label class=" form-control-label" style="display: block; text-align: center;">DL</label>

                    <img src='{{ asset('storage/'.$driver->details->license_photo) }}' style="height: 300px; width: 100%;">
                        <a class="btn btn-primary" style="display: block; text-align: center;" href="{{ asset('storage/'.$driver->details->license_photo) }}" target="_blank">View</a>
                    </div>
                    <div class="col col-md-4" style="float: left">
                    <label class=" form-control-label" style="display: block; text-align: center;">NID</label>
                    <img src='{{ asset('storage/'.$driver->details->nid_photo) }}' style="height: 300px; width: 100%;">
                        <a class="btn btn-primary" style="display: block; text-align: center;" href="{{ asset('storage/'.$driver->details->nid_photo) }}" target="_blank">View</a>
                    </div>
                    <div class="col col-md-4" style="float: left">
                        <label class=" form-control-label" style="display: block; text-align: center;">Driver Photo</label>
                        <img src='{{ asset('storage/'.$driver->details->driver_photo) }}' style="height: 300px; width: 100%;">
                        <a class="btn btn-primary" style="display: block; text-align: center;" href="{{ asset('storage/'.$driver->details->driver_photo) }}" target="_blank">View</a>
                    </div>
                </div>
                    <div class="modal-footer" >
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
            </div>

        </div>
    </div>
</div>
@endforeach

