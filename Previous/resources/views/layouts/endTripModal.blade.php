
<!-- Modal -->
@foreach($rents as $rent)
<div class="modal fade bd-example-modal-lg" id="rent{{$rent->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" >
        <div class="modal-content" style="background-color: #0e2231">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">End Trip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('rent.end')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="rent" class=" form-control-label">Rent</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="rent" name="rent" placeholder="Rent" class="form-control" value="{{$rent->rent}}" disabled>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="gate" class=" form-control-label">Gate Charge</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="gate" name="gate" placeholder="Gate Charge" class="form-control" value="{{20.00}}" disabled>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="discount" class=" form-control-label">Discount</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="discount" name="discount" placeholder="Discount" class="form-control" value="" >
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="collection" class=" form-control-label">Collection</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="number" id="collection" name="collection" placeholder="Collection" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="case" class=" form-control-label">Case</label>
                        </div>
                        <div class="col-12 col-md-9">

                            <input type="checkbox" id="toggle-case" name="case" value="yes" onclick="toggle('.case_yes', this)" >
                        </div>
                    </div>
                    <div id="case_yes" class="case_yes" style="display: none">
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="case_id" class=" form-control-label">Case ID</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="case_id" name="case_id" placeholder="Case ID" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="penalty" class=" form-control-label">Penalty Amount</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="penalty" name="penalty" placeholder="Penalty Amount" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="law" class=" form-control-label">Law Section</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="law" name="law" placeholder="Law Section" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="doc_type" class=" form-control-label">Ceased Doc Type</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="doc_type" id="doc_type" class="form-control ">
                                <option value="0">Please select</option>
                                <option value="registration">{{'Registration Paper'}}</option>
                                <option value="driving">{{'Driving License'}}</option>
                                <option value="fitness">{{'Fitness'}}</option>
                                <option value="insurance">{{'Insurance'}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="last_date" class=" form-control-label">Last Date</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="last_date" name="last_date" placeholder="Last Date" class="form-control date">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="paid_by" class=" form-control-label">Paid By</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="paid_by" id="paid_by" class="form-control ">
                                <option value="0">Please select</option>
                                <option value="driver">{{$rent->driver->user->name}}</option>
                                <option value="owner">{{'Owner'}}</option>
                            </select>
                        </div>
                    </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="damage" class=" form-control-label">Damage</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="checkbox" id="toggle-case" name="damage" value="yes" onclick="toggle('.damage_yes', this)" >
                        </div>
                    </div>
                    <div class="damage_yes" style="display:none;">
                        <div class="row form-group">
                            <div class="form-group col-md-12">
                                <div class="col col-md-3">
                                    <label for="damage_amount" class=" form-control-label">Damage Amount</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="damage_amount" name="damage_amount" placeholder="Damage Amount" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <div class="col col-md-3">
                                    <label for="damage_amount" class=" form-control-label">Damage Details</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" id="damage_amount" name="details" placeholder="Damage Details" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="col col-md-12">
                                    <label for="damage_amount" class=" form-control-label">Partial Payment</label>
                                </div>
                                <div class="col-12 col-md-12">
                                    <input type="checkbox" id="toggle-case" name="partial_payment" value="yes" onclick="toggle('.partial_yes', this)" >
                                </div>
                            </div>
                            <div class=" col col-md-12 partial_yes" style="display:none;">
                                <div class="col col-md-3">
                                    <label for="damage_amount" class=" form-control-label">Partial Amount</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="damage_amount" name="partial_payment_amount" placeholder="Partial Amount" class="form-control">
                                </div>
                                <div class="col col-md-3">
                                    <label for="damage_amount" class=" form-control-label">Owner Amount</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="number" id="damage_amount" name="owner_amount" placeholder="Owner Amount" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="rent_id" value="{{$rent->id}}">

                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
    @endforeach

<script>
    function toggle(className, obj) {
        if ( obj.checked ) $(className).show();
        else $(className).hide();
    }





</script>
