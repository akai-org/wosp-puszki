@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.count.confirm', ['boxNumber' => $data['boxNumber']]) }}">
        <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
            <legend>Potwierdź puszkę</legend>

            <table class="table table-striped table-hover">
                <tbody>
                <tr>
                    <td>Numer puszki</td>
                    <td>{{ $data["boxNumber"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 1gr</td>
                    <td>{{ $data["count_1gr"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 2gr</td>
                    <td>{{ $data["count_2gr"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 5gr</td>
                    <td>{{ $data["count_5gr"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 10gr</td>
                    <td>{{ $data["count_10gr"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 20gr</td>
                    <td>{{ $data["count_20gr"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 50gr</td>
                    <td>{{ $data["count_50gr"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 1zł</td>
                    <td>{{ $data["count_1zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 2zł</td>
                    <td>{{ $data["count_2zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość monet 5zł</td>
                    <td>{{ $data["count_5zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość banknotów 10zł</td>
                    <td>{{ $data["count_10zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość banknotów 20zł</td>
                    <td>{{ $data["count_20zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość banknotów 50zł</td>
                    <td>{{ $data["count_50zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość banknotów 100zł</td>
                    <td>{{ $data["count_100zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość banknotów 200zł</td>
                    <td>{{ $data["count_200zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość banknotów 500zł</td>
                    <td>{{ $data["count_500zl"] }}</td>
                </tr>
                <tr>
                    <td>Ilość Euro</td>
                    <td>{{ $data["amount_EUR"] }} EUR</td>
                </tr>
                <tr>
                    <td>Ilość Funtów Brytyjskich</td>
                    <td>{{ $data["amount_GBP"] }} GBP</td>
                </tr>
                <tr>
                    <td>Ilość Dolarów Amerykańskich</td>
                    <td>{{ $data["amount_USD"] }} USD</td>
                </tr>
                <tr>
                    <td>Inne</td>
                    <td>{{ $data["comment"] }}</td>
                </tr>
                <tr>
                    <td>Ilość Polskich Złotych (bez walut obcych)</td>
                    <td>{{ $data["amount_PLN"] }} PLN</td>
                </tr>
                </tbody>
            </table>
            <h4 class="text-right"><strong>Nie wydawaj puszki wolontariuszowi.</strong></h4>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">Potwierdź puszkę</label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-success">Potwierdź puszkę</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default">Wróć do poprzedniej strony</a>
                </div>
            </div>
        </fieldset>
    </form>

@endsection