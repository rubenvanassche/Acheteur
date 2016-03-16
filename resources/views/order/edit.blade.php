@extends('master')

@section('title', trans('basic.edit').' '.trans('basic.order'))

@section('content')

    @include('errors')

    {!! Form::model($order ,array('action' => ['OrderController@update', $order->id], 'method' => 'put', 'class' => 'ui form')) !!}
    <div class="field">
        <label>{{ trans('basic.name') }}</label>
        {!! Form::text('name') !!}
    </div>

    <div class="field">
        <label>{{ trans('basic.email') }}</label>
        {!! Form::email('email') !!}
    </div>

    <div class="field">
        <label>{{ trans('basic.comments') }}</label>
        {!! Form::textarea('comments') !!}
    </div>

    @if($hasShifts)
        <h4 class="ui horizontal divider header">
            {{ trans('basic.shift') }}
        </h4>

        <div class="grouped fields">
            @foreach($shifts as $shift)

                <div class="field">
                    <div class="ui radio checkbox">
                        {!! Form::radio('shift', $shift->id, $shift->id == $order->shift_id ? true : false) !!}
                        <label>{{ $shift->beautify() }}</label>
                    </div>
                </div>
            @endforeach
        </div>
    @endif



    <h4 class="ui horizontal divider header">
        {{ trans('basic.products') }}
    </h4>


    @foreach($products as $product)
        <div class="field">
            <label><b>{{ $product->name }} - </b>{{ $product->description }}</label>
            {!! Form::number('product'.$product->id, $orderlists[$product->id]) !!}
        </div>
    @endforeach

    <input type="submit" value="{{ trans('basic.edit') }}" class="ui button positive" type="submit"></input>
@endsection