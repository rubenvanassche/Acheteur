@extends('master')


@section('content')
    <div class="ui grid">
        <div class="four wide column">
            <div class="ui vertical menu">
                <div class="item">
                    <div class="menu">
                        <a href="{{ action('PreferencesController@editGeneral') }}" class="active item"><i class="icon settings"></i>{{ trans('basic.general') }}</a>
                    </div>
                </div>
                <div class="item">
                    <div class="menu">
                        <a href="{{ action('ProductController@index') }}" class="item"><i class="icon database"></i>{{ trans('basic.products') }}</a>
                        @if(\App\Configuration::event()->hasShifts())
                         <a href="{{ action('ShiftController@index') }}" class="item"><i class="icon calendar"></i>{{ trans('basic.shifts') }}</a>
                        @endif
                    </div>
                </div>
                <div class="item">
                    <div class="menu">
                        <a href="{{ action('PreferencesController@emails') }}" class="item"><i class="icon mail"></i>{{ trans('basic.emails') }}</a>
                    </div>
                </div>
                <!--
                <div class="item">
                    <div class="menu">
                        <a class="item"><i class="icon puzzle"></i>{{ trans('basic.extrafields') }}</a>
                    </div>
                </div>
                -->
                <div class="item">
                    <div class="menu">
                        <a href="{{ action('PreferencesController@about') }}" class="item"><i class="icon info"></i>{{ trans('basic.about') }} {{ trans('basic.acheteur') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="twelve wide column">
            @yield('pane')
        </div>
    </div>
@endsection