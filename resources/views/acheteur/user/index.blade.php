@extends('acheteur.master')

@section('title', 'Users')

@section('content')
    <div class="ui grid">
        <div class="column">
            <table class="ui unstackable table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th class="collapsing"><i class="icon pencil"></i></th>
                    <th class="collapsing"><i class="icon remove"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><a href="{{ action('UserController@edit', ['id' => $user->id]) }}"><i class="icon pencil"></i></a></td>
                        <td><a href="{{ action('UserController@delete', ['id' => $user->id]) }}"><i class="icon remove"></i></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <a href="{{ action('UserController@create') }}" class="positive ui button float-right"><i class="icon plus"></i> New User</a>
        </div>
    </div>
@endsection