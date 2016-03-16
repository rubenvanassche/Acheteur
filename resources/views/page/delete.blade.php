@extends('master')

@section('title', trans('basic.delete').' '.trans('basic.page'))

@section('content')
    <div class="ui grid">
        <div class="column">
            {!! Form::open(array('action' => ['PageController@destroy', $id], 'method' => 'delete', 'class' => 'ui form')) !!}

            <div class="ui buttons">
                <a href="{{ action('PageController@index') }}" class="ui button">{{ trans('basic.cancel') }}</a>
                <div class="or"></div>
                <input type="submit" value="{{ trans('basic.continue') }}" class="ui button negative" type="submit"></input>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
@endsection