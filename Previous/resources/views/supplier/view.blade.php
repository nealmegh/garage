@extends('layouts.base')

@section('content')
    {{--    <div class="col-lg-6">--}}
    <div class="card">
        <div class="card-header">
            Create <strong>Supplier</strong>
        </div>
        <div class="card-body card-block">

            <form class="form-horizontal create_supplier" role="form" method="POST" action="{{ route('supplier.store')}}">

                @csrf

                <div class="box-body">

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Supplier Name</label><br>
                                <input type="text" class="form-control" name="supplier_name" placeholder="Full name">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="email" class="form-control" name="supplier_email" placeholder="abc@xyz.com">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Address</label><br>
                                <textarea class="form-control" placeholder="Enter current address ... " name="supplier_address"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Contact Mobile</label><br>
                                <input type="text" name="supplier_contact1" class ='form-control' placeholder = '' required="required" maxlength="11" minlength="10"/>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alternate Mobile</label><br>
                                <input type="text" name="supplier_contact2" value="" class ='form-control' placeholder = '' maxlength="11" minlength="10"/>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="reset" class="btn btn-danger pull-left">Reset</button>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Save</button>
                </div>
            </form>


        </div>

    </div>

@endsection

@section('js')

    <script>
        var nowDate = new Date();
        var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
        $(function() {
            $('#license_validity').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minDate: today,
                locale: {
                    format: 'MM/DD/YYYY',
                    separator: ' - ',
                }
            });
        });
    </script>
@endsection
