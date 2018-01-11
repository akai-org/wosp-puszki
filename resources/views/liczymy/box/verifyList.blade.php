@extends('layouts.app')

@section('content')
    <legend>Lista puszek do zatwierdzenia</legend>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Numer ID</th>
                <th>Wolontariusz</th>
                <th>Kwota EUR</th>
                <th>Kwota GBP</th>
                <th>Kwota USD</th>
                <th>Kwota PLN</th>
                <th>Komentarz</th>
                <th>Zatwierdź</th> {{-- Ticzek zatwierdzający --}}
                <th>Podgląd</th>
                <th>Modyfikuj</th>
                <th>Godzina</th>
            </tr>
        </thead>
        @foreach($boxes as $box)
            <tr>
                <td>{{ $box->collector->identifier }}</td>
                <td>{{$box->collector->firstName}} {{$box->collector->lastName}}</td>
                <td>{{ $box->amount_EUR }}€</td>
                <td>{{ $box->amount_GBP }}£</td>
                <td>{{ $box->amount_USD }}$</td>
                <td>{{ $box->amount_PLN }}zł</td>
                <td>{{ $box->comment}}</td>
                <td>Ticzek</td>
                <td><a href="{{route('box.verify',['boxNumber' => $box->boxNumber])}}"> Podgląd</a></td>
                <td>Modyfikuj</td>
                <td>{{ $box->time_counted }}</td>
            </tr>
        @endforeach
    </table>

@endsection