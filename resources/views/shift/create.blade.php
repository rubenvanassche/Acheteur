@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.new').' '.trans('basic.shift'))

@section('pane')

            @include('errors')

            {!! Form::open(array('action' => 'ShiftController@store', 'class' => 'ui form')) !!}
            <div class="field">
                <label>{{ trans('basic.start') }}</label>
                {!! Form::text('start',\Carbon\Carbon::now()->format('d-m-Y G:i:s'),array('class'=>'datetimepicker')) !!}
            </div>
            <div class="field">
                <label>{{ trans('basic.end') }}</label>
                {!! Form::text('end',\Carbon\Carbon::now()->format('d-m-Y G:i:s'),array('class'=>'datetimepicker')) !!}
            </div>

            <h4 class="ui horizontal divider header">
                {{trans('basic.product')}} {{ trans('basic.availability') }}
            </h4>
            @foreach($products as $product)
                <div class="field">
                    <label>{{ $product->name }}</label>
                    {!! Form::number('available'.$product->id, 0) !!}
                </div>
            @endforeach

            <input type="submit" value="{{ trans('basic.add') }}" class="ui button positive" type="submit"></input>
            {!! Form::close() !!}
@endsection