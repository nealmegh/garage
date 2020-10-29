<!DOCTYPE html>
<html lang="en">
<head>

@include('layouts.partials.head')
@yield('head')

</head>
<body>
<!-- BEGIN LOADER -->
<div id="load_screen"> <div class="loader"> <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div></div></div>
<!--  END LOADER -->

<!--  BEGIN NAVBAR  -->
@include('layouts.partials.navbar')
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    @include('layouts.partials.sidebar')
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">

        @yield('content')

            </div>
        </div>
        @if(Route::currentRouteName() == 'rent.index')
            @include('layouts.endTripModal')
        @endif

        @include('layouts.partials.footer')
    </div>
    <!--  END CONTENT AREA  -->
    @if(Route::currentRouteName() == 'transaction.index')
        @include('layouts.addMoneyModal')
        @include('layouts.payCaseModal')
        @include('layouts.collectCaseModal')
        @include('layouts.addDamageModal')
        @include('layouts.withdrawMoneyModal')
        @include('layouts.loanModal')
        @include('layouts.loanPaymentModal')
        @include('layouts.reMoneyModal')
        @include('layouts.addCollectionModal')
        @include('layouts.paySupplierModal')
    @endif

</div>
<!-- END MAIN CONTAINER -->


@include('layouts.partials.js')
@yield('js')
</body>
</html>
