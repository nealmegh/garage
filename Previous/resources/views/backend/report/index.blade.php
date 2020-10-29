@extends('layouts.base2')
@section('head')
    <link href="{{asset('base/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('base/assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('base/assets/css/elements/infobox.css')}}" rel="stylesheet" type="text/css" />
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('base/plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('base/plugins/noUiSlider/nouislider.min.css')}}" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->

    <link href="{{asset('base/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('base/plugins/bootstrap-range-Slider/bootstrap-slider.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('base/plugins/noUiSlider/custom-nouiSlider.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('base/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.css')}}">

    <!--  END CUSTOM STYLE FILE  -->
@endsection
@section('content')
    <div id="tabsWithIcons" class="col-lg-12 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h1 style="text-align: center">Reports</h1>
                    </div>
                </div>
            </div>
            <div class="widget-content widget-content-area rounded-pills-icon">

                <ul class="nav nav-pills mb-4 mt-3  justify-content-center" id="rounded-pills-icon-tab" role="tablist">
                    <li class="nav-item ml-2 mr-2">
                        <a class="nav-link mb-2 active text-center" id="rounded-pills-icon-basic-tab" data-toggle="pill" href="#rounded-pills-icon-home" role="tab" aria-controls="rounded-pills-icon-home" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> Basic</a>
                    </li>
                    <li class="nav-item ml-2 mr-2">
                        <a class="nav-link mb-2 text-center" id="rounded-pills-icon-profile-tab" data-toggle="pill" href="#rounded-pills-icon-profile" role="tab" aria-controls="rounded-pills-icon-profile" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                        Vehicle
                        </a>
                    </li>
                    <li class="nav-item ml-2 mr-2">
                        <a class="nav-link mb-2 text-center" id="rounded-pills-icon-contact-tab" data-toggle="pill" href="#rounded-pills-icon-contact" role="tab" aria-controls="rounded-pills-icon-contact" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Driver
                        </a>
                    </li>

                    <li class="nav-item ml-2 mr-2">
                        <a class="nav-link mb-2 text-center" id="rounded-pills-icon-settings-tab" data-toggle="pill" href="#rounded-pills-icon-settings" role="tab" aria-controls="rounded-pills-icon-settings" aria-selected="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                        Inventory
                        </a>
                    </li>
                    <li class="nav-item ml-2 mr-2">
                        <a class="nav-link mb-2 text-center" id="rounded-pills-icon-finance-tab" data-toggle="pill" href="#rounded-pills-icon-finance" role="tab" aria-controls="rounded-pills-icon-finance" aria-selected="false">
{{--                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>--}}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        Finance
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="rounded-pills-icon-tabContent">
                    <div class="tab-pane fade show active" id="rounded-pills-icon-home" role="tabpanel" aria-labelledby="rounded-pills-icon-home-tab">
                        <div class="row d-flex" style="width: 100%;">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area"  >
                                <div class="infobox-3" style="min-width: 100%" >
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                                        {{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">All Vehicles Report</h5>
                                    <p class="info-text">Generate All vehicles Data ...</p>
                                    <a class="info-link" href="{{route('reports.vehicle.all')}}">Generate <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area" >
                                <div class="infobox-3" style="min-width: 100%" >
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">All Drivers Report</h5>
                                    <p class="info-text">Generate All Drivers Data ...</p>
                                    <a class="info-link" href="{{route('reports.driver.all')}}">Generate <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area" >
                                <div class="infobox-3" style="min-width: 100%" >
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                        {{--                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">All Sales Report</h5>
                                    <p class="info-text">Generate All Sales Data ...</p>
                                    <a class="info-link" href="{{route('reports.sales.all')}}">Generate <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="rounded-pills-icon-profile" role="tabpanel" aria-labelledby="rounded-pills-icon-profile-tab">
                        <div class="row d-flex" style="width: 100%">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Rent Report</h5>

                                        <form class="simple-example" action="{{route('reports.vehicle.rent')}}" method="get" novalidate>

                                            <div style="padding-bottom: 10px ">

                                                <input id="vehicle_rent_report" name="vehicle_rent" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                                <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                                <div class="invalid-feedback">
                                                    Please fill the name
                                                </div>
                                            </div>
                                            <div style="height: auto">
                                                <select name="rent_vehicle_id" id="rent_vehicle_id" class="form-control selectpicker" data-live-search="true" required >
                                                    <option value="" disabled selected>Select Vehicle</option>
                                                    @foreach($vehicles as $vehicle)
                                                        <option value="{{$vehicle->id}}">{{substr($vehicle->registration_number, -7)}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    Please fill the name
                                                </div>
                                            </div>

                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                            <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                        </form>
{{--                                    <p class="info-text"></p>--}}
{{--                                    <a class="info-link" href="">Discover <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>--}}

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area" >
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Maintenance Report</h5>
                                    <form class="simple-example" action="{{route('reports.vehicle.maintenance')}}" method="get" novalidate>

                                        <div style="padding-bottom: 10px ">

                                            <input id="vehicle_maintenance" name="vehicle_maintenance" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                            <small id="vehicle_maintenance_help" class="form-text text-muted">*Required Fields</small>
                                            <div class="invalid-feedback">
                                                Please fill the name
                                            </div>
                                        </div>
                                        <div style="height: auto">
                                            <select name="maintenance_vehicle_id" id="maintenance_vehicle_id" class="form-control selectpicker" data-live-search="true" required >
                                                <option value="" disabled selected>Select Vehicle</option>
                                                @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}">{{substr($vehicle->registration_number, -7)}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please fill the name
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
{{--                                    <p class="info-text">Lorem ipsum dolor sit amet, labore et dolore magna aliqua.</p>--}}
{{--                                    <a class="info-link" href="">Discover <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>--}}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area" >
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                    </div>
                                    <h5 class="info-heading">Detail Report</h5>
                                    <form class="simple-example" action="{{route('reports.vehicle.detail')}}" method="get" novalidate>

                                        <div style="height: auto">
                                            <select name="detail_vehicle_id" id="detail_vehicle_id" class="form-control selectpicker" data-live-search="true" required >
                                                <option value="" disabled selected>Select Vehicle</option>
                                                @foreach($vehicles as $vehicle)
                                                    <option value="{{$vehicle->id}}">{{substr($vehicle->registration_number, -7)}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select vehicle id
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="rounded-pills-icon-contact" role="tabpanel" aria-labelledby="rounded-pills-icon-contact-tab">
                        <div class="row d-flex" style="width: 100%">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Rent Details</h5>
                                    <form class="simple-example" action="{{route('reports.driver.rent')}}" method="get" novalidate>

                                        <div style="padding-bottom: 10px ">

                                            <input id="driver_rent_report" name="driver_rent_report" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                            <div class="invalid-feedback">
                                                Please fill the Date
                                            </div>
                                        </div>
                                        <div style="height: auto">
                                            <select name="rent_driver_id" id="rent_driver_id" class="form-control selectpicker" data-live-search="true" required >
                                                <option value="" disabled selected>Select Driver</option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{$driver->id}}">{{$driver->user->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please Select the name
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Finance Report</h5>
                                    <form class="simple-example" action="{{route('reports.driver.finance')}}" method="get" novalidate>

                                        <div style="padding-bottom: 10px ">

                                            <input id="driver_finance_report" name="driver_finance_report" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                            <div class="invalid-feedback">
                                                Please fill the Date
                                            </div>
                                        </div>
                                        <div style="height: auto">
                                            <select name="finance_driver_id" id="finance_driver_id" class="form-control selectpicker" data-live-search="true" required >
                                                <option value="" disabled selected>Select Driver</option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{$driver->id}}">{{$driver->user->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please Select the name
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                    </div>
                                    <h5 class="info-heading">Detailed Report</h5>
                                    <form class="simple-example" action="{{route('reports.driver.detail')}}" method="get" novalidate>

{{--                                        <div style="padding-bottom: 10px ">--}}

{{--                                            <input id="driver_finance_report" name="driver_finance_report" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>--}}
{{--                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please fill the Date--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                        <div style="height: auto">
                                            <select name="detail_driver_id" id="detail_driver_id" class="form-control selectpicker" data-live-search="true" required >
                                                <option value="" disabled selected>Select Driver</option>
                                                @foreach($drivers as $driver)
                                                    <option value="{{$driver->id}}">{{$driver->user->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please Select the name
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="rounded-pills-icon-settings" role="tabpanel" aria-labelledby="rounded-pills-icon-settings-tab">
                        <div class="row d-flex" style="width: 100%">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-up"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Sales Report</h5>
                                    <form class="simple-example" action="{{route('reports.inventory.sales')}}" method="get" novalidate>
                                        <div style="padding-bottom: 10px ">

                                            <input id="sales_report" name="sales_report" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                            <div class="invalid-feedback">
                                                Please fill the Date
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trending-down"><polyline points="23 18 13.5 8.5 8.5 13.5 1 6"></polyline><polyline points="17 18 23 18 23 12"></polyline></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Purchase Report</h5>
                                    <form class="simple-example" action="{{route('reports.inventory.purchase')}}" method="get" novalidate>
                                        <div style="padding-bottom: 10px ">

                                            <input id="purchase_report" name="purchase_report" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                            <div class="invalid-feedback">
                                                Please fill the Date
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Stock Report</h5>
                                    <p class="info-text">Generate Full Stock Report ...</p>
                                    <a class="info-link" href="{{route('reports.inventory.stock')}}">Generate <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="rounded-pills-icon-finance" role="tabpanel" aria-labelledby="rounded-pills-icon-finance-tab">
                        <div class="row d-flex" style="width: 100%">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize-2"><polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Debit Report</h5>
                                    <form class="simple-example" action="{{route('reports.transaction.debit')}}" method="get" novalidate>

                                        <div style="padding-bottom: 10px ">
                                            <input type="hidden" name="type" value="Debit">
                                            <input id="transaction_debit_report" name="transaction_debit_report" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                            <div class="invalid-feedback">
                                                Please fill the Date
                                            </div>
                                        </div>
                                        <div style="height: auto">
                                            <select name="debit_for" id="debit_for" class="form-control selectpicker" data-live-search="true" required >
                                                <option value="" disabled selected>Select Payment Type</option>
                                                <option value="all" >All</option>
                                                <option value="rent" >Rent</option>
                                                <option value="addMoney" >Add Money</option>
                                                <option value="loanPayment" >Loan Payment</option>
                                                <option value="collectCase" >Case Collection</option>
                                                <option value="customerCollection" >Customer Collection</option>
                                                <option value="sales" >Sales</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please Select the Type
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize-2"><polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline><line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Credit Report</h5>
                                    <form class="simple-example" action="{{route('reports.transaction.credit')}}" method="get" novalidate>

                                        <div style="padding-bottom: 10px ">
                                            <input type="hidden" name="type" value="Credit">
                                            <input id="transaction_credit_report" name="transaction_credit_report" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                            <div class="invalid-feedback">
                                                Please fill the Date
                                            </div>
                                        </div>
                                        <div style="height: auto">
                                            <select name="debit_for" id="debit_for" class="form-control selectpicker" data-live-search="true" required >
                                                <option value="" disabled selected>Select Type</option>
                                                <option value="all" >All</option>
                                                <option value="reMoney" >Regular Expense</option>
                                                <option value="withdrawMoney" >Withdraw Money</option>
                                                <option value="loan" >Loan</option>
                                                <option value="casePayment" >Case Payment</option>
                                                <option value="supplierPayment" >Supplier Payment</option>
                                                <option value="purchase" >Purchase</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please Select the Type
                                            </div>
                                        </div>

                                        <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 widget-content widget-content-area">
                                <div class="infobox-3" style="min-width: 100% !important;">
                                    <div class="info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-move"><polyline points="5 9 2 12 5 15"></polyline><polyline points="9 5 12 2 15 5"></polyline><polyline points="15 19 12 22 9 19"></polyline><polyline points="19 9 22 12 19 15"></polyline><line x1="2" y1="12" x2="22" y2="12"></line><line x1="12" y1="2" x2="12" y2="22"></line></svg>
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
                                    </div>
                                    <h5 class="info-heading">Debit vs Credit Report</h5>
                                    <form class="simple-example" action="{{route('reports.transaction.all')}}" method="get" novalidate>

                                        <div style="padding-bottom: 10px ">

                                            <input id="transaction_report" name="transaction_report" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Date Range.." required>
                                            <small id="emailHelp" class="form-text text-muted">*Required Fields</small>
                                            <div class="invalid-feedback">
                                                Please fill the Date
                                            </div>
                                        </div>
{{--                                        <div style="height: auto">--}}
{{--                                            <select name="credit_for" id="credit_for" class="form-control selectpicker" data-live-search="true" required >--}}
{{--                                                <option value="" disabled selected>Select Driver</option>--}}
{{--                                                @foreach($drivers as $driver)--}}
{{--                                                    <option value="{{$driver->id}}">{{$driver->user->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            <div class="invalid-feedback">--}}
{{--                                                Please Select the Type--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <small id="emailHelp" class="form-text text-muted">*Required Fields</small>--}}
                                        <button type="submit" class="btn btn-primary mt-4">Generate</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

    <script src="{{asset('base/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('base/plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{asset('base/plugins/noUiSlider/nouislider.min.js')}}"></script>
    <script src="{{asset('plugins/flatpickr/custom-flatpickr.js')}}"></script>
    <script src="{{asset('base/plugins/noUiSlider/custom-nouiSlider.js')}}"></script>
    <script src="{{asset('base/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js')}}"></script>
    <script src="{{asset('base/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
    <script src="{{asset('base/assets/js/forms/bootstrap_validation/bs_validation_script.js')}}"></script>
<script>
    var f3 = flatpickr(document.getElementById('vehicle_maintenance'), {
        mode: "range"
    });
    let f4 = flatpickr(document.getElementById('vehicle_rent_report'), {
        mode: "range"
    });
    let f5 = flatpickr(document.getElementById('driver_rent_report'), {
        mode: "range"
    });
    let f6 = flatpickr(document.getElementById('driver_finance_report'), {
        mode: "range"
    });
    let f7 = flatpickr(document.getElementById('sales_report'), {
        mode: "range"
    });
    let f8 = flatpickr(document.getElementById('purchase_report'), {
        mode: "range"
    });
    let f9 = flatpickr(document.getElementById('transaction_credit_report'), {
        mode: "range"
    });
    let f10 = flatpickr(document.getElementById('transaction_debit_report'), {
        mode: "range"
    });
    let f11 = flatpickr(document.getElementById('transaction_report'), {
        mode: "range"
    });
</script>
    <script>
        window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('simple-example');
            var invalid = $('.simple-example .invalid-feedback');

// Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                        invalid.css('display', 'block');
                    } else {

                        invalid.css('display', 'none');

                        form.classList.add('was-validated');
                    }
                }, false);
            });

        }, false);
    </script>
@endsection
