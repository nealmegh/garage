@extends('layouts.base2')
@section('head')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('base/assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('base/assets/css/widgets/modules-widgets.css')}}">
    <link href="{{asset('base/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('base/plugins/table/datatable/custom_dt_html5.css')}}">
    <!--  END CUSTOM STYLE FILE  -->

@endsection
@section('content')
    <!-- Content -->
    <div class="row sales">
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-top-spacing">

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Vehicle Info</h3>
                        <a href="{{route('vehicle.edit', $vehicle->id)}}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                    </div>
                    <div class="text-center user-info">
                        <img src="{{ asset('base/cng.jpg') }}" alt="avatar" style="max-width: 90px; height: 90px">
                        <p class="">{{$vehicle->registration_number}}</p>
                        <p class="">{{number_format($vehicle->asset_value,2)}}</p>
                        <p class="">{{($vehicle->owner != null)?$vehicle->owner->user->name:''}}</p>
                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled" style="max-width: 400px !important;">
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> Fitness Number: <span class="shadow-none badge badge-primary">{{$vehicle->fitness_number}}</span>
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Fitness Date:
                                    @if($fitness < 30 && $fitness >= 0)
                                        <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($vehicle->fitness_validity))}}</span>
                                    @elseif($fitness < 0)
                                        <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($vehicle->fitness_validity))}}</span>
                                    @else
                                        <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($vehicle->fitness_validity))}}</span>
                                    @endif
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> Tax Token Number: <span class="shadow-none badge badge-primary">{{$vehicle->tax_token}}</span>
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Tax Token Date:
                                    @if($tax < 30 && $tax >= 0)
                                        <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($vehicle->tax_token_validity))}}</span>
                                    @elseif($tax < 0)
                                        <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($vehicle->tax_token_validity))}}</span>
                                    @else
                                        <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($vehicle->tax_token_validity))}}</span>
                                    @endif
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> Insurance Number: <span class="shadow-none badge badge-primary">{{$vehicle->insurance_number}}</span>
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Insurance Date:
                                    @if($insurance < 30 && $insurance >= 0)
                                        <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($vehicle->insurance_validity))}}</span>
                                    @elseif($insurance < 0)
                                        <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($vehicle->insurance_validity))}}</span>
                                    @else
                                        <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($vehicle->insurance_validity))}}</span>
                                    @endif
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> Route Permit Number: <span class="shadow-none badge badge-primary">{{$vehicle->route_permit_number}}</span>
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Route Permit:
                                    @if($rPermit < 30 && $rPermit >= 0)
                                        <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($vehicle->route_permit_validity))}}</span>
                                    @elseif($rPermit < 0)
                                        <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($vehicle->route_permit_validity))}}</span>
                                    @else
                                        <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($vehicle->route_permit_validity))}}</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget widget-account-invoice-one">

                <div class="widget-heading">
                    <h5 class="">Account Info</h5>
                </div>

                <div class="widget-content">
                    <div class="invoice-box">

                        <div class="acc-total-info">
                            <h5>Balance</h5>
                            <p class="acc-amount">{{number_format(($vehicle->rents->sum('collection')-$vehicle->sales->sum('sales_total')),2)}}</p>
                        </div>

                        <div class="inv-detail">
                            <div class="info-detail-1">
                                <p>Total Earning(Rent)</p>
                                <p>{{number_format($vehicle->rents->sum('collection'),2)}}</p>
                            </div>
                            <div class="info-detail-2">
                                <p>Rent Due</p>
                                <p>{{number_format($vehicle->rents->sum('due'),2)}}</p>
                            </div>
                            <div class="info-detail-2">
                                <p>Total Maintenance</p>
                                <p>{{number_format($vehicle->sales->sum('sales_total'),2)}}</p>
                            </div>
                            <div class="info-detail-2">
                                <p>Damage Due</p>
                                <p>{{number_format($vehicle->damages->sum('driver_due_amount'),2)}}</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

        <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

            <div class="bio layout-spacing ">
                <div class="widget-content widget-content-area">
                    <h3 class="">Important Pictures</h3>
                    <div class="bio-skill-box">

                        <div class="row">

                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                                <div class="d-flex b-skills">
                                    <div>
                                    </div>
                                    <div class="">
                                        <h5>Vehicle Registration</h5>
                                        <p>
                                            <img src='{{ asset('storage/'.$vehicle->details->registration_img) }}' style="height: auto; width: 100%;">
                                            <a class="btn btn-primary"  href="{{ asset('storage/'.$vehicle->details->registration_img) }}" target="_blank">View</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                                <div class="d-flex b-skills">
                                    <div>
                                    </div>
                                    <div class="">
                                        <h5>Fitness</h5>
                                        <p>
                                            <img src='{{ asset('storage/'.$vehicle->details->fitness_img) }}' style="height: auto; width: 100%;">
                                            <a class="btn btn-primary"  href="{{ asset('storage/'.$vehicle->details->fitness_img) }}" target="_blank">View</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                                <div class="d-flex b-skills">
                                    <div>
                                    </div>
                                    <div class="">
                                        <h5>Tax Token</h5>
                                        <p>
                                            <img src='{{ asset('storage/'.$vehicle->details->tax_img) }}' style="height: auto; width: 100%;">
                                            <a class="btn btn-primary"  href="{{ asset('storage/'.$vehicle->details->tax_img) }}" target="_blank">View</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                                <div class="d-flex b-skills">
                                    <div>
                                    </div>
                                    <div class="">
                                        <h5>Insurance</h5>
                                        <p>
                                            <img src='{{ asset('storage/'.$vehicle->details->insurance_img) }}' style="height: auto; width: 100%;">
                                            <a class="btn btn-primary"  href="{{ asset('storage/'.$vehicle->details->insurance_img) }}" target="_blank">View</a>
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                                <div class="d-flex b-skills">
                                    <div>
                                    </div>
                                    <div class="">
                                        <h5>Route Permit</h5>
                                        <p>
                                            <img src='{{ asset('storage/'.$vehicle->details->route_permit_img) }}' style="height: auto; width: 100%;">
                                            <a class="btn btn-primary"  href="{{ asset('storage/'.$vehicle->details->route_permit_img) }}" target="_blank">View</a>
                                        </p>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>


    </div>

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive mb-4 mt-4">
                <h4>Maintenance Details</h4>
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Cost</th>
                            <th>Products</th>

                        </tr>
                    </thead>

                        <tbody>
                        @foreach($vehicle->sales as $sales)
                            @php
                                $details = '';
                            @endphp
                            <tr>
                                <td>{{$sales->id}}</td>
                                <td>{{date('d-m-Y', strtotime($sales->sales_date))}}</td>
                                <td>{{number_format($sales->sales_total,2)}}</td>
                                @foreach($sales->productList as $product)

                                    @php
                                        $details .= $product->stock->stock_name.':'.$product->sales_quantity.', ';
                                    @endphp
                                @endforeach
                                <td>
                                    {{$details}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                </table>
            </div>
        </div>
    </div>



@endsection
@section('js')
    <script src="{{asset('base/assets/js/widgets/modules-widgets.js')}}"></script>
    <script src="{{asset('base/plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{asset('base/plugins/table/datatable/datatables.js')}}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{asset('base/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('base/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{asset('base/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('base/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
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
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection

