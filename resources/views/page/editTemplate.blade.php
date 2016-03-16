@extends('master')

@section('title', trans('basic.edit').' '.trans('basic.page').' '.trans('basic.template'))

@section('content')

    @include('errors')

    {!! Form::model($page ,array('action' => ['PageController@updateTemplate', $page->id], 'method' => 'put', 'class' => 'ui form')) !!}
    <div class="field">
        <div class="ui grid">
            <div class="ten wide column">
                <label>Code</label>
                {!! Form::textarea('code', $code, ['id'=>'code']) !!}
            </div>
            <div class="six wide column">
                <label>Properties</label>
                <div class="ui inverted segment">
                    <div class="ui inverted accordion">
                        <div class="active title">
                            <i class="dropdown icon"></i>
                            {{ trans('basic.page') }}
                        </div>
                        <div class="active content">
                            <p><b>@title()</b> Page title</p>
                            <p><b>@asset(path)</b> Asset</p>
                        </div>
                        <div class="active title">
                            <i class="dropdown icon"></i>
                            {{ trans('basic.sections') }}
                        </div>
                        <div class="active content">
                            @foreach($sections as $section)
                                <p><b>@content({{ $section->slug }})</b> {{ $section->name }} {{ trans('basic.section') }}</p>
                            @endforeach
                        </div>
                        <div class="title">
                            <i class="dropdown icon"></i>
                            {{ trans('page.formforordering') }}
                        </div>
                        <div class="content">
                            <p><b>@openform()</b> {{ trans('page.openform') }}</p>
                            <p><b>@closeform()</b> {{ trans('page.closeform') }}</p>
                        </div>
                        <div class="title">
                            <i class="dropdown icon"></i>
                            {{ trans('page.fieldsorderform') }}
                        </div>
                        <div class="content">
                            <p><b>@field(name)</b> {{ trans('page.namefield') }}</p>
                            <p><b>@field(email)</b> {{ trans('page.emailfield') }}</p>
                            <p><b>@field(comments)</b> {{ trans('page.commentsfield') }}</p>
                            @foreach($products as $product)
                                <p><b>@product({{ $product->slug }})</b> {{ trans('basic.product') }} {{ $product->name }} {{ trans('basic.field') }}</p>
                            @endforeach
                            @if($hasShifts == true)
                                <p><b>@shifts()</b> {{ trans('page.shiftsfield') }}</p>
                            @endif
                        </div>
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

        $('.accordion')
                .accordion({
                    selector: {
                        trigger: '.title .icon'
                    },
                    exclusive: false
                })
        ;
    </script>
@endsection