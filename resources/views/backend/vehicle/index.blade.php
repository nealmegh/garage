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
    <style>
        .btn-light { border-color: transparent; }
    </style>
    <!-- END PAGE LEVEL CUSTOM STYLES -->
@endsection
@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        @if(Session::has('message'))
            <div class="alert alert-gradient mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  data-dismiss="alert" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
                <strong>{{ Session::get('message') }}</strong>
            </div>
        @endif
        <div class="" style="alignment: right">
            <a href="{{route('vehicle.create')}}" class="btn btn-dark mb-2"><i class="fas fa-plus"></i> add Vehicle</a>
        </div>

        <div class="widget-content widget-content-area br-6">
            <div class="table-responsive mb-4 mt-4">
                <h3 class="title-5 m-b-35">Vehicle Table</h3>
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>Vehicle Type</th>
                        <th>Registration Number</th>
                        <th>Tax Token Validity</th>
                        <th>Fitness Validity</th>
                        <th>Insurance Validity</th>
                        <th>Route Permit Validity</th>
                        <th>Actions</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td class="desc">
                                @if($vehicle->type == 1)
                                    {{'CNG'}}
                                @elseif($vehicle->type == 1)
                                    {{'Micro-Bus'}}
                                @elseif($vehicle->type == 3)
                                    {{'Sedan'}}
                                @endif

                            </td>
                            <td>{{$vehicle->registration_number}}</td>
                            @php
                                $tax = now()->diffInDays(Carbon\Carbon::parse($vehicle->tax_token_validity), false);
                                $fitness = now()->diffInDays(Carbon\Carbon::parse($vehicle->fitness_validity), false);
                                $insurance = now()->diffInDays(Carbon\Carbon::parse($vehicle->insurance_validity), false);
                                $rPermit = now()->diffInDays(Carbon\Carbon::parse($vehicle->route_permit_validity), false);
                            @endphp
                            <td>
                                @if($tax < 30 && $tax >= 0)
                                    <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($vehicle->tax_token_validity))}}</span>
                                @elseif($tax < 0)
                                    <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($vehicle->tax_token_validity))}}</span>
                                @else
                                    <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($vehicle->tax_token_validity))}}</span>
                                @endif
                            </td>
                            <td>
                                @if($fitness < 30 && $fitness >= 0)
                                    <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($vehicle->fitness_validity))}}</span>
                                @elseif($fitness < 0)
                                    <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($vehicle->fitness_validity))}}</span>
                                @else
                                    <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($vehicle->fitness_validity))}}</span>
                                @endif
                            </td>
                            <td>
                                @if($insurance < 30 && $insurance >= 0)
                                    <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($vehicle->insurance_validity))}}</span>
                                @elseif($insurance < 0)
                                    <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($vehicle->insurance_validity))}}</span>
                                @else
                                    <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($vehicle->insurance_validity))}}</span>
                                @endif
                            </td>
                            <td>
                                @if($rPermit < 30 && $rPermit >= 0)
                                    <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($vehicle->route_permit_validity))}}</span>
                                @elseif($rPermit < 0)
                                    <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($vehicle->route_permit_validity))}}</span>
                                @else
                                    <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($vehicle->route_permit_validity))}}</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('vehicle.show', $vehicle->id)}}" type="button" class="btn btn-dark btn-sm">View</a>
                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                        <a class="dropdown-item" href="{{route('vehicle.edit', $vehicle->id)}}">Edit</a>
                                        <a class="dropdown-item" href="{{route('vehicle.sales.create', $vehicle->id)}}">Maintenance</a>
                                    </div>
                                </div>
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

@endsection


