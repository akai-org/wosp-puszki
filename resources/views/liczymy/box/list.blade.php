@extends('layouts.app')

@section('content')
    <legend>Lista puszek</legend>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Puszka</th>
                <th>Wolontariusz</th>
                <th>Kwota PLN</th>
                <th>Kwota EUR</th>
                <th>Kwota GBP</th>
                <th>Kwota USD</th>
                <th>Komentarz</th>
                <th>Status</th>
                <th>Podgląd</th>
            </tr>
        </thead>
        <tbody>
        @foreach($boxes as $box)
            <tr>
                <td>{{ $box->boxNumber }}</td>
                <td>{{$box->collector->firstName}} {{$box->collector->lastName}} ({{ $box->collectorIdentifier }})</td>
                <td>{{ $box->amount_PLN }}</td>
                <td>{{ $box->amount_EUR }}</td>
                <td>{{ $box->amount_GBP }}</td>
                <td>{{ $box->amount_USD }}</td>
                @if($box->is_confirmed)
                    <td>Rozliczona</td>
                @elseif($box->is_counted)
                    <td>Oczekuje na zatwierdzenie</td>
                @elseif($box->is_given_to_collector)
                    <td>Wydana wolontariuszowi</td>
                @endif
                <td>{{ $box->comment}}</td>
                <td><a href="{{route('box.display',['boxNumber' => $box->boxNumber])}}"> Podgląd</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection