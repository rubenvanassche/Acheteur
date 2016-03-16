@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.edit').' '.trans('basic.shift'))

@section('pane')

    @include('errors')

    {!! Form::model($shift ,array('action' => ['ShiftController@update', $shift->id], 'method' => 'put', 'class' => 'ui form')) !!}
    <div class="field">
        <label>{{ trans('basic.start') }}</label>
        {!! Form::text('start', $shift->start, array('class'=>'datetimepicker')) !!}
    </div>
    <div class="field">
        <label>{{ trans('basic.end') }}</label>
        {!! Form::text('end', $shift->end, array('class'=>'datetimepicker')) !!}
    </div>
    <input type="submit" value="{{trans('basic.edit')}}" class="ui button positive" type="submit"></input>
    {!! Form::close() !!}
@endsection