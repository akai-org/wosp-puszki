@extends('layouts.app')

@section('content')
    <p>
        Znaleziono puszkę {{ $box->boxNumber }}

        <br>
        Wolontariusz {{ $collector->firstName }} {{ $collector->lastName }}
        <br>
        Numer identyfikatora: {{ $collector->identifier }}

        <br>

        Numer na puszce: {{ $box->boxNumber }}/{{ $collector->identifier }}

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