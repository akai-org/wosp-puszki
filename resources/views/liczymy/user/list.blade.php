@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Nazwa użytkownika</th>
                <th>Rola</th>
                @if(Auth::user()->hasAnyRole(['superadmin']))
                    <th>Zmień hasło</th>
                @endif
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->roles->first()['description'] }}</td>
                    @if(Auth::user()->hasAnyRole(['superadmin']))
                        <td><a href="{{ route('user.password', ['user' => $user]) }}">Zmień hasło</a></td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
