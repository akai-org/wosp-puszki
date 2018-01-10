@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.count.post', ['boxNumber' => $box->boxNumber]) }}" autocomplete="off">
        <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
            <legend>Rozliczenie puszki {{ $box->boxNumber }}</legend>

            {{-- Ilości monet --}}
            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_1gr">Ilość monet 1gr</label>
                <div class="col-md-4">
                    <input id="count_1gr" name="count_1gr" value="{{ old('count_1gr', 0) }}" type="text" placeholder="" class="form-control input-md" required="">

                </div>
            </div>

            {{--2gr--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_2gr">Ilość monet 2gr</label>
                <div class="col-md-4">
                    <input id="count_2gr" name="count_2gr" value="{{ old('count_2gr', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--5gr--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_5gr">Ilość monet 5gr</label>
                <div class="col-md-4">
                    <input id="count_5gr" name="count_5gr" value="{{ old('count_5gr', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--10gr--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_10gr">Ilość monet 10gr</label>
                <div class="col-md-4">
                    <input id="count_10gr" name="count_10gr" value="{{ old('count_10gr', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--20gr--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_20gr">Ilość monet 20gr</label>
                <div class="col-md-4">
                    <input id="count_20gr" name="count_20gr" value="{{ old('count_20gr', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--50gr--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_50gr">Ilość monet 50gr</label>
                <div class="col-md-4">
                    <input id="count_50gr" name="count_50gr" value="{{ old('count_50gr', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--Złote--}}

            {{--1zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_1zl">Ilość monet 1zł</label>
                <div class="col-md-4">
                    <input id="count_1zl" name="count_1zl" value="{{ old('count_1zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--2zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_2zl">Ilość monet 2zł</label>
                <div class="col-md-4">
                    <input id="count_2zl" name="count_2zl" value="{{ old('count_2zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--5zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_5zl">Ilość monet 5zł</label>
                <div class="col-md-4">
                    <input id="count_5zl" name="count_5zl" value="{{ old('count_5zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{-- Banknoty --}}
            {{--10zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_10zl">Ilość banknotów 10zł</label>
                <div class="col-md-4">
                    <input id="count_10zl" name="count_10zl" value="{{ old('count_10zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--20zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_20zl">Ilość banknotów 20zł</label>
                <div class="col-md-4">
                    <input id="count_20zl" name="count_20zl" value="{{ old('count_20zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--50zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_50zl">Ilość banknotów 50zł</label>
                <div class="col-md-4">
                    <input id="count_50zl" name="count_50zl" value="{{ old('count_50zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--100zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_100zl">Ilość banknotów 100zł</label>
                <div class="col-md-4">
                    <input id="count_100zl" name="count_100zl" value="{{ old('count_100zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--200zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_200zl">Ilość banknotów 200zł</label>
                <div class="col-md-4">
                    <input id="count_200zl" name="count_200zl" value="{{ old('count_200zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{--500zł--}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="count_500zl">Ilość banknotów 500zł</label>
                <div class="col-md-4">
                    <input id="count_500zl" name="count_500zl" value="{{ old('count_500zl', 0) }}" type="text" placeholder="" class="form-control input-md" required="">
                </div>
            </div>

            {{-- Waluty obce --}}
            {{-- EUR --}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="amount_EUR">Ilość Euro</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input id="amount_EUR" name="amount_EUR" value="{{ old('amount_EUR', 0) }}" class="form-control" placeholder="Np. 14.00" type="text" required="">
                        <span class="input-group-addon">€ (EUR)</span>
                    </div>
                    <p class="help-block">Suma wartości, bez podziału na monety i banknoty</p>
                </div>
            </div>
            {{-- GBP --}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="amount_GBP">Ilość Funtów Brytyjskich</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input id="amount_GBP" name="amount_GBP" value="{{ old('amount_GBP', 0) }}" class="form-control" placeholder="Np. 14.00" type="text" required="">
                        <span class="input-group-addon">£ (GBP)</span>
                    </div>
                    <p class="help-block">Suma wartości, bez podziału na monety i banknoty</p>
                </div>
            </div>
            {{-- USD --}}
            <div class="form-group">
                <label class="col-md-4 control-label" for="amount_USD">Ilość Dolarów Amerykańskich</label>
                <div class="col-md-4">
                    <div class="input-group">
                        <input id="amount_USD" name="amount_USD" value="{{ old('amount_USD', 0) }}" class="form-control" placeholder="Np. 14.00" type="text" required="">
                        <span class="input-group-addon">$ (USD)</span>
                    </div>
                    <p class="help-block">Suma wartości, bez podziału na monety i banknoty</p>
                </div>
            </div>


            {{-- Pole komentarza --}}

            <!-- Textarea -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="comment">Inne</label>
                <div class="col-md-4">
                    <textarea class="form-control" id="comment" name="comment">{{ old('comment') }}</textarea>
                </div>
            </div>


            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">Wyślij puszkę</label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-success">Wyślij puszkę</button>
                </div>
            </div>

        </fieldset>
    </form>

@endsection