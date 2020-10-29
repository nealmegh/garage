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
                        <h4>Create <strong>Stock</strong></h4>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area">
            <form class="form-horizontal create_stock" role="form" method="POST" action="{{route('stock.store') }}">
                @csrf

                <div class="box-body">

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Stock Category</label>
                                <input type="text" class="form-control search_category_name" placeholder="Type here ..." name="category_name" autocomplete="off">
                                <span class="help-block search_category_name_empty" style="display: none;">No Results Found ...</span>
                                <input type="hidden" class="search_category_id" name="category_id">
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Stock/Product Name</label>
                                <input type="text" class="form-control" placeholder="Type here ..." name="stock_name">
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Initial Stock</label>
                                <input type="number" class="form-control" placeholder="Type here ..." name="stock_quantity">
                            </div>
                        </div>

                    </div>

                    <div class="row">


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Purchase Cost / Unit</label><br>
                                <input type="text" class="form-control" name="purchase_cost" placeholder="0.00">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Selling Cost / Unit</label>
                                <input type="text" class="form-control" name="selling_cost" placeholder="0.00">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="unit_type">Unit Type</label><br>
                                <select class="form-control change_supplier_name selectpicker" name="unit_type" id="unit_type">
                                    <option selected="" disabled="" value=""> Select </option>
                                    <option value="kg">Kilograms</option>
                                    <option value="lt">Liters</option>
                                    <option value="pcs">Pieces</option>
                                    <option value="grm">Grams</option>
                                    <option value="set">Sets</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">



                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="supplier_id">Supplier Name</label><br>
                                <select class="form-control change_supplier_name selectpicker" name="supplier_id" id="supplier_id" data-live-search="true">
                                    <option selected="" disabled="" value=""> Select </option>
                                    <option value="0">- Multiple suppliers -</option>
                                    @foreach($suppliers as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->supplier_name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="supplier_name" class="supplier_name">
                            </div>
                        </div>



                    </div>


                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="reset" class="btn btn-danger pull-left">Reset</button>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add</button>
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
        $( ".search_category_name" ).autocomplete({
            source: "/search/category_name",
            minLength: 1,
            response: function(event, ui) {
                if (ui.content.length === 0) {

                    $(this).parent().addClass('has-error');
                    $(this).next().removeClass('glyphicon-ok').addClass('glyphicon-remove');
                    $(".search_category_name_empty").show();
                    $('.form_submit').hide();

                } else {
                    $(".search_category_name_empty").hide();
                    $('.form_submit').show();
                }
            },
            select: function(event, ui) {

                $('.search_category_id').val(ui.item.id);

            }
        });
        $('.change_supplier_name').on('change' ,function(){

            if($(this).find(':selected').val() === 0){
                $('.supplier_name').val('');
            }
            else{
                $('.supplier_name').val($(this).find(':selected').text());
            }

        });
    </script>
@endsection
