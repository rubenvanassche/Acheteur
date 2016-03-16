@extends('acheteur.master')

@section('title', 'Events')

@section('content')

    @include('acheteur.errors')

    <div class="ui grid">
        <div class="column">
            <table class="ui unstackable table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="collapsing"><i class="icon configure"></i></th>
                    <th class="collapsing"><i class="icon remove"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td><a href="{{  url($event->slug) }}">{{ $event->name }}</a></td>
                        <td><a href="{{ action('EventController@edit', ['id' => $event->id]) }}"><i class="icon configure"></i></a></td>
                        <td><a href="{{ action('EventController@delete', ['id' => $event->id]) }}"><i class="icon remove"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="{{ action('EventController@create') }}" class="positive ui button float-right"><i class="icon plus"></i> New event</a>
        </div>
    </div>
@endsection