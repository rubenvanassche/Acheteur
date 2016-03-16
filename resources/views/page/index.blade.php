@extends('master')

@section('title', trans('basic.pages'))

@section('content')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th class="collapsing"><i class="icon home"></i></th>
            <th>{{ trans('basic.title') }}</th>
            <th class="collapsing">{{ trans('basic.sections') }}</th>
            <th class="collapsing">{{ trans('page.template') }}</th>
            <th class="collapsing"><i class="icon pencil"></i></th>
            <th class="collapsing"><i class="icon remove"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($pages as $page)
            <tr>
                @if($page->home == '1')
                    <td><i class="icon home"></i></td>
                @else
                    <td> </td>
                @endif
                <td><a href="{{ action('FrontController@page', [$page->slug]) }}">{{ $page->title }}</a></td>
                <td>{{ $page->sections->count() }} <a href="{{ action('SectionController@index', $page->id) }}"><i class="chevron circle right icon"></i></a></td>
                <td><a href="{{ action('PageController@editTemplate', ['id' => $page->id]) }}"><i class="icon code"></i></a></td>
                <td><a href="{{ action('PageController@edit', ['id' => $page->id]) }}"><i class="icon pencil"></i></a></td>
                <td><a href="{{ action('PageController@delete', ['id' => $page->id]) }}"><i class="icon remove"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ action('PageController@create') }}" class="positive ui button float-right"><i class="icon plus"></i> {{ trans('basic.new') }} {{ trans('basic.page') }}</a>
@endsection