
<div class="modal fade" id="payCase" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Case Payment</h5>
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
                            <label for="case_id" class=" form-control-label">Case ID</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="case_id" id="case_id" class="form-control" required>
                                <option value="">Please select</option>
                                @foreach($cases as $case)
                                    <option value="cp-{{$case->id}}">{{$case->case_id}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @foreach($cases as $case)
                        <div class="case_payment" id="cp-{{$case->id}}" style="display: none">
                            <div class="row form-group "   disabled>
                                <div class="col col-md-3">
                                    <label for="due_amount" class=" form-control-label">Case Penalty</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="due_amount" name="due_amount" placeholder="Amount" value="{{$case->penalty}}" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="payment_for" value="casePayment">
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
