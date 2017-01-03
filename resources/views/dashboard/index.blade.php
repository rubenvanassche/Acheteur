@extends('master')

@section('title', 'Dashboard')

@section('content')
    <div id="chart" style="width:100%">
        <svg style="height:300px"></svg>
    </div>

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

@section('css')
    <link rel="stylesheet" href="{{  asset('assets/nvd3/nv.d3.min.css') }}">
@endsection

@section('javascript')
    <script src="{{  asset('assets/nvd3/d3.min.js') }}"></script>
    <script src="{{  asset('assets/nvd3/nv.d3.min.js') }}"></script>
    <script>
        d3.json('dashboard/statistics', function(data) {
            nv.addGraph(function() {
                var chart = nv.models.stackedAreaChart()
                        .margin({right: 100})
                        .x(function(d) { return d[0] })   //We can modify the data accessor functions...
                        .y(function(d) { return d[1] })   //...in case your data is formatted differently.
                        .useInteractiveGuideline(true)    //Tooltips which show all data points. Very nice!
                        .rightAlignYAxis(true)      //Let's move the y-axis to the right side.
                        .showControls(true)       //Allow user to choose 'Stacked', 'Stream', 'Expanded' mode.
                        .clipEdge(true);

                //Format x-axis labels with custom function.
                chart.xAxis
                        .tickFormat(function(d) {
                            return d3.time.format('%d-%m-%Y')(new Date(d))
                        });

                chart.yAxis
                        .tickFormat(d3.format(',.2f'));

                d3.select('#chart svg')
                        .datum(data)
                        .call(chart);

                nv.utils.windowResize(chart.update);

                return chart;
            });
        })

    </script>
@endsection