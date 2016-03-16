@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.shifts'))

@section('pane')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th>{{ trans('basic.start') }}</th>
            <th>{{ trans('basic.end') }}</th>
            <th class="collapsing"><i class="icon pencil"></i></th>
            <th class="collapsing"><i class="icon remove"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($shifts as $shift)
            <tr>
                <td>{{ $shift->start }}</td>
                <td>{{ $shift->end }}</td>
                <td><a href="{{ action('ShiftController@edit', ['id' => $shift->id]) }}"><i class="icon pencil"></i></a></td>
                <td><a href="{{ action('ShiftController@delete', ['id' => $shift->id]) }}"><i class="icon remove"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ action('ShiftController@create') }}" class="positive ui button float-right"><i class="icon plus"></i> {{ trans('basic.new') }} {{ trans('basic.shift') }}</a>
@endsection