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
        <td>Przejdź do zatwierdzenia</td>
        </thead>
        @foreach($boxes as $box)
            <tr>
                <td>{{ $box->boxNumber }}</td>
                <td>{{$box->collector->firstName}} {{$box->collector->lastName}} ({{ $box->collectorIdentifier }})</td>
                <td>{{ $box->amount_PLN }}</td>
                <td>{{ $box->amount_EUR }}</td>
                <td>{{ $box->amount_GBP }}</td>
                <td>{{ $box->amount_USD }}</td>
                <td>{{ $box->comment}}</td>
                <td><a href="{{route('box.verify',['boxNumber' => $box->boxNumber])}}"> Przejdź do zatwierdzenia</a></td>
            </tr>
        @endforeach
    </table>

@endsection