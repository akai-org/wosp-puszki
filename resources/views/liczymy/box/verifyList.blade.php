@extends('layouts.app')
@section('styles')
    <style>

    </style>
@endsection
@section('content')
    <script type="text/javascript">
        {{-- Skrypt do wysłania potwierdzenia bez przeładowania strony --}}

    </script>
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
            <tr @if($box->is_confirmed)class="confirmed"@endif>
                <td>{{ $box->collector->identifier }}</td>
                <td>{{$box->collector->firstName}} {{$box->collector->lastName}}</td>
                <td>{{ $box->amount_EUR }}€</td>
                <td>{{ $box->amount_GBP }}£</td>
                <td>{{ $box->amount_USD }}$</td>
                <td>{{ $box->amount_PLN }}zł</td>
                <td>{{ $box->comment}}</td>
                @if($box->is_confirmed)
                    {{-- Wyświetlamy ptaszka jeżeli potwierdzona puszka --}}
                @endif
                <td><a href="{{ route('box.verify', ['boxID' => $box->id]) }}">Zatwierdź</a></td>
                <td><a href="{{route('box.display',['boxID' => $box->id])}}">Podgląd</a></td>
                <td><a href="{{ route('box.modify', ['boxID' => $box->id]) }}">Modyfikuj</a></td>
                <td>{{ $box->time_counted }}</td>
            </tr>
        @endforeach
    </table>

@endsection