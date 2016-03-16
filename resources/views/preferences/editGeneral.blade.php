@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.general'))

@section('pane')
    {!! Form::model($event ,array('action' => ['PreferencesController@updateGeneral'], 'method' => 'put', 'class' => 'ui form')) !!}
    <div class="field">
        <label>{{ trans('preference.websitename') }}</label>
        {!! Form::text('name') !!}
    </div>

    <div class="field">
        <label>{{ trans('preference.emailfrom') }}</label>
        {!! Form::text('email') !!}
    </div>

    <div class="field">
        <label>{{ trans('preference.pageafterorder') }}</label>
        {!! Form::select('afterOrderPage', $pages, $event->after_order_page_id) !!}
    </div>

    <div class="field">
        <div class="ui checkbox">
            {!! Form::checkbox('shifts', '1') !!}
            <label>{{ trans('preference.multipleshifts') }}</label>
        </div>
    </div>

    <input type="submit" value="{{ trans('basic.edit') }}" class="ui button positive" type="submit"></input>
    {!! Form::close() !!}
@endsection