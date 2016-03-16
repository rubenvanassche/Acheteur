@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.edit').' '.trans('basic.product'))

@section('pane')

    @include('errors')

    {!! Form::model($product ,array('action' => ['ProductController@update', $product->id], 'method' => 'put', 'class' => 'ui form')) !!}
    <div class="field">
        <label>{{ trans('basic.name') }}</label>
        {!! Form::text('name') !!}
    </div>
    <div class="field">
        <label>{{ trans('basic.description') }}</label>
        {!! Form::text('description') !!}
    </div>
    <div class="field">
        <label>{{ trans('basic.price') }}</label>
        <div class="inline field">
            <label>€</label>
            {!! Form::number('price') !!}
        </div>
    </div>

    @if(!$event->hasShifts())
        <div class="field">
            <label>{{ trans('basic.available') }}</label>
            {!! Form::number('available', $product->getAvailability()) !!}
        </div>
    @endif

    <input type="submit" value="{{ trans('basic.edit') }}" class="ui button positive" type="submit"></input>
    {!! Form::close() !!}
@endsection