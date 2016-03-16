@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.email'))

@section('pane')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th>{{ trans('basic.description') }}</th>
            <th class="collapsing"><i class="icon pencil"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($emails as $email)
            <tr>
                <td>{{ $email['description'] }}</td>
                <td><a href="{{ action('PreferencesController@editEmail', ['type' => $email['type']]) }}"><i class="icon pencil"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection