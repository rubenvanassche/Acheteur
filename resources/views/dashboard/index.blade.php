@extends('master')

@section('title', 'Dashboard')

@section('content')
    @if($hasShifts == false)
        <table class="ui red table">
            <thead>
            <tr><th>{{ trans('basic.name') }}</th>
                <th>{{ trans('basic.sold') }}</th>
                <th>{{ trans('basic.available') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}
                        @if($product->soldOut())
                                <a class="ui red horizontal label">{{ trans('basic.soldout') }}</a>
                        @endif
                    </td>
                    <td>{{ $product->sold() }}</td>
                    <td>{{ $product->stock() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        @foreach($shifts as $shift)
            <h4>{{ $shift->beautify() }}</h4>
            <table class="ui red table">
                <thead>
                    <tr><th>{{ trans('basic.name') }}</th>
                        <th>{{ trans('basic.sold') }}</th>
                        <th>{{ trans('basic.available') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}
                            @if($product->soldOut($shift->id))
                                <a class="ui red horizontal label">{{ trans('basic.soldout') }}</a>
                            @endif
                        </td>
                        <td>{{ $product->sold($shift->id) }}</td>
                        <td>{{ $product->stock($shift->id) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    @endif
@endsection