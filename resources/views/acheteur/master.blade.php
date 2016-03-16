<!DOCTYPE html>
<html>
<head>
    <title>Acheteur - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic-ui/semantic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/acheteur.css') }}">
</head>
<body>

<div class="ui fixed inverted menu">
    <div class="ui container">
        <div href="#" class="header item">
            Acheteur
        </div>
        <a href="{{ action('EventController@index') }}" class="item">Events</a>
        <a href="{{ action('UserController@index') }}" class="item">Users</a>
        <div class="right menu">
            <a href="{{ action('UserController@getLogout') }}" class="item">
                <i class="sign out icon"></i>
            </a>
        </div>
    </div>
</div>

<div class="ui main text container">
    <div class="ui grid">
        <div class="column">
            <h1 class="ui header">@yield('title')</h1>
        </div>
    </div>
    @yield('content')
</div>


</body>
</html>