@extends('layouts.app')

@section('content')
    <table>
        <thead>
        <td>Imię</td>
        <td>Nazwisko</td>
        <td>Numer</td>
        </thead>
        @foreach($collectors as $collector)
        <tr>
            <td>{{ $collector->firstName }}</td>
            <td>{{ $collector->lastName }}</td>
            <td>{{ $collector->identifier }}</td>
        </tr>
        @endforeach
    </table>
@endsection
