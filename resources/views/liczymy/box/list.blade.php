@extends('layouts.app')

@section('content')
    <table>
        <thead>
        <td>Puszka</td>
        <td>Wolontariusz</td>
        <td>Kwota PLN</td>
        <td>Kwota EUR</td>
        <td>Kwota GBP</td>
        <td>Kwota USD</td>
        <td>Komentarz</td>
        <td>Status</td>
        <td>Podgląd</td>
        </thead>
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
                    <td>Oczekuje na potwierdzenie</td>
                @elseif($box->is_given_to_collector)
                    <td>Wydana wolontariuszowi</td>
                @endif
                <td>{{ $box->comment}}</td>
                <td><a href="{{route('box.display',['boxNumber' => $box->boxNumber])}}"> Podgląd</a></td>
            </tr>
        @endforeach
    </table>

@endsection