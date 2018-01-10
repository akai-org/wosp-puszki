@extends('layouts.app')

@section('content')
    <legend>Lista puszek do zatwierdzenia</legend>
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
                <th>Przejdź do zatwierdzenia</th>
            </tr>
        </thead>
        @foreach($boxes as $box)
            <tr>
                <td>{{ $box->collector->identifier }}</td>
                <td>{{$box->collector->firstName}} {{$box->collector->lastName}}</td>
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