@extends('layouts.app')

@section('styles')
    <script type="text/javascript" src="{{ asset('js/sortable.js') }}"></script>
@endsection

@section('content')

    <div class="container">
        @if(auth()->user()->hasAnyRole(['collectorcoordinator', 'superadmin']))
            <div class="text-right" style="margin-right: 15px;">
                <a class="btn btn-success btn-lg" href="{{ route('collector.create') }}">
                    Dodaj wolontariusza
                </a>
            </div>
        @endif

        <table id="volounteers" class="sortable table table-striped table-hover">
            <thead>
            <tr>
                <th data-sort="int">Numer ID</th>
                <th data-sort="string">Imię</th>
                <th data-sort="string">Nazwisko</th>
                <th data-sort="float">Kwota zebrana (tylko PLN)</th>
                <th data-sort="string">Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($collectors as $collector)
                <tr>
                    <td>{{ $collector->identifier }}</td>
                    <td>{{ $collector->firstName }}</td>
                    <td>{{ $collector->lastName }}</td>
                    <td>{{ $collector->boxes()->sum('amount_PLN') }}</td>
                    <td style="background-color: {{$status[$collector->identifier]['color'] }};font-weight: bold;">{{ $status[$collector->identifier]['message'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
