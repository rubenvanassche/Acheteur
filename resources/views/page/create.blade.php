@extends('master')

@section('title', trans('basic.new').' '.trans('basic.page'))

@section('content')

            @include('errors')

            {!! Form::open(array('action' => 'PageController@store', 'class' => 'ui form')) !!}
            <div class="field">
                <label>{{ trans('basic.title') }}</label>
                {!! Form::text('title') !!}
            </div>

            <div class="field">
                <div class="ui checkbox">
                    {!! Form::checkbox('home', '1') !!}
                    <label>{{ trans('page.homepage') }}</label>
                </div>
            </div>
            <input type="submit" value="{{ trans('basic.add') }}" class="ui button positive" type="submit"></input>
            {!! Form::close() !!}
@endsection