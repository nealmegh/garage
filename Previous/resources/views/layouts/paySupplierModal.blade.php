
<!-- Modal -->

<div class="modal fade" id="supplierPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Supplier Payment</h5>
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
                            <input type="number" id="amount" name="amount" placeholder="Amount" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="supplier_id" class=" form-control-label">Supplier</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="supplier_id" id="supplier_id" class="form-control">
                                <option value="0">Please select</option>
                                @foreach($suppliers as $supplier)
                                    <option value="s-{{$supplier->id}}">{{$supplier->supplier_name}}</option>
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
                    @foreach($suppliers as $supplier)
                        <div class="sup_payment" id="s-{{$supplier->id}}" style="display: none">
                            <div class="row form-group "   disabled>
                                <div class="col col-md-3">
                                    <label for="due_amount" class=" form-control-label">Total Due Amount</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="due_amount" name="due_amount" placeholder="Amount" value="{{$supplier->due}}" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="row form-group "  disabled>
                                <div class="col col-md-3">
                                    <label for="balance" class=" form-control-label">Total Balance</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="balance" name="balance" placeholder="Amount" value="{{$supplier->balance}}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="payment_for" value="supplierPayment">
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

