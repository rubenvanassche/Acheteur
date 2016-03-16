@extends('master')

@section('title', trans('basic.edit').' '.trans('basic.section'))

@section('content')

    @include('errors')

    {!! Form::open(array('action' => array('SectionController@update', $page->id, $section->id), 'method' => 'put', 'class' => 'ui form', 'enctype'=>'multipart/form-data')) !!}


    {!! $editor->form($section->content) !!}

    <input type="submit" value="{{ trans('basic.edit') }}" class="ui button positive" type="submit"></input>
    {!! Form::close() !!}
@endsection

@section('css')
    {!! $editor->css() !!}
@endsection

@section('javascript')
    {!! $editor->javascript() !!}
@endsection