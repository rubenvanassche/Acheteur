@extends('preferences.master')

@section('title', trans('basic.preferences').' - '.trans('basic.products'))

@section('pane')
    <table class="ui unstackable table">
        <thead>
        <tr>
            <th>{{ trans('basic.name') }}</th>
            <th>{{ trans('basic.preferences') }}</th>
            <th>{{ trans('basic.price') }}</th>
            @if($event->hasShifts())
                <th class="collapsing">{{ trans('basic.available') }}</th>
            @else
                <th>{{ trans('basic.available') }}</th>
            @endif

            <th class="collapsing"><i class="icon pencil"></i></th>
            <th class="collapsing"><i class="icon remove"></i></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>

                @if($event->hasShifts())
                    <td><a href="{{ action('ProductAvailabilityController@index', ['productId' => $product->id]) }}"><i class="chevron circle right icon"></i></a></td>
                @else
                    <td>{{ $product->getAvailability() }}</td>
                @endif
                <td><a href="{{ action('ProductController@edit', ['id' => $product->id]) }}"><i class="icon pencil"></i></a></td>
                <td><a href="{{ action('ProductController@delete', ['id' => $product->id]) }}"><i class="icon remove"></i></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ action('ProductController@create') }}" class="positive ui button float-right"><i class="icon plus"></i> {{ trans('basic.new') }} {{ trans('basic.product') }}</a>
@endsection