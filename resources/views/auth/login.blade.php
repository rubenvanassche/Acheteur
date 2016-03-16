<!DOCTYPE html>
<html>
<head>
    <title>{{ $eventName }} - {{ trans('basic.login') }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic-ui/semantic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/acheteur.css') }}">
</head>
<body>


<div class="ui main text container">
    <div class="ui grid">
        <div class="column">
            <h1 class="ui header">{{ trans('basic.login') }}</h1>
        </div>
    </div>
    <div class="ui grid">
        <div class="column">

            @include('errors')

            {!! Form::open(array('action' => 'AuthController@checkLogin', 'class' => 'ui form')) !!}
            <div class="field">
                <label>{{ trans('basic.password') }}</label>
                {!! Form::password('password') !!}
            </div>
            <input type="submit" value="{{ trans('basic.login') }}" class="ui button positive" type="submit"></input>
            {!! Form::close() !!}
        </div>
    </div>
</div>


</body>
</html>