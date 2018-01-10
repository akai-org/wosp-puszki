@extends('layouts.app')

@section('content')
    <h4>Znaleziono puszkę {{ $box->id }}</h4>
    <table class="table table-striped table-hover">
        <tbody>
            <tr>
                <td>Wolontariusz</td>
                <td>{{ $collector->firstName }} {{ $collector->lastName }}</td>
            </tr>
            <tr>
                <td>Numer identyfikatora i na puszce</td>
                <td>{{ $collector->identifier }}</td>
            </tr>
        </tbody>
    </table>
    <ul style="text-align: center; font-size: 2em;list-style-type: none;">
        <li>Potwierdź że dane z puszki i identyfikatora są zgodne z wyświetlonymi.</li>
        <li>Potwierdź że puszka nie nosi śladów uszkodzeń.</li>
        <li>Nie wydawaj rozliczonej puszki wolontariuszowi.</li>
    </ul>
    <form class="form-horizontal" method="POST" action="{{ route('box.findConfirm') }}">
        <fieldset>

        {{ csrf_field() }}

        {{-- Przekazujemy ID puszki --}}
        <input type="hidden" value="{{ $box->id }}" name="boxID">
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