<!DOCTYPE html>
<html>
<head>
    <title>{{ $event->name }} - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic-ui/semantic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic-ui-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic-ui-daterangepicker/daterangepicker.css') }}">
    @yield('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/acheteur.css') }}">
</head>
<body>

<div class="ui fixed inverted menu">
    <div class="ui container">
        <div href="#" class="header item">
            {{ $event->name }}
        </div>
        <a href="{{ action('DashboardController@index') }}" class="item">{{ trans('basic.dashboard') }}</a>
        <a href="{{ action('OrderController@index') }}" class="item">{{ trans('basic.orders') }}</a>
        <a href="{{ action('PageController@index') }}" class="item">{{ trans('basic.pages') }}</a>
        <a href="{{ action('PreferencesController@editGeneral') }}" class="item">{{ trans('basic.preferences') }}</a>
        <div class="right menu">
            <a href="{{ action('AuthController@logout') }}" class="item">
                <i class="sign out icon"></i>
            </a>
        </div>
    </div>
</div>

<div class="ui main container">
    <div class="ui grid">
        <div class="column">
            <h1 class="ui header">@yield('title')</h1>
        </div>
    </div>
    @yield('content')
</div>

<script type="text/javascript" src="{{ asset('assets/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/semantic-ui/semantic.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/semantic-ui-daterangepicker/daterangepicker.js') }}"></script>
@yield('javascript')

<script type="text/javascript">
    $(document).ready(function() {
        $('input[class="datetimepicker"]').daterangepicker({
            format: 'DD-MM-YYYY HH:mm:ss',
            timePicker: true,
            singleDatePicker: true,
            timePicker12Hour: false,
            timePickerSeconds: true,
            timePickerIncrement: 1
        });
    });
</script>

</body>
</html>