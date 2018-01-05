@extends('layouts.app')

@section('content')
    <h4>Znaleziono puszkę {{ $box->boxNumber }}</h4>
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <td>Wolontariusz</td>
                <td>{{ $collector->firstName }} {{ $collector->lastName }}</td>
            </tr>
            <tr>
                <td>Numer identyfikatora</td>
                <td>{{ $collector->identifier }}</td>
            </tr>
            <tr>
                <td>Numer na puszce</td>
                <td>{{ $box->boxNumber }}/{{ $collector->identifier }}</td>
            </tr>
        </tbody>
    </table>
    <p>
        Potwierdź że dane z puszki i identyfikatora są zgodne z powyższymi.
        Potwierdź że puszka nie nosi znaków uszkodzeń.

         TODO Checkboxy tutaj do powyższych, więcej tekstu
        {{-- TODO --}}
    </p>
    <form class="form-horizontal" method="POST" action="{{ route('box.findConfirm') }}">
        <fieldset>

        {{ csrf_field() }}

        {{-- Przekazujemy numer puszki --}}
        <input type="hidden" value="{{ $box->boxNumber }}" name="boxNumber">
        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton">Zgodność z danymi rzeczywistymi</label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-success">Potwierdzam</button>
            </div>
        </div>


        </fieldset>
    </form>

@endsection