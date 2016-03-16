@extends('acheteur.master')

@section('title', 'New user')

@section('content')
    <div class="ui grid">
        <div class="column">

            @include('acheteur.errors')

            {!! Form::open(array('action' => 'UserController@store', 'class' => 'ui form')) !!}
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
                {!! Form::password('password') !!}
            </div>
            <input type="submit" value="Add" class="ui button positive" type="submit"></input>
            {!! Form::close() !!}
        </div>
    </div>
@endsection