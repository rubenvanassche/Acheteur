@extends('acheteur.master')

@section('title', 'Edit Event')

@section('content')
    <div class="ui grid">
        <div class="column">

            @include('acheteur.errors')

            {!! Form::model($event, array('action' => ['EventController@update', $event->id], 'method' => 'put', 'class' => 'ui form')) !!}
            <div class="field">
                <label>Name</label>
                {!! Form::text('name') !!}
            </div>
            <div class="field">
                <label>Password</label>
                <i>leave empty when you don't want to change the password</i>
                {!! Form::password('password') !!}

            </div>
            <div class="field">
                <div class="ui checkbox">
                    {!! Form::checkbox('shifts', '1') !!}
                    <label>Multiple shifts during this event</label>
                </div>
            </div>
            <div class="ui buttons">
                <a href="{{ action('EventController@index') }}" class="ui negative button">Cancel</a>
                <div class="or"></div>
                <input type="submit" value="Continue" class="ui button positive" type="submit"></input>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection