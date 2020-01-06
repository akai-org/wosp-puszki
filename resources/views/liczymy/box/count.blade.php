@extends('layouts.app')

@section('styles')
    <style>
        .input-xs {
            height: 22px;
            padding: 2px 5px;
            font-size: 12px;
            line-height: 1.5; /* If Placeholder of the input is moved up, rem/modify this. */
            border-radius: 3px;
        }
        .input-group-addon {
            height: 18px;
            padding: 2px 5px;
            font-size: 12px;
            line-height: 1.5; /* If Placeholder of the input is moved up, rem/modify this. */
            border-radius: 3px;
        }
        .total {
            font-weight: bold;
            color: #2ab27b;
        }
    </style>
    <script type="text/javascript">
        {{-- Skrypt przeliczający na żywo wartości hajsu --}}
        {{-- Nie jestem mistrzem JS, jest brzydko --}}
        {{-- Liczenie hajsu na floatach to ZUOOOO --}}

        /* event listeners */
        window.onload = function () {
            element_1gr = document.getElementById('count_1gr');
            element_1gr.addEventListener("input", function (e) {
                recalculate('1gr', this.value, 0.01);
            });
            recalculate('1gr', element_1gr.value, 0.01);


            element_2gr = document.getElementById('count_2gr');
            element_2gr.addEventListener("input", function (e) {
                recalculate('2gr', this.value, 0.02);
            });
            recalculate('2gr', element_2gr.value, 0.02);


            element_5gr = document.getElementById('count_5gr');
            element_5gr.addEventListener("input", function (e) {
                recalculate('5gr', this.value, 0.05);
            });
            recalculate('5gr', element_5gr.value, 0.05);

            element_10gr = document.getElementById('count_10gr');
            element_10gr.addEventListener("input", function (e) {
                recalculate('10gr', this.value, 0.1);
            });
            recalculate('10gr', element_10gr.value, 0.1);


            element_20gr = document.getElementById('count_20gr');
            element_20gr.addEventListener("input", function (e) {
                recalculate('20gr', this.value, 0.2);
            });
            recalculate('20gr', element_20gr.value, 0.2);

            element_50gr = document.getElementById('count_50gr');
            element_50gr.addEventListener("input", function (e) {
                recalculate('50gr', this.value, 0.5);
            });
            recalculate('50gr', element_50gr.value, 0.5);

            element_1zl = document.getElementById('count_1zl');
            element_1zl.addEventListener("input", function (e) {
                recalculate('1zl', this.value, 1);
            });
            recalculate('1zl', element_1zl.value, 1);

            element_2zl = document.getElementById('count_2zl');
            element_2zl.addEventListener("input", function (e) {
                recalculate('2zl', this.value, 2);
            });
            recalculate('2zl', element_2zl.value, 2);

            element_5zl = document.getElementById('count_5zl');
            element_5zl.addEventListener("input", function (e) {
                recalculate('5zl', this.value, 5);
            });
            recalculate('5zl', element_5zl.value, 5);

            element_10zl = document.getElementById('count_10zl');
            element_10zl.addEventListener("input", function (e) {
                recalculate('10zl', this.value, 10);
            });
            recalculate('10zl', element_10zl.value, 10);

            element_20zl = document.getElementById('count_20zl');
            element_20zl.addEventListener("input", function (e) {
                recalculate('20zl', this.value, 20);
            });
            recalculate('20zl', element_20zl.value, 20);

            element_50zl = document.getElementById('count_50zl');
            element_50zl.addEventListener("input", function (e) {
                recalculate('50zl', this.value, 50);
            });
            recalculate('50zl', element_50zl.value, 50);

            element_100zl = document.getElementById('count_100zl');
            element_100zl.addEventListener("input", function (e) {
                recalculate('100zl', this.value, 100);
            });
            recalculate('100zl', element_100zl.value, 100);

            element_200zl = document.getElementById('count_200zl');
            element_200zl.addEventListener("input", function (e) {
                recalculate('200zl', this.value, 200);
            });
            recalculate('200zl', element_200zl.value, 200);

            element_500zl = document.getElementById('count_500zl');
            element_500zl.addEventListener("input", function (e) {
                recalculate('500zl', this.value, 500);
            });
            recalculate('500zl', element_500zl.value, 500);

        }

        function recalculate(value, count, multiplier) {
            result = +(count*multiplier).toFixed(2);
            document.getElementById(value).textContent = result;

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
@endsection
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
                            <input id="count_1gr" name="count_1gr" value="{{ old('count_1gr', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_2gr" name="count_2gr" value="{{ old('count_2gr', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_5gr" name="count_5gr" value="{{ old('count_5gr', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_10gr" name="count_10gr" value="{{ old('count_10gr', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_20gr" name="count_20gr" value="{{ old('count_20gr', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_50gr" name="count_50gr" value="{{ old('count_50gr', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_1zl" name="count_1zl" value="{{ old('count_1zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_2zl" name="count_2zl" value="{{ old('count_2zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_5zl" name="count_5zl" value="{{ old('count_5zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
                        </td>
                        <td>
                            <span id="5zl" class="sum">0</span> zł
                        </td>
                    </tr>
                    {{-- Bamknoty --}}
                    <tr>
                        <td>
                            10zł
                        </td>
                        <td>
                            <input id="count_10zl" name="count_10zl" value="{{ old('count_10zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_20zl" name="count_20zl" value="{{ old('count_20zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_50zl" name="count_50zl" value="{{ old('count_50zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_100zl" name="count_100zl" value="{{ old('count_100zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_200zl" name="count_200zl" value="{{ old('count_200zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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
                            <input id="count_500zl" name="count_500zl" value="{{ old('count_500zl', 0) }}" type="text" placeholder="" class="form-control input-xs" required="" maxlength="8" size="8">
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