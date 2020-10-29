
<!-- Modal -->

<div class="modal fade" id="loan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Loan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <input type="hidden" id="type" name="type" class="form-control" value="Credit">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="amount" class=" form-control-label">Amount</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="amount" name="amount" placeholder="Amount" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="driver_id" class=" form-control-label">Driver</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="driver_id" id="l_driver_id" class="form-control">
                                <option value="0">Please select</option>
                                @foreach($drivers as $driver)
                                    <option value="{{$driver->id}}">{{$driver->user->name}}-{{$driver->phone_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="notes" class=" form-control-label">Note</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="notes" name="notes" placeholder="Note" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="payment_for" value="loan">
                    <input type="hidden" name="method" value="cash">

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

