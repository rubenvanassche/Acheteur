@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.email').' - '.trans('basic.edit').''.trans('basic.template'))

@section('pane')

    @include('errors')

    {!! Form::open(array('action' => ['PreferencesController@updateEmail', $type], 'method' => 'put', 'class' => 'ui form')) !!}


    <div class="field">
        <label>{{ trans('basic.code') }}</label>
        <div class="ui grid">
            <div class="ten wide column">
                {!! Form::textarea('code', $code, ['id'=>'code']) !!}
            </div>
            <div class="six wide column">
                <div class="ui segments">
                    <div class="ui inverted segment">
                        <p>{{ trans('basic.properties') }}</p>
                    </div>
                    <div class="ui inverted secondary segment">
                        <p><b>@content('name')</b> {{ trans('basic.name') }}</p>
                        <p><b>@content('ordered')</b> {{ trans('preference.productsordered') }}</p>
                        <p><b>@content('price')</b> {{ trans('preference.pricetopay') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="submit" value="{{ trans('basic.edit') }}" class="ui button positive" type="submit"></input>
    {!! Form::close() !!}
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/codemirror/theme/monokai.css') }}">
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('assets/codemirror/lib/codemirror.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/codemirror/mode/css/css.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/codemirror/mode/xml/xml.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/codemirror/mode/javascript/javascript.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

    <script type="text/javascript">
        CodeMirror.fromTextArea(document.getElementById("code"), {
            lineNumbers: true,
            mode: 'htmlmixed',
            theme: 'monokai'
        });
    </script>
@endsection