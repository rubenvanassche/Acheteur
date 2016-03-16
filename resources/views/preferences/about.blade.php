@extends('preferences.master')

@section('title', trans('basic.about').' '.trans('basic.acheteur'))

@section('pane')
    <p>{{ trans('preference.about') }}</p>
    <p><a href="{{ action('PreferencesController@license') }}">{{ trans('preference.license') }}</a> </p>
@endsection