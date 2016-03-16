@extends('master')

@section('title', trans('basic.new').' '.trans('basic.section'))

@section('content')

            @include('errors')

            {!! Form::open(array('action' => array('SectionController@store', $page->id), 'class' => 'ui form')) !!}
            <div class="field">
                <label>{{ trans('basic.name') }}</label>
                {!! Form::text('name') !!}
            </div>

            <div class="grouped fields">
                <label>{{ trans('section.type') }}</label>
                @foreach($sectionTypes as $sectionType)
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="type" value="{{ $sectionType['type'] }}" checked="" tabindex="0">
                            <label><b>{{$sectionType['name']}} - </b>{{$sectionType['description']}}</label>
                        </div>
                    </div>
                @endforeach
            </div>
            <input type="submit" value="{{ trans('basic.add') }}" class="ui button positive" type="submit"></input>
            {!! Form::close() !!}
@endsection