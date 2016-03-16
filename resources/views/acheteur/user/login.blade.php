<!DOCTYPE html>
<html>
<head>
    <title>Acheteur - Login</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic-ui/semantic.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/acheteur.css') }}">
</head>
<body>


<div class="ui main text container">
    <div class="ui grid">
        <div class="column">
            <h1 class="ui header">Login</h1>
        </div>
    </div>
    <div class="ui grid">
        <div class="column">

            @include('acheteur.errors')

            {!! Form::open(array('action' => 'UserController@postLogin', 'class' => 'ui form')) !!}
            <div class="field">
                <label>Email</label>
                {!! Form::text('email') !!}
            </div>
            <div class="field">
                <label>Password</label>
                {!! Form::password('password') !!}
            </div>
            <input type="submit" value="Login" class="ui button positive" type="submit"></input>
            {!! Form::close() !!}
        </div>
    </div>
</div>


</body>
</html>