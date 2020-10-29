
<!-- Modal -->

<div class="modal fade" id="collectCase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Case Collection</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <input type="hidden" id="type" name="type" class="form-control" value="Debit">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="cDriver_id" class=" form-control-label">Driver</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="cDriver_id" id="cDriver_id" class="form-control">
                                <option value="0">Please select</option>
                                @foreach($drivers as $driver)
                                    <option value="dc-{{$driver->id}}">{{$driver->user->name}}-{{$driver->phone_number}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="amount" class=" form-control-label">Amount</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="amount" name="amount" placeholder="Amount" class="form-control">
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
                    @foreach($drivers as $driver)
                        <div class="collect_case" id="dc-{{$driver->id}}" style="display: none">
                            <div class="row form-group "   disabled>
                                <div class="col col-md-3">
                                    <label for="due_amount" class=" form-control-label">Total Due Amount</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="due_amount" name="due_amount" placeholder="Amount" value="{{$driver->cases->sum('due_amount')}}" class="form-control" disabled>
                                </div>
                            </div>
{{--                            <div class="row form-group "  disabled>--}}
{{--                                <div class="col col-md-3">--}}
{{--                                    <label for="balance" class=" form-control-label">Total Balance</label>--}}
{{--                                </div>--}}
{{--                                <div class="col-12 col-md-9">--}}
{{--                                    <input type="number" id="balance" name="balance" placeholder="Amount" value="{{$supplier->balance}}" class="form-control" disabled>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    @endforeach
                    <input type="hidden" name="payment_for" value="collectCase">
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
