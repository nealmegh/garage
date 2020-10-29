@extends('layouts.base2')
@section('head')

    <link href="{{asset('base/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('base/assets/js/loader.js')}}"></script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{asset('base/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('base/assets/css/dashboard/dash_2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@endsection
@section('content')
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-one" style="display: flex; flex-wrap: nowrap;">
            <div class="col-md-4" style="alignment: right;">
                <a href="{{route('rent.create')}}" class="btn btn-dark mb-2"><i class="fas fa-plus"></i> add Rent</a>
            </div>
            <div class="col-md-4" style="alignment: center !important; ">
                <a href="{{route('sales.create')}}" class="btn btn-success mb-2"><i class="fas fa-plus"></i> add Sales</a>
            </div>
            <div class="col-md-4" style="alignment: right; float: right !important;">
                <a href="{{route('purchase.create')}}" class="btn btn-danger mb-2"><i class="fas fa-plus"></i> add Purchase</a>
            </div>
        </div>
    </div>
    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-one">
            <div class="widget-heading">
                <h6 class="">Statistics</h6>
            </div>
            <div class="w-chart">
                <div class="w-chart-section">
                    <div class="w-detail">
                        <p class="w-title">Total Trips</p>
                        <p class="w-stats">{{$total_rents}}</p>
                    </div>
                    <div class="w-chart-render-one">
                        <div id="total-users"></div>
                    </div>
                </div>

                <div class="w-chart-section">
                    <div class="w-detail">
                        <p class="w-title">Today's Rents</p>
                        <p class="w-stats">{{$today_rents}}</p>
                    </div>
                    <div class="w-chart-render-one">
                        <div id="paid-visits"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-account-invoice-two">
            <div class="widget-content">
                <div class="account-box">
                    <div class="info" style="display: block !important; margin-bottom: 25px !important;">
                        <h5 class="" style="">Cash In Hand</h5>
                        <p class="inv-balance" style="font-size:x-large">{{number_format($total_amount,2)}} ৳</p>
                    </div>
                    <div class="info" style="display: block !important; margin-bottom: 5px !important;">
                        <h5 class="" style="">Total Stock Value</h5>
                        <p class="inv-balance" style="font-size:x-large">{{number_format($totalStockValue->sum('value'),2)}} ৳</p>
                    </div>
{{--                    <div class="acc-action">--}}
{{--                        <div class="">--}}
{{--                            <a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg></a>--}}
{{--                            <a href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>--}}
{{--                        </div>--}}
{{--                        <a href="javascript:void(0);">Upgrade</a>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-card-four">
            <div class="widget-content">
                <div class="w-content">
                    <div class="w-info">
                        <h6 class="value">{{number_format($total_earnings,2)}} ৳</h6>
                        <p class="" style="color: #0E9A00">Earnings</p>
                    </div>
                    <div class="w-info">
                        <h6 class="value">{{number_format($total_expense,2)}} ৳</h6>
                        <p class="" style="color: red">Expenses</p>
                    </div>
{{--                    <div class="">--}}
{{--                        <div class="w-icon">--}}
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
                @php
                $earning_ratio = ($total_earnings != 0)?($total_expense/$total_earnings)*100:0;
                @endphp
                <div class="progress">
                    <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{$earning_ratio}}%" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-9 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-chart-three">
            <div class="widget-heading">
                <div class="">
                    <h5 class="">Income Vs Expense</h5>
                </div>
            </div>

            <div class="widget-content">
                <div id="uniqueVisits"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-activity-three">

            <div class="widget-heading">
                <h5 class="">Last 5 Cases</h5>
            </div>

            <div class="widget-content">

                <div class="mt-container mx-auto">
                    <div class="timeline-line">
                    @foreach($active_cases as $case)
                        <div class="item-timeline timeline-new">
                            <div class="t-dot">
                        @if($case->payment_status == 1)
                            <div class="t-success">
                        @else
                            <div class="t-danger">
                        @endif
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                            </div>
                            <div class="t-content">
                                <div class="t-uppercontent">
                                    <h5>{{$case->case_id}}</h5>
                                    <span class="">{{date('d-M-Y', strtotime($case->last_date))}}</span>
                                </div>
                                <p><span>Driver:</span> {{$case->driver->user->name}}</p>
                                <p><span>Vehicle:</span> {{$case->rent->vehicle->registration_number}}</p>
                                <div class="tags">
                                    @if($case->doc_status == 1)
                                    <div class="badge badge-success">{{$case->doc_type}}</div>
                                    @else
                                    <div class="badge badge-warning">{{$case->doc_type}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget-four">
            <div class="widget-heading">
                <h5 class="">Inventory at a Glance</h5>
            </div>
            <div class="widget-content">
                <div class="vistorsBrowser">
                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                        </div>
                        <div class="w-browser-details">
                            <div class="w-browser-info">
                                <h6>Total Purchase Amount</h6>
                                <p class="browser-count">{{number_format($total_purchase+$total_purchase_dues, 2)}} ৳</p>
                            </div>
                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: {{($total_purchase!=0)?($total_purchase/($total_purchase+$total_purchase_dues))*100:0}}%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                        </div>
                        <div class="w-browser-details">

                            <div class="w-browser-info">
                                <h6>Total Sales Amount</h6>
                                <p class="browser-count">{{number_format($total_sales+$total_sales_dues, 2)}} ৳</p>
                            </div>

                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: {{($total_sales != 0)?($total_sales/($total_sales+$total_sales_dues))*100:0}}%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                        </div>
                        <div class="w-browser-details">

                            <div class="w-browser-info">
                                <h6>Total Sales Dues</h6>
                                <p class="browser-count">{{number_format($total_sales_dues,2)}} ৳</p>
                            </div>

                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: {{($total_sales != 0)?($total_sales_dues/($total_sales+$total_sales_dues))*100:0}}%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="row widget-statistic">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="widget widget-one_hybrid widget-followers">
                    <div class="widget-heading">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <p class="w-value">{{number_format($total_income,2)}} ৳</p>
                        <h5 class="">Total Trip Earnings</h5>
                    </div>
                    <div class="widget-content">
                        <div class="w-chart">
                            <div id="hybrid_followers"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="widget widget-one_hybrid widget-referral">
                    <div class="widget-heading">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        </div>
                        <p class="w-value">{{number_format($total_maintenance_cost,2)}} ৳</p>
                        <h5 class="">Total Maintenance Cost</h5>
                    </div>
                    <div class="widget-content">
                        <div class="w-chart">
                            <div id="hybrid_followers1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                <div class="widget widget-one_hybrid widget-engagement">
                    <div class="widget-heading">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                        </div>
                        <p class="w-value">{{number_format($total_profit,2)}} ৳</p>
                        <h5 class="">Total Profit</h5>
                    </div>
                    <div class="widget-content">
                        <div class="w-chart">
                            <div id="hybrid_followers3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        let sevenDays = {!! json_encode(array_values($sevenDays)) !!};
        let sixMonths = {!! json_encode(array_values($sixMonths)) !!};
        let expenseByMonths = {!! json_encode(array_values($year_expense)) !!};
        let nameOfMonths = {!! json_encode(array_keys($year_expense)) !!};
        let earningsByMonths = {!! json_encode(array_values($year_earnings)) !!};
        let incomeByMonths = {!! json_encode(array_values($income_by_month)) !!};
        let maintenanceByMonths = {!! json_encode(array_values($maintenance_by_month)) !!};
        let profitByMonths = {!! json_encode(array_values($profit_by_month)) !!};
    </script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{asset('base/plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('base/assets/js/dashboard/dash_2.js')}}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
@endsection
