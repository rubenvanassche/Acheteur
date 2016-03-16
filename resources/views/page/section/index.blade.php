@extends('master')

@section('title', trans('basic.sections'))

@section('content')
    <div class="ui cards">
        @foreach($sections as $section)
            <div class="card">
                <div class="content">
                    <div class="header">
                        {{ $section->name }}
                    </div>
                    <div class="meta">
                        {{ '@content('.$section->slug.')' }}
                    </div>
                    <div class="description">
                        {{ \App\Providers\SectionTypes::getDescription($section->type) }}
                    </div>
                </div>
                <div class="extra content">
                    <div class="ui two buttons">
                        <a href="{{ action('SectionController@edit', [$page->id, $section->id]) }}" class="ui basic yellow button">{{ trans('basic.edit') }} {{ trans('basic.content') }}</a>
                        <a href="{{ action('SectionController@delete', [$page->id, $section->id]) }}" class="ui basic red button">{{ trans('basic.delete') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <a href="{{ action('SectionController@create', $page->id) }}" class="positive ui button float-right"><i class="icon plus"></i> {{ trans('basic.new') }} {{ trans('basic.section') }}</a>
@endsection