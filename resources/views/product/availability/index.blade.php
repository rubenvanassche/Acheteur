@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.productavailability'))

@section('pane')
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
                <td class="collapsing">{{ $row->available  }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ action('ProductAvailabilityController@edit', $product->id) }}" class="positive ui button float-right"><i class="icon pencil"></i> {{ trans('basic.edit') }}</a>
@endsection