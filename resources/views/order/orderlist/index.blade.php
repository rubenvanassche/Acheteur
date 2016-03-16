@extends('master')

@section('title', trans('basic.order').' - '.trans('basic.products'))

@section('content')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th>{{ trans('basic.product') }}</th>
            <th class="collapsing">{{ trans('basic.amount') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orderlists as $orderlist)
            <tr>
                <td>{{ $orderlist->product->name }}</td>
                <td>{{ $orderlist->amount }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection