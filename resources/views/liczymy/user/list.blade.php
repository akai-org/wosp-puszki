@extends('layouts.app')

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Nazwa użytkownika</th>
            <th>Rola</th>
            <th>Zmień hasło</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->roles->first()['description'] }}</td>
                <td><a href="{{ route('user.password', ['user' => $user]) }}">Zmień hasło</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
