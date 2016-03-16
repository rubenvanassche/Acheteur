@extends('acheteur.master')

@section('title', 'Delete User')

@section('content')
    <div class="ui grid">
        <div class="column">
            {!! Form::open(array('action' => ['UserController@destroy', $id], 'method' => 'delete', 'class' => 'ui form')) !!}

            <div class="ui buttons">
                <a href="{{ action('UserController@index') }}" class="ui button">Cancel</a>
                <div class="or"></div>
                <input type="submit" value="Continue" class="ui button negative" type="submit"></input>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection