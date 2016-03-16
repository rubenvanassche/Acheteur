<!DOCTYPE html>
<html>
<head>
    <title>{{ $event->name }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/semantic-ui/semantic.css') }}">
</head>
<body>


<div class="ui main container" style="margin-top: 20px;">
    <div class="ui grid">
        <div class="column">
            <h1 class="ui header">{{ $event->name }}</h1>
        </div>
    </div>
    <div class="ui grid">
        <div class="column">
            @foreach($shifts as $shift)
                @if($event->hasShifts())
                    <h3>{{ $shift->beautify() }}</h3>
                @endif
                <table class="ui compact celled definition table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>{{ trans('basic.name') }}</th>
                        <th>{{ trans('basic.email') }}</th>
                        <th>{{ trans('basic.comments') }}</th>
                        <th>{{ trans('basic.price') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shift->orders as $order)
                        <tr  class="active">
                            <td class="collapsing">
                                <div class="ui fitted  checkbox">
                                    <input type="checkbox"> <label></label>
                                </div>
                            </td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->comments }}</td>
                            <td>€ {{ $order->cost() }}</td>
                        </tr>
                        @foreach($order->orderlists as $orderlist)
                            <tr>
                                <td>{{$orderlist->amount}}</td>
                                <td colspan="4">{{$orderlist->product->name}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
</div>


</body>
</html>