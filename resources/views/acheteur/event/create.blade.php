@extends('acheteur.master')

@section('title', 'New Event')

@section('content')
    <div class="ui grid">
        <div class="column">

            @include('acheteur.errors')

            {!! Form::open(array('action' => 'EventController@store', 'class' => 'ui form')) !!}
            <div class="field">
                <label>Name</label>
                {!! Form::text('name') !!}
            </div>
            <div class="field">
                <label>Password</label>
                {!! Form::password('password') !!}
            </div>
            <div class="field">
                <div class="ui checkbox">
                    {!! Form::checkbox('shifts', '1') !!}
                    <label>Multiple shifts during this event</label>
                </div>
            </div>
            <input type="submit" value="Add" class="ui button positive" type="submit"></input>
            {!! Form::close() !!}
        </div>
    </div>
@endsection