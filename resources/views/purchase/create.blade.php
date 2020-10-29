@extends('layouts.base2')
@section('head')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('base/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <link href="{{asset('base/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link href="{{asset('base/plugins/file-upload/file-upload-with-preview.min.css')}}" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    <style>
        .ui-autocomplete {
            position: absolute;
            z-index: 1000;
            cursor: default;
            padding: 0;
            margin-top: 2px;
            list-style: none;
            background-color: #ffffff;
            border: 1px solid #ccc;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .ui-autocomplete > li {
            padding: 3px 20px;
        }
        .ui-autocomplete > li.ui-state-focus {
            background-color: #DDD;
        }
        .ui-helper-hidden-accessible {
            display: none;
        }
        .ui-menu-item a.ui-state-focus {
            background: #faa; !important;
        }
    </style>

@endsection
@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Create <strong>Purchase</strong></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
            <form class="form-horizontal create_purchase" role="form" method="POST" action="{{ route('purchase.store') }}">
                @csrf

                <div class="box-body">

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Supplier Name</label>
                                        <input type="text" class="form-control search_supplier_name" placeholder="Type here ..." name="supplier_name" autocomplete="off">
                                        <span class="help-block search_supplier_name_empty" style="display: none;">No Results Found ...</span>
                                        <input type="hidden" class="search_supplier_id" name="supplier_id">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Address</label><br>
                                        <input type="text" class="form-control search_supplier_address" name="supplier_address" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Contact</label><br>
                                        <input type="text" class="form-control search_supplier_contact1" name="supplier_contact1" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Opening Balance</label><br>
                                        <input type="text" name="opening_balance" class="form-control opening_balance" readonly="">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Opening Due</label><br>
                                        <input type="text" name="opening_due" class="form-control opening_due" readonly="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="box box-default">

                        <div class="box-body">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Stock Catagory</th>
                                    <th>Physical Quantity</th>
                                    <th>No.of.Units</th>
                                    <th>Purchase cost / Unit</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody class="purchase_container">
                                <tr>
                                    <td>
                                        <input type="text" class="form-control search_purchase_category_name ui-autocomplete-input" placeholder="Type here ..." name="category_name[]" id="category_name" autocomplete="off">
                                        <span class="help-block search_purchase_category_name_empty" style="display: none;">No Results Found ...</span>
                                        <input type="hidden" class="search_category_id" name="category_id[]">
                                    </td>
                                    <td width="250px">
                                        <select class="form-control purchase_stock_id" name="stock_id[]">
                                            <option selected="" disabled="" value="">select</option>
                                        </select>
                                        <span></span>
                                    </td>

                                    <td width="150px">

                                        <input type="hidden" class="search_stock_quantity" name="opening_stock[]">
                                        <input type="hidden" class="closing_stock" name="closing_stock[]">

                                        <input type="text" class="form-control change_purchase_quantity" name="purchase_quantity[]" min="0" autocomplete="off">
                                    </td>

                                    <td width="200px">
                                        <input type="text" class="form-control search_purchase_cost" name="purchase_cost[]">
                                    </td>

                                    <td width="150px">
                                        <input type="text" class="form-control stock_total" name="sub_total[]"  readonly="">
                                    </td>

                                    <td><button type="button" class="btn btn-danger remove_tr">&times;</button></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <button type="button" class="btn btn-primary add_purchase_product"><i class="fa fa-plus"></i> Add More</button>
                                    </td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>


                            <div class="row">

                                <div class="col-md-offset-8 col-md-4">
                                    <div class="form-group">
                                        <label>Purchase Total</label><br>
                                        <input type="text" class="form-control purchase_total" readonly="" name="purchase_total">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
                                    <div class="form-group">
                                        <label>Discount ( % )</label><br>
                                        <input type="number" class="form-control purchase_discount_percent" name="discount_percent" step="0.01" min="0" max="100" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Discount ( Amount )</label><br>
                                        <input type="text" class="form-control purchase_discount_amount" name="discount_amount" step="0.01" min="0" value="0">
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tax Description</label><br>
                                        <input type="text" class="form-control" name="tax_description">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tax ( % )</label><br>
                                        <input type="number" class="form-control purchase_tax_percent" name="tax_percent"  step="0.01" min="0" max="100" value="0">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tax ( Amount )</label><br>
                                        <input type="text" class="form-control purchase_tax_amount" name="tax_amount"   step="0.01" min="0" value="0">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="box box-default">
                        <div class="box-body">
                            <div class="row">

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Description</label><br>
                                        <textarea class="form-control" style="height: 35px;" name="description" autocomplete="off"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Grand Total</label><br>
                                        <input type="text" class="form-control grand_total" name="grand_total" readonly="">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Payment</label><br>
                                        <input type="text" class="form-control purchase_payment" name="payment" autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Closing Balance</label><br>
                                        <input type="text" class="form-control closing_balance" name="closing_balance" readonly="">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Closing Due</label><br>
                                        <input type="text" class="form-control closing_due" name="closing_due" readonly="">
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Mode</label>
                                        <select class="form-control selectpicker" name="mode">
                                            <option value="1">Cash</option>
                                            <option value="2">Cheque</option>
                                            <option value="3">Card</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="reset" class="btn btn-danger pull-left">Reset</button>
                    <button type="submit" class="btn btn-primary pull-right form_submit"><i class="fa fa-plus"></i> Add</button>
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
    {{--    <script src="{{asset('base/plugins/select2/custom-select2.js')}}"></script>--}}
    <script src="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    {{--    <script src="{{asset('base/plugins/flatpickr/flatpickr.js')}}"></script>--}}
    {{--    <script src="{{asset('base/plugins/flatpickr/custom-flatpickr.js')}}"></script>--}}
    <script src="{{asset('base/plugins/file-upload/file-upload-with-preview.min.js')}}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        //First upload
        // var firstUpload = new FileUploadWithPreview('photo')
    </script>
    <!--  BEGIN CUSTOM SCRIPTS FILE  -->
    <script>
        $( ".search_supplier_name" ).autocomplete({
            source: "/search/supplier_name",
            minLength: 1,
            response: function(event, ui) {
                if (ui.content.length === 0) {

                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(".search_supplier_name_empty").show();
                    $('.form_submit').hide();

                } else {
                    $(".search_supplier_name_empty").hide();
                    $('.form_submit').show();
                }
            },
            select: function(event, ui) {
                $('.search_supplier_id').val(ui.item.id);
                $('.search_supplier_name').val(ui.item.value);
                $('.search_supplier_address').val(ui.item.supplier_address);
                $('.search_supplier_contact1').val(ui.item.supplier_contact1);

                $('.opening_balance').val(parseFloat(ui.item.balance).toFixed(2));
                $('.opening_due').val(parseFloat(ui.item.due).toFixed(2));

                $('.grand_total').val(  parseFloat(ui.item.due-ui.item.balance).toFixed(2) );

                // var e = $.Event('keyup'); $('.change_purchase_quantity,.sales_payment,.stock_id').trigger(e);

            }
        });
        $( ".search_purchase_category_name" ).autocomplete({
            source: "/search/purchase_category_name",
            minLength: 1,
            response: function(event, ui) {
                if (ui.content.length === 0) {

                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(".search_purchase_category_name_empty").show();
                    $('.form_submit').hide();

                } else {
                    $(".search_purchase_category_name_empty").hide();
                    $('.form_submit').show();
                }
            },
            select: function(event, ui) {

                $('.search_category_id').val(ui.item.id);

                $('.unit_of_measure_container').empty();

                $('.search_purchase_cost,.search_selling_cost,.search_stock_quantity,.purchase_total,.grand_total,.closing_due').val('');

                $('.grand_total').val($('.opening_due').val());

                $('.stock_id,.purchase_stock_id').empty().append('<option selected="" disabled="" value="">- Select -</option>');
                // $('.purchase_stock_id').addClass("selectpicker");

                $.each( ui.item.stocks , function( key, value ) {
                    $('.stock_id,.purchase_stock_id').append('<option title="'+value.title+'" purchase_cost="'+value.purchase_cost+'" selling_cost="'+value.selling_cost+'" opening_stock="'+value.opening_stock+'" value='+key+'>'+value.title+'</option>');
                    $('.stock_id_details').empty().html('( '+value.title+' )');
                });

            }
        });
        $(document).on('click', '.add_purchase_product', function(){

            $('.purchase_container').append('<tr><td><input type="text" class="form-control search_purchase_category_name" placeholder="Type here ..." name="category_name[]" autocomplete="off"><span class="help-block search_purchase_category_name_empty" style="display: none;">No Results Found ...</span><input type="hidden" class="search_category_id" name="category_id[]"></td><td width="250px"><select class="form-control purchase_stock_id" name="stock_id[]"><option selected="" disabled="" value="">select</option></select><span></span></td><td width="150px"><input type="hidden" class="search_stock_quantity" name="opening_stock[]"><input type="hidden" class="closing_stock" name="closing_stock[]"><input type="text" class="form-control change_purchase_quantity" name="purchase_quantity[]" min="0" autocomplete="off"></td><td width="200px"><input type="text" class="form-control search_purchase_cost" name="purchase_cost[]"></td><td width="150px"><input type="text" class="form-control stock_total" name="sub_total[]"  readonly=""></td><td><button type="button" class="btn btn-danger remove_tr">&times;</button></td></tr>');

            $( ".search_purchase_category_name" ).autocomplete({
                source: "/search/purchase_category_name",
                minLength: 1,
                response: function(event, ui) {
                    if (ui.content.length === 0) {

                        $(this).parent().addClass('has-error');
                        $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                        $(this).next().show();
                        $('.form_submit').hide();

                    } else {
                        $(this).next().hide();
                        $('.form_submit').show();
                    }
                },
                select: function(event, ui) {

                    $(this).next().next().val(ui.item.id);

                    var select = $(this).parent().next().children(':first-child');

                    select.empty().append('<option selected="" disabled="" value="">- Select -</option>');

                    $.each( ui.item.stocks , function( key, value ) {
                        select.append('<option title="'+value.title+'" purchase_cost="'+value.purchase_cost+'" selling_cost="'+value.selling_cost+'" opening_stock="'+value.opening_stock+'" value='+key+'>'+value.title+'</option>');
                    });

                }
            });

            calculate_purchase();
        });

        $(document).on('click', '.remove_tr', function(){
            $(this).closest('tr').remove();
            calculate_purchase();
        });
        $(document).on('keyup','.change_purchase_quantity',function(){

            var quantity = parseInt($(this).val()).toFixed(2);

            var cost = parseFloat( $(this).parent().next().children(':first-child').val() ).toFixed(2);

            var total = parseFloat(quantity*cost || 0).toFixed(2);

            $(this).parent().next().next().children(':first-child').val(total);

            var opening = parseInt( $(this).prev().prev().val() );

            $(this).prev().val( parseInt(opening) + parseInt(quantity) );

            calculate_purchase();

        });
        $(document).on('change','.purchase_stock_id',function(){

            var purchase_cost = $(this).find(':selected').attr('purchase_cost');
            var opening_stock = $(this).find(':selected').attr('opening_stock');

            $(this).next().html('Available Stocks : '+$(this).find(':selected').attr('opening_stock'));

            $(this).parent().next().children(':first-child').val(opening_stock);

            $(this).parent().next().next().children(':first-child').val(purchase_cost);

            $(this).parent().next().next().next().find(':nth-child(1)').val();

            calculate_purchase();

        });
        function calculate_purchase() {

            var sum = 0;

            $(".stock_total").each(function(){
                sum += +$(this).val();
            });

            $('.purchase_total').val(sum);

            var total = (parseFloat($('.opening_due').val()) + parseFloat($('.purchase_total').val()) - parseFloat($('.opening_balance').val())).toFixed(2);

            var discount = parseFloat( $('.purchase_discount_amount').val() ).toFixed(2);

            var tax = parseFloat( $('.purchase_tax_amount').val() ).toFixed(2);

            var grand = (parseFloat(total-discount) + parseFloat(tax)).toFixed(2);

            $('.grand_total').val( grand || '');

        }
        $('.purchase_payment').on('keyup',function(){

            var payment =  parseFloat($(this).val() || 0).toFixed(2);
            var grand_total =  parseFloat($('.grand_total').val() || 0).toFixed(2);
            var opening_balance =  parseFloat($('.opening_balance').val() || 0).toFixed(2);
            var opening_due =  parseFloat($('.opening_due').val() || 0).toFixed(2);

            if( (grand_total - payment) > 0 ){
                $('.closing_due').val(grand_total - payment);
                $('.closing_balance').val(0);
            }
            else{
                $('.closing_due').val(0);
                $('.closing_balance').val(payment - grand_total);
            }


        });
    </script>
@endsection
