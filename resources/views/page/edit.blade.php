@extends('master')

@section('title', trans('basic.edit').' '.trans('basic.page'))

@section('content')

    @include('errors')

    {!! Form::model($page ,array('action' => ['PageController@update', $page->id], 'method' => 'put', 'class' => 'ui form')) !!}
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

    <input type="submit" value="{{ trans('basic.edit') }}" class="ui button positive" type="submit"></input>
    {!! Form::close() !!}
@endsection