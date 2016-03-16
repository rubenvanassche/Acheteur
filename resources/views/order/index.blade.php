@extends('master')

@section('title', trans('basic.orders'))

@section('content')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th>{{ trans('basic.name') }}</th>
            <th>{{ trans('basic.email') }}</th>
            <th>{{ trans('basic.comments') }}</th>
            <th class="collapsing">{{ trans('basic.products') }}</th>
            <th class="collapsing"><i class="icon pencil"></i></th>
            <th class="collapsing"><i class="icon remove"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->comments }}</td>
                <td><a href="{{ action('OrderlistController@index', $order->id) }}"><i class="chevron circle right icon"></i></a></td>
                <td><a href="{{ action('OrderController@edit', ['id' => $order->id]) }}"><i class="icon pencil"></i></a></td>
                <td><a href="{{ action('OrderController@delete', ['id' => $order->id]) }}"><i class="icon remove"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ action('OrderController@create') }}" class="positive ui button float-right"><i class="icon plus"></i> {{ trans('basic.new') }} {{ trans('basic.order') }}</a>
@endsection