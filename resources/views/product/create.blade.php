@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.new').' '.trans('basic.product'))

@section('pane')

            @include('errors')

            {!! Form::open(array('action' => 'ProductController@store', 'class' => 'ui form')) !!}
            <div class="field">
                <label>{{ trans('basic.name') }}</label>
                {!! Form::text('name') !!}
            </div>
            <div class="field">
                <label>{{ trans('basic.description') }}</label>
                {!! Form::text('description') !!}
            </div>
            <div class="field">
                <label>{{ trans('basic.price') }}</label>
                <div class="inline field">
                    <label>€</label>
                    {!! Form::number('price') !!}
                </div>
            </div>

            @if($event->hasShifts())
                <h4 class="ui horizontal divider header">
                    {{ trans('basic.availability') }}
                </h4>

                @foreach($event->shifts()->get() as $shift)
                    <div class="field">
                        <label>{{ trans('basic.shift') }}: {{ $shift->beautify() }}</label>
                        {!! Form::number('available'.$shift->id, 0) !!}
                    </div>
                @endforeach()
            @else
                <div class="field">
                    <label>{{ trans('basic.available') }}</label>
                    {!! Form::number('available', 0) !!}
                </div>
            @endif
            <input type="submit" value="{{ trans('basic.add') }}" class="ui button positive" type="submit"></input>
            {!! Form::close() !!}
@endsection