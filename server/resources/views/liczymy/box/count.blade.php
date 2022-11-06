@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.count.post', ['boxID' => $box->id]) }}" autocomplete="off">
        <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
            <legend>Rozliczenie puszki wolontariusza {{ $box->collector->firstName }} {{ $box->collector->lastName }} ({{ $box->collector->identifier }})
                @if(Auth::user()->hasAnyRole(['admin', 'superadmin']))
                    (ID puszki w bazie: {{ $box->id }})
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
                            <input id="count_1gr" name="count_1gr" value="{{ old('count_1gr', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="1gr" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2gr
                        </td>
                        <td>
                            <input id="count_2gr" name="count_2gr" value="{{ old('count_2gr', 0) }}" min="0" type="number" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="2gr" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5gr
                        </td>
                        <td>
                            <input id="count_5gr" name="count_5gr" value="{{ old('count_5gr', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="5gr" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            10gr
                        </td>
                        <td>
                            <input id="count_10gr" name="count_10gr" value="{{ old('count_10gr', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="10gr" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            20gr
                        </td>
                        <td>
                            <input id="count_20gr" name="count_20gr" value="{{ old('count_20gr', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="20gr" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            50gr
                        </td>
                        <td>
                            <input id="count_50gr" name="count_50gr" value="{{ old('count_50gr', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="50gr" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            1zł
                        </td>
                        <td>
                            <input id="count_1zl" name="count_1zl" value="{{ old('count_1zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="1zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2zł
                        </td>
                        <td>
                            <input id="count_2zl" name="count_2zl" value="{{ old('count_2zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="2zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5zł
                        </td>
                        <td>
                            <input id="count_5zl" name="count_5zl" value="{{ old('count_5zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="5zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

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
                    {{-- Bamknoty --}}
                    <tr>
                        <td>
                            10zł
                        </td>
                        <td>
                            <input id="count_10zl" name="count_10zl" value="{{ old('count_10zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="10zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            20zł
                        </td>
                        <td>
                            <input id="count_20zl" name="count_20zl" value="{{ old('count_20zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="20zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            50zł
                        </td>
                        <td>
                            <input id="count_50zl" name="count_50zl" value="{{ old('count_50zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="50zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            100zł
                        </td>
                        <td>
                            <input id="count_100zl" name="count_100zl" value="{{ old('count_100zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="100zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            200zł
                        </td>
                        <td>
                            <input id="count_200zl" name="count_200zl" value="{{ old('count_200zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="200zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr>
                        <td>
                            500zł
                        </td>
                        <td>
                            <input id="count_500zl" name="count_500zl" value="{{ old('count_500zl', 0) }}" type="number" min="0" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="500zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    <tr class="total">
                        <td>
                            <span class="total">Suma</span>
                        </td>
                        <td>
                        </td>
                        <td>
                            <span class="total"><span id="total">0</span> zł</span>
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
                            <div class="input-group">
                                <input id="amount_EUR" name="amount_EUR" value="{{ old('amount_EUR', 0) }}" class="form-control input-xs" placeholder="Np. 14.00" type="text" required="" maxlength="8" size="8">
                                <span class="input-group-addon">€ (EUR)</span>
                            </div>
                            <p class="help-block">Suma wartości, bez podziału na monety i banknoty</p>
                        </td>
                    </tr>
                    <tr>
                        {{-- GBP --}}
                        <td>
                            Funt brytyjski (GBP)
                        </td>
                        <td>
                            <div class="input-group">
                                <input id="amount_GBP" name="amount_GBP" value="{{ old('amount_GBP', 0) }}" class="form-control input-xs" placeholder="Np. 14.00" type="text" required="" maxlength="8" size="8">
                                <span class="input-group-addon">£ (GBP)</span>
                            </div>
                            <p class="help-block">Suma wartości, bez podziału na monety i banknoty</p>
                        </td>
                    </tr>
                    <tr>
                        {{-- USD --}}
                        <td>
                            Dolar amerykański (USD)
                        </td>
                        <td>
                            <div class="input-group">
                                <input id="amount_USD" name="amount_USD" value="{{ old('amount_USD', 0) }}" class="form-control input-xs" placeholder="Np. 14.00" type="text" required="" maxlength="8" size="8">
                                <span class="input-group-addon">$ (USD)</span>
                            </div>
                            <p class="help-block">Suma wartości, bez podziału na monety i banknoty</p>
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
                        {{-- Pole komentarza --}}
                        <td>
                            Inne
                        </td>
                        <td>
                            <textarea class="form-control" id="comment" name="comment">{{ old('comment') }}</textarea>
                            <br>
                            <p class="help-block">Na przykład inne waluty, biżuteria lub papiery wartościowe.</p>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="col-md-12 text-center">
                    <label><input type="checkbox" name="prevent-enter" required value="xxxx"> Potwierdzam poprawność danych</label><br>
                    <button id="singlebutton" name="singlebutton" class="btn btn-success btn-lg">Rozlicz puszkę</button>
                </div>
            </div>



        </fieldset>
    </form>

@endsection

@push('scripts')
    <script type="text/javascript">
        {{-- Skrypt przeliczający na żywo wartości hajsu --}}
        {{-- Nie jestem mistrzem JS, jest brzydko --}}
        {{-- Liczenie hajsu na floatach to ZUOOOO --}}

        /* event listeners */
        window.onload = function () {
            const PLN = {
                '1gr': 0.01,
                '2gr': 0.02,
                '5gr': 0.05,
                '10gr': 0.10,
                '20gr': 0.20,
                '50gr': 0.50,
                '1zl': 1,
                '2zl': 2,
                '5zl': 5,
                '10zl': 10,
                '20zl': 20,
                '50zl': 50,
                '100zl': 100,
                '200zl': 200,
                '500zl': 500
            }
            var elementy=[];
            for (const napis in PLN){
                elementy[PLN[napis]] = document.getElementById('count_' + napis );
                elementy[PLN[napis]].addEventListener("input", function(e){

                    recalculate(napis, this.value, PLN[napis]);
                });
                recalculate(napis, elementy[PLN[napis]].value, PLN[napis] );
            }

        }

        function recalculate(value, count, multiplier) {
            result = +(count*multiplier).toFixed(2);

            //sprawdzamy czy jest liczbą
            if(count === ""){
                document.getElementById(value).innerHTML = '<span style="color:red;font-weight: bold;">--</span>';
            }else {
                document.getElementById(value).textContent = result;
            }
            //Robimy update sumy
            var sum = 0;
            $('.sum').each(function() {
                sum += +$(this).text()||0;
            });
            $("#total").text(sum.toFixed(2));

        }
        {{-- skrypt zapobiegający enterom --}}
        {{-- Enterom zapobiega wymagany checkbox --}}

    </script>
@endpush

@push('scripts')
    <script defer type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const webSocket = new WebSocket('ws://' + window.location.hostname + ':6001/ws/queue');
            let intervalId = window.setInterval(function(){
                webSocket.send(encodeQueueStatusUpdate("BUSY", '{{ auth()->user()->name }}'));
            }, 1500);
        });
    </script>
@endpush