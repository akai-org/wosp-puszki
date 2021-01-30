@extends('layouts.app')

@section('styles')
    <style>
        .total {
            font-weight: bold;
            color: #2ab27b;
        }
        .total-big {
            font-size: 30px;
            text-align: center;
            height: 80vh;
            line-height: 80vh;
            font-weight: bold;
            color: #2ab27b;
        }
    </style>
@endsection

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.count.confirm', ['boxID' => $data['boxID']]) }}">
        <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
            <legend>Potwierdzenie rozliczenia puszki wolontariusza {{ $data['collectorIdentifier'] }}
                @if(Auth::user()->hasAnyRole(['admin', 'superadmin']))
                    (ID puszki w bazie: {{ $data["boxID"] }})
                @endif
            </legend>

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
                            {{ $data["count_1gr"] }}
                        </td>
                        <td>
                            <span id="1gr" class="sum">{{ $data["count_1gr"]*0.01 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2gr
                        </td>
                        <td>
                            {{ $data["count_2gr"] }}
                        </td>
                        <td>
                            <span id="2gr" class="sum">{{ $data["count_2gr"] * 0.02 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5gr
                        </td>
                        <td>
                            {{ $data["count_5gr"] }}
                        </td>
                        <td>
                            <span id="5gr" class="sum">{{ $data["count_5gr"] * 0.05 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            10gr
                        </td>
                        <td>
                            {{ $data["count_10gr"] }}
                        </td>
                        <td>
                            <span id="10gr" class="sum">{{ $data["count_10gr"] * 0.1 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            20gr
                        </td>
                        <td>
                            {{ $data["count_20gr"] }}
                        </td>
                        <td>
                            <span id="20gr" class="sum">{{ $data["count_20gr"] * 0.2 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            50gr
                        </td>
                        <td>
                            {{ $data["count_50gr"] }}
                        </td>
                        <td>
                            <span id="50gr" class="sum">{{ $data["count_50gr"] * 0.5 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1zł
                        </td>
                        <td>
                            {{ $data["count_1zl"] }}
                        </td>
                        <td>
                            <span id="1zl" class="sum">{{ $data["count_1zl"] * 1 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2zł
                        </td>
                        <td>
                            {{ $data["count_2zl"] }}
                        </td>
                        <td>
                            <span id="2zl" class="sum">{{ $data["count_2zl"] * 2}}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5zł
                        </td>
                        <td>
                            {{ $data["count_5zl"] }}
                        </td>
                        <td>
                            <span id="5zl" class="sum">{{ $data["count_5zl"] * 5 }}</span> zł
                        </td>
                    </tr>
                    {{-- Bamknoty --}}
                    <tr>
                        <td>
                            10zł
                        </td>
                        <td>
                            {{ $data["count_10zl"] }}
                        <td>
                            <span id="10zl" class="sum">{{ $data["count_10zl"] * 10 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            20zł
                        </td>
                        <td>
                            {{ $data["count_20zl"] }}
                        <td>
                            <span id="20zl" class="sum">{{ $data["count_20zl"] * 20 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            50zł
                        </td>
                        <td>
                            {{ $data["count_50zl"] }}
                        </td>
                        <td>
                            <span id="50zl" class="sum">{{ $data["count_50zl"] * 50 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            100zł
                        </td>
                        <td>
                            {{ $data["count_100zl"] }}
                        </td>
                        <td>
                            <span id="100zl" class="sum">{{ $data["count_100zl"] * 100 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            200zł
                        </td>
                        <td>
                            {{ $data["count_200zl"] }}
                        </td>
                        <td>
                            <span id="200zl" class="sum">{{ $data["count_200zl"] * 200 }}</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            500zł
                        </td>
                        <td>
                            {{ $data["count_500zl"] }}
                        </td>
                        <td>
                            <span id="500zl" class="sum">{{ $data["count_500zl"] * 500 }}</span> zł
                        </td>
                    </tr>
                    <tr class="total">
                        <td>
                            <span class="total">Suma (bez walut obcych)</span>
                        </td>
                        <td>
                        </td>
                        <td>
                            <span class="total"><span id="total">{{ $data["amount_PLN"] }}</span> zł</span>
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
                            <span>{{ $data["amount_EUR"] }}€ (EUR)</span>
                        </td>
                    </tr>
                    <tr>
                        {{-- GBP --}}
                        <td>
                            Funt brytyjski (GBP)
                        </td>
                        <td>
                            <span>{{ $data["amount_GBP"] }}£ (GBP)</span>
                        </td>
                    </tr>
                    <tr>
                        {{-- USD --}}
                        <td>
                            Dolar amerykański (USD)
                        </td>
                        <td>
                            <span>{{ $data["amount_USD"] }}$ (USD)</span>
                        </td>
                    </tr>
                    <tr>
                        {{-- Pole komentarza --}}
                        <td>
                            Inne
                        </td>
                        <td>
                            {{ $data["comment"] }}
                        </td>
                    </tr>
                    <tr>
                        {{-- Pole komentarza --}}
                        {{--<td>--}}
                            {{--<span class="total">Suma z walutami obcymi</span>--}}
                        {{--</td>--}}
                        {{--<td>--}}
                            {{--<span class="total">{{ $data['amount_PLN_with_foreign'] }} zł</span>--}}
                        {{--</td>--}}
                    </tr>
                    </tbody>
                </table>
                <div class="col-md-12 text-center">
                    <h4 class="text-center"><strong>Nie wydawaj puszki wolontariuszowi.</strong></h4>

                    {{--<label><input type="checkbox" name="prevent-enter" required value="xxxx"> Potwierdzam poprawność danych</label><br>--}}
                    <div>
                    <button id="singlebutton" name="singlebutton" class="btn btn-success btn-lg">Potwierdź rozliczenie puszki</button>
                    </div>
                    <br>
                    <div>
                        <a href="{{ url()->previous() }}" class="btn btn-default btn-lg">Wróć do poprzedniej strony</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="total-big">
                    Suma (bez walut obcych): {{ $data["amount_PLN"] }} zł
                </div>
            </div>
        </fieldset>
    </form>

@endsection

@push('scripts')
<script defer type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        const webSocket = new WebSocket('ws://' + window.location.host + ':6001/ws/queue');
        let intervalId = window.setInterval(function(){
            webSocket.send(encodeQueueStatusUpdate("BUSY", {{ auth()->user()->name }}));
        }, 1500);
    });
</script>
@endpush