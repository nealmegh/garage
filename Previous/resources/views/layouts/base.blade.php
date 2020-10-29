<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Title Page-->
    <title>Dashboard</title>
    @include('layouts.Associate.head')
    @yield('head')
</head>

<body class="animsition">

<div class="page-wrapper">

    <!-- HEADER MOBILE-->
    <header class="header-mobile d-block d-lg-none">
        @include('layouts.Associate.header-mobile')
    </header>
    <!-- END HEADER MOBILE-->

    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        @include('layouts.Associate.sidemenu-desktop')
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container">

        <!-- HEADER DESKTOP-->
        @include('layouts.Associate.header')
        <!-- HEADER DESKTOP-->

        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                        @yield('content')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2019 Bluwebz. All rights reserved. Template by <a href="https://bluwebz.com">Bluwebz</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END PAGE CONTAINER-->

    </div>
    @if(Route::currentRouteName() == 'rent.index')
        @include('layouts.endTripModal')
    @endif
    @if(Route::currentRouteName() == 'transaction.index')
        @include('layouts.addMoneyModal')
        @include('layouts.addDamageModal')
        @include('layouts.withdrawMoneyModal')
        @include('layouts.loanModal')
        @include('layouts.loanPaymentModal')
        @include('layouts.reMoneyModal')
        @include('layouts.addCollectionModal')
        @include('layouts.paySupplierModal')
    @endif
    @if(Route::currentRouteName() == 'driver.index')
        @include('backend.driver.driverShowModal')
    @endif
    @if(Route::currentRouteName() == 'vehicle.index')
        @include('backend.vehicle.vehicleShowModal')
    @endif
</div>


@include('layouts.Associate.js')
@yield('js')
</body>

</html>
<!-- end document-->
