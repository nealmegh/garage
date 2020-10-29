@extends('layouts.base2')
@section('head')
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/table/datatable/dt-global_style.css')}}">
    <link href="{{asset('base/assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('base/plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('base/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('base/assets/css/elements/alert.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/assets/css/widgets/modules-widgets.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/select2/select2.min.css')}}">
    <style>
        .btn-light { border-color: transparent; }
    </style>
    <!-- END PAGE LEVEL CUSTOM STYLES -->

@endsection
@section('content')
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-card-four">
            <div class="widget-content">
                <div class="w-content">
                    <div class="w-info">
                        <h6 class="value">{{number_format($total_amount,2)}}</h6>
                        <p class="">Cash In Hand</p>
                    </div>
                    <div class="">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing" >

                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#withdrawMoney">
                    Withdraw Money
                </button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#loanPayment">
                    Loan Payment
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addDamage">
                    Damage Payment
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#loan">
                    Loan
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#reMoney">
                    Regular Expense
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#payCase">
                    Case Payments
                </button>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#collectCase">
                    Case Collection
                </button>
                <button type="button" style="margin-top: 7px;" class="btn btn-info" data-toggle="modal" data-target="#addMoney">
                    Add Money
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addCollection">
                    Customer Collection
                </button>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#supplierPayment">
                    Supplier Payment
                </button>
    </div>




    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        @if(Session::has('message'))
            <div class="alert alert-gradient mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  data-dismiss="alert" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <strong>{{ Session::get('message') }}</strong>
            </div>
        @endif


        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive mb-4 mt-4">
                <h3 class="title-5 m-b-35">Transaction Table</h3>
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Method</th>
                        <th>Payment For</th>
                        <th>Vehicle No</th>
                        <th>Driver</th>
                        <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr class="tr-shadow">
                            <td>
                                {{$transaction->id}}
                            </td>
                            <td>
                                <span class="block-email">{{$transaction->type}}</span>
                            </td>
                            <td class="desc">{{$transaction->method}}</td>
                            <td>{{$transaction->payment_for}}</td>
                            @if($transaction->rent != null)
                                <td>{{$transaction->rent->vehicle->registration_number}}</td>
                            @else
                                <td>N/A</td>
                            @endif
                            @if($transaction->driver != null)
                                <td>{{$transaction->driver->user->name}}</td>
                            @else
                                <td>N/A</td>
                            @endif
                            <td>{{$transaction->amount}}</td>
                        </tr>



                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection
@section('js')
    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{asset('base/plugins/table/datatable/datatables.js')}}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{asset('base/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('base/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{asset('base/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('base/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script src="{{asset('base/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('base/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('base/plugins/select2/custom-select2.js')}}"></script>
    <script src="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('base/assets/js/widgets/modules-widgets.js')}}"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        } );
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
    <script>
        $(document).ready(function() {
            var table = $('#html5-extension').DataTable();
            table
                .order( [ 0, 'desc' ] )
                .draw();
        } );
    </script>

    <script>

        var ss = $("#loan_driver_id").select2({
            dropdownParent: $('#loanPayment'),
        });
        var ss = $("#l_driver_id").select2({
            dropdownParent: $('#loan'),
        });
        var ss = $("#case_id").select2({
            dropdownParent: $('#payCase'),
        });
        var ss = $("#cDriver_id").select2({
            dropdownParent: $('#collectCase'),
        });
        var ss = $("#customer_id").select2({
            dropdownParent: $('#addCollection'),
        });
        var ss = $("#supplier_id").select2({
            dropdownParent: $('#supplierPayment'),
        });
        // $.fn.modal.Constructor.prototype.enforceFocus = function() {};
        var ss = $("#driver_id").select2({
            dropdownParent: $('#addDamage'),
        });
    </script>
@endsection

