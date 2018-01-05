@extends('layouts.app')

@section('content')
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Imię</th>
            <th>Nazwisko</th>
            <th>Numer</th>
        </tr>
        </thead>
        <tbody>
        @foreach($collectors as $collector)
        <tr>
            <td>{{ $collector->firstName }}</td>
            <td>{{ $collector->lastName }}</td>
            <td>{{ $collector->identifier }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
