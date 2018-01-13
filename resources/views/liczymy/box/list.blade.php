@extends('layouts.app')

@section('styles')
<script type="text/javascript" src="{{ asset('js/sortable.js') }}"></script>
@endsection
@section('content')
    <legend>Lista puszek</legend>
    <table class="sortable table table-striped table-hover">
        <thead>
            <tr>
                <th>Puszka</th>
                <th>Numer ID wolontariusza</th>
                <th>Wolontariusz</th>
                <th>PLN</th>
                <th>EUR</th>
                <th>GBP</th>
                <th>USD</th>
                <th>Status</th>
                <th>Inne</th>
                <th>Podgląd</th>
            </tr>
        </thead>
        <tbody>
        @foreach($boxes as $box)
            <tr>
                <td>{{ $box->id }}</td>
                <td>{{ $box->collectorIdentifier }}</td>
                <td>{{$box->collector->firstName}} {{$box->collector->lastName}}</td>
                <td>{{ $box->amount_PLN }}</td>
                <td>{{ $box->amount_EUR }}</td>
                <td>{{ $box->amount_GBP }}</td>
                <td>{{ $box->amount_USD }}</td>
                @if($box->is_confirmed)
                    <td style="background-color:#82CA9D;">Rozliczona</td>
                @elseif($box->is_counted)
                    <td style="background-color:#FF8400;">Oczekuje na zatwierdzenie</td>
                @elseif($box->is_given_to_collector)
                    <td style="background-color:#bae1ff;">Wydana wolontariuszowi</td>
                @endif
                <td>{{ $box->comment}}</td>
                <td><a href="{{route('box.display',['boxID' => $box->id])}}"> Podgląd</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection