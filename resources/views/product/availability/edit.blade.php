@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.productavailability').' - '.trans('basic.edit'))

@section('pane')

    @include('errors')

    {!! Form::model($event, array('action' => ['ProductAvailabilityController@update', $product->id], 'method' => 'put', 'class' => 'ui form')) !!}

    <table class="ui unstackable table">
        <thead>
        <tr>
            <th>{{ trans('basic.shift') }}</th>
            <th>{{ trans('basic.amount') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($availability as $row)
            <tr>
                <td>{{ $row->shift->beautify() }}</td>
                <td>{!! Form::number('available'.$row->shift->id, $row->available) !!}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="ui buttons float-right">
        <a href="{{ action('ProductAvailabilityController@index', $product->id) }}" class="ui negative button">{{ trans('basic.cancel') }}</a>
        <div class="or"></div>
        <input type="submit" value="{{ trans('basic.edit') }}" class="ui button positive" type="submit"></input>
    </div>
    {!! Form::close() !!}
@endsection