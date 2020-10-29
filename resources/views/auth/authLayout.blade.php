{{--<!DOCTYPE html>--}}
{{--<html lang="en">--}}


{{--<head>--}}
{{--        <!-- Title Page-->--}}
{{--        <title>Login</title>--}}
{{--        @include('layouts.Associate.head')--}}
{{--        @yield('head')--}}

{{--</head>--}}



{{--<body class="animsition">--}}
{{--@yield('content')--}}




{{--@include('layouts.Associate.js')--}}
{{--@yield('js')--}}

{{--</body>--}}

{{--</html>--}}
{{--<!-- end document-->--}}
<!DOCTYPE html>
<html lang="en">
<head>
@include('layouts.partials.head')
@yield('head')

</head>
<body class="form">
@yield('content')


@include('layouts.partials.js')
@yield('js')


</body>
</html>
