@extends('acheteur.master')

@section('title', 'Edit User')

@section('content')
    <div class="ui grid">
        <div class="column">

            @include('acheteur.errors')

            {!! Form::model($user, array('action' => ['UserController@update', $user->id], 'method' => 'put', 'class' => 'ui form')) !!}
            <div class="field">
                <label>Name</label>
                {!! Form::text('name') !!}
            </div>
            <div class="field">
                <label>Email</label>
                {!! Form::text('email') !!}
            </div>
            <div class="field">
                <label>Password</label>
                <i>Leave empty if you don't want to change the password</i>
                {!! Form::password('password') !!}
            </div>
            <div class="ui buttons">
                <a href="{{ action('UserController@index') }}" class="ui negative button">Cancel</a>
                <div class="or"></div>
                <input type="submit" value="Continue" class="ui button positive" type="submit"></input>
            </div>

            {!! Form::hidden('id', $user->id) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection