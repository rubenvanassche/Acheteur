@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.delete').' '.trans('basic.shift'))

@section('pane')
    @if(count($shifts) == 0)
        <p>{{ trans('shift.noshiftselect') }}</p>
        <a href="{{ action('ShiftController@index') }}" class="positive ui button float-right">{{ trans('basic.back') }}</a>
    @else
        {!! Form::open(array('action' => ['ShiftController@destroy', $id], 'method' => 'delete', 'class' => 'ui form')) !!}

        <p>{{ trans('shift.selectshiftmerge') }}</p>

        <table class="ui unstackable table">
            <thead>
            <tr>
                <th class="collapsing"></th>
                <th>{{ trans('basic.start') }}</th>
                <th>{{ trans('basic.end' )}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($shifts as $shift)
                <tr>
                    <td>{!! Form::Radio('shiftselect', $shift->id) !!}</td>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d G:i:s', $shift->start)->format('d-m-Y G:i:s') }}</td>
                    <td>{{ Carbon\Carbon::createFromFormat('Y-m-d G:i:s', $shift->end)->format('d-m-Y G:i:s') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="ui buttons pull-right">
            <a href="{{ action('ShiftController@index') }}" class="ui positive button">{{ trans('basic.cancel') }}</a>
            <div class="or"></div>
            <input type="submit" value="{{ trans('shift.mergeanddelete') }}" class="ui button negative" type="submit"></input>
        </div>

        {!! Form::close() !!}
    @endif
@endsection