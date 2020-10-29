@extends('layouts.base2')
@section('head')
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{asset('base/assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('base/assets/css/widgets/modules-widgets.css')}}">
    <link href="{{asset('base/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <!--  END CUSTOM STYLE FILE  -->
<style>
    .canvas_div_pdf{
        width: 100%;
        height: auto;
    }
</style>
@endsection
@section('content')
    <!-- Content -->

<div class="row sales " >
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 layout-top-spacing">
        <button class="btn btn-primary mb-2" onclick="saveDiv('printable', 'title')">Save Driver Info</button>
        <div class="user-profile layout-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Driver Info</h3>
                    <a href="{{route('driver.edit', $driver->id)}}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                </div>
                <div class="text-center user-info">
                    <a href="{{ asset('storage/'.$driver->details->driver_photo) }}" target="_blank">

                        <img src="{{ asset('storage/'.$driver->details->driver_photo) }}" alt="avatar" style="max-width: 90px; height: 90px">
                    </a>
                    <p class="">{{$driver->user->name}}</p>
                </div>
                <div class="user-info-list">

                    <div class="">
                        <ul class="contacts-block list-unstyled" style="max-width: 400px !important;">
                            <li class="contacts-block__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> NID: <span class="shadow-none badge badge-primary">{{$driver->details->nid}}</span>
                            </li>
                            <li class="contacts-block__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> License Number: <span class="shadow-none badge badge-primary">{{$driver->license_number}}</span>
                            </li>
                            @php
                                $interval = now()->diffInDays(Carbon\Carbon::parse($driver->license_validity), false);
                            @endphp
                            <li class="contacts-block__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>License Date:
                                @if($interval < 30 && $interval >= 0)
                                    <span class="shadow-none badge badge-warning">{{date('d-m-Y', strtotime($driver->license_validity))}}</span>
                                @elseif($interval < 0)
                                    <span class="shadow-none badge badge-danger">{{date('d-m-Y', strtotime($driver->license_validity))}}</span>
                                @else
                                    <span class="shadow-none badge badge-success">{{date('d-m-Y', strtotime($driver->license_validity))}}</span>
                                @endif
                            </li>

                            <li class="contacts-block__item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> Phone Number:  <span class="shadow-none badge badge-primary">{{$driver->phone_number}}</span>
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
                        <p class="acc-amount">{{$total_due}}</p>
                    </div>

                    <div class="inv-detail">
                        <div class="info-detail-1">
                            <p>Loans</p>
                            <p>{{$loans}}</p>
                        </div>
                        <div class="info-detail-2">
                            <p>Rent Due</p>
                            <p>{{$due}}</p>
                        </div>
                        <div class="info-detail-2">
                            <p>Damage Due</p>
                            <p>{{$damage}}</p>
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
                                    <h5>License</h5>
                                    <p>
                                            <img src='{{ asset('storage/'.$driver->details->license_photo) }}' style="height: auto; width: 100%;">
                                            <a class="btn btn-primary"  href="{{ asset('storage/'.$driver->details->license_photo) }}" target="_blank">View</a>
                                    </p>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">

                            <div class="d-flex b-skills">
                                <div>
                                </div>
                                <div class="">
                                    <h5>NID</h5>
                                    <p>
                                        <img src='{{ asset('storage/'.$driver->details->nid_photo) }}' style="height: auto; width: 100%;">
                                        <a class="btn btn-primary"  href="{{ asset('storage/'.$driver->details->nid_photo) }}" target="_blank">View</a>
                                    </p>
                                </div>
                            </div>

                        </div>



                    </div>

                </div>

            </div>
        </div>
        <div class="widget widget-table-one">
            <div class="widget-heading">
                <h5 class="">Driver Reference</h5>
            </div>

            <div class="widget-content">
                <div class="transactions-list">
                    <div class="t-item">
                        <div class="t-company-name">
                            <div class="t-icon">
                                <div class="avatar avatar-xl">
                                    <span class="avatar-title rounded-circle"></span>
                                </div>
                            </div>
                            <div class="t-name">
                                <h4>Refence Name</h4>
                                <p class="meta-date">{{$driver->ref_name}}</p>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="transactions-list">
                    <div class="t-item">
                        <div class="t-company-name">
                            <div class="t-icon">
                                <div class="avatar avatar-xl">
                                    <span class="avatar-title rounded-circle"></span>
                                </div>
                            </div>
                            <div class="t-name">
                                <h4>Reference Phone</h4>
                                <p class="meta-date">{{$driver->ref_phone}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="transactions-list">
                    <div class="t-item">
                        <div class="t-company-name">
                            <div class="t-icon">
                                <div class="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                </div>
                            </div>
                            <div class="t-name">
                                <h4>Driver Address</h4>
                                <p class="meta-date">{{$driver->address}}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
{{--    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12 layout-spacing">--}}

{{--    </div>--}}

</div>
<div class="printable" id="printable" style="display: none" >
    <table style="width: 362px; border: dot-dash; margin: 20px">
        <tbody>
        <tr>
            <td style="width: 131px;">&nbsp;Name</td>
            <td style="width: 230px;">&nbsp;{{$driver->user->name}}</td>
        </tr>
        <tr>
            <td style="width: 131px;">&nbsp;NID</td>
            <td style="width: 230px;">&nbsp;{{$driver->details->nid}}</td>
        </tr>
        <tr>
            <td style="width: 131px;">&nbsp;Phone Number</td>
            <td style="width: 230px;">&nbsp;{{$driver->phone_number}}</td>
        </tr>
        <tr>
            <td style="width: 131px;">&nbsp;Address</td>
            <td style="width: 230px;">&nbsp;{{$driver->address}}</td>
        </tr>
        <tr>
            <td style="width: 131px;">&nbsp;License Number</td>
            <td style="width: 230px;">&nbsp;{{$driver->license_number}}</td>
        </tr>
        <tr>
            <td style="width: 131px;">&nbsp;License Validity</td>
            <td style="width: 230px;">&nbsp;{{date('d-m-Y', strtotime($driver->license_validity))}}</td>
        </tr>
        <tr>
            <td style="width: 131px;">&nbsp;Ref. Name</td>
            <td style="width: 230px;">&nbsp;{{$driver->ref_name}}</td>
        </tr>
        <tr>
            <td style="width: 131px;">&nbsp;Ref Phone Number</td>
            <td style="width: 230px;">&nbsp;{{$driver->ref_phone}}</td>
        </tr>
        <tr>
            <td style="width: 131px;">&nbsp;Driver Picture</td>
            <td style="width: 230px;">&nbsp;<img id="primg" src="{{ asset('storage/'.$driver->details->driver_photo) }}" alt="avatar" style="max-width: 90px; height: 90px"></td>
        </tr>
        </tbody>
    </table>
    <!-- DivTable.com -->
</div>

{{--    <button id="cmd">generate PDF</button>--}}

@endsection
@section('js')
    <script src="{{asset('base/assets/js/widgets/modules-widgets.js')}}"></script>
    <script src="{{asset('base/plugins/apex/apexcharts.min.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>

        <script>

        function saveDiv(divId, title) {
            var doc = new jsPDF('p', 'pt', 'a4', true);
            specialElementHandlers = {
                // element with id of "bypass" - jQuery style selector
                '#bypassme': function (element, renderer) {
                    // true = "handled elsewhere, bypass text extraction"
                    return true
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };

            doc.fromHTML(
                `<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`, // HTML string or DOM elem ref.
                20, // x coord
                20, { // y coord
                    'width': margins.width, // max width of content on PDF
                    'elementHandlers': specialElementHandlers
                },

                function (dispose) {
                    // dispose: object with X, Y of the last line add to the PDF
                    //          this allow the insertion of new lines after html
                    doc.save('Test.pdf');
                }, margins
            );
        }

    </script>

@endsection



