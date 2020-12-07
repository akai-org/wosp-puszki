@extends('layouts.app')

@section('styles')
    <style>
        .total {
            font-weight: bold;
            color: #2ab27b;
        }
    </style>
@endsection

@section('content')
    <form>
        <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
            <legend>Dane puszki o ID: {{ $box->id }}<a href="{{ url()->previous() }}" class="btn btn-default pull-right">Wróć do poprzedniej strony</a></legend>

            <div class="col-md-3">
                <table class="table table-striped table-hover">
                    <tbody>
                    <tr>
                        <td>Wolontariusz</td>
                        <td>{{ $box->collector->firstName }} {{ $box->collector->lastName }}</td>
                    </tr>
                    <tr>
                        <td>Numer identyfikatora</td>
                        <td>{{ $box->collectorIdentifier }}</td>
                    </tr>
                    <tr>
                        <td>Numer puszki w bazie</td>
                        <td>{{ $box->id }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        @if($box->is_confirmed)
                            <td>Rozliczona</td>
                        @elseif($box->is_counted)
                            <td>Oczekuje na zatwierdzenie</td>
                        @elseif($box->is_given_to_collector)
                            <td>Wydana wolontariuszowi</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Osoba zatwierdzająca</td>
                        <td>{{$box->personConfirming ? $box->personConfirming->name : 'brak'}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            {{-- Tabelka dla łatwiejszego podziału wizualnego--}}
            <div class="col-md-3">
                <table class="table table-striped table-condensed table-responsive">
                    <thead>
                    <tr>
                        <th>
                            Nominał
                        </th>
                        <th>
                            Ilość
                        </th>
                        <th>
                            Wartość
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            1gr
                        </td>
                        <td>
                            {{-- Ilości monet --}}
                            {{ $box->count_1gr }}
                        </td>
                        <td>
                            <span id="1gr" class="sum">{{ $box->count_1gr*0.01 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2gr
                        </td>
                        <td>
                            {{ $box->count_2gr }}
                        </td>
                        <td>
                            <span id="2gr" class="sum">{{ $box->count_2gr * 0.02 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5gr
                        </td>
                        <td>
                            {{ $box->count_5gr }}
                        </td>
                        <td>
                            <span id="5gr" class="sum">{{ $box->count_5gr * 0.05 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            10gr
                        </td>
                        <td>
                            {{ $box->count_10gr }}
                        </td>
                        <td>
                            <span id="10gr" class="sum">{{ $box->count_10gr * 0.1 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            20gr
                        </td>
                        <td>
                            {{ $box->count_20gr }}
                        </td>
                        <td>
                            <span id="20gr" class="sum">{{ $box->count_20gr * 0.2 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            50gr
                        </td>
                        <td>
                            {{ $box->count_50gr }}
                        </td>
                        <td>
                            <span id="50gr" class="sum">{{ $box->count_50gr * 0.5 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1zł
                        </td>
                        <td>
                            {{ $box->count_1zl }}
                        </td>
                        <td>
                            <span id="1zl" class="sum">{{ $box->count_1zl * 1 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2zł
                        </td>
                        <td>
                            {{ $box->count_2zl }}
                        </td>
                        <td>
                            <span id="2zl" class="sum">{{ $box->count_2zl * 2}}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5zł
                        </td>
                        <td>
                            {{ $box->count_5zl }}
                        </td>
                        <td>
                            <span id="5zl" class="sum">{{ $box->count_5zl * 5 }}</span> zł
                        </td>
                    </tr>
                    {{-- Bamknoty --}}
                    <tr>
                        <td>
                            10zł
                        </td>
                        <td>
                        {{ $box->count_10zl }}
                        <td>
                            <span id="10zl" class="sum">{{ $box->count_10zl * 10 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            20zł
                        </td>
                        <td>
                        {{ $box->count_20zl }}
                        <td>
                            <span id="20zl" class="sum">{{ $box->count_20zl * 20 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            50zł
                        </td>
                        <td>
                            {{ $box->count_50zl }}
                        </td>
                        <td>
                            <span id="50zl" class="sum">{{ $box->count_50zl * 50 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            100zł
                        </td>
                        <td>
                            {{ $box->count_100zl }}
                        </td>
                        <td>
                            <span id="100zl" class="sum">{{ $box->count_100zl * 100 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            200zł
                        </td>
                        <td>
                            {{ $box->count_200zl }}
                        </td>
                        <td>
                            <span id="200zl" class="sum">{{ $box->count_200zl * 200 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            500zł
                        </td>
                        <td>
                            {{ $box->count_500zl }}
                        </td>
                        <td>
                            <span id="500zl" class="sum">{{ $box->count_500zl * 500 }}</span> zł
                        </td>
                    </tr>
                    <tr class="total">
                        <td>
                            <span class="total">Suma (bez walut obcych)</span>
                        </td>
                        <td>
                        </td>
                        <td>
                            <span class="total"><span id="total">{{ $box->amount_PLN }}</span> zł</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-3">
                <table class="table table-striped table-condensed">
                    {{-- Waluty obce --}}
                    <thead>
                    <tr>
                        <th>
                            Waluta
                        </th>
                        <th>
                            Ilość
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        {{-- EUR --}}
                        <td>
                            Euro (EUR)
                        </td>
                        <td>
                            <span>{{ $box->amount_EUR }}€ (EUR)</span>
                        </td>
                    </tr>
                    <tr>
                        {{-- GBP --}}
                        <td>
                            Funt brytyjski (GBP)
                        </td>
                        <td>
                            <span>{{ $box->amount_GBP }}£ (GBP)</span>
                        </td>
                    </tr>
                    <tr>
                        {{-- USD --}}
                        <td>
                            Dolar amerykański (USD)
                        </td>
                        <td>
                            <span>{{ $box->amount_USD }}$ (USD)</span>
                        </td>
                    </tr>
                    <tr>
                        {{-- Pole komentarza --}}
                        <td>
                            Inne
                        </td>
                        <td>
                            {{ $box->comment }}
                        </td>
                    </tr>
                    <tr>
                        {{-- Pole komentarza --}}
                        <td>
                            <span class="total">Suma z walutami obcymi</span>
                        </td>
                        <td>
                            <span class="total">{{ $box->total_with_foreign }} zł</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </form>

@endsection