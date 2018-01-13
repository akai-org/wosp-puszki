@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.find.post') }}" autocomplete="off" role="presentation">
        <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
        <legend>Znajdź puszkę do rozliczenia</legend>

        {{-- Hidden input to trick chrome --}}
        <input style="display:none">
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="collectorIdentifier">Numer identyfikatora</label>
            <div class="col-md-4">
                <input readonly onfocus="this.removeAttribute('readonly');"  id="collectorIdentifier" name="collectorIdentifier" type="text" placeholder="Np. 235" class="form-control input-md" required="" autocomplete="new-password">
                <span class="help-block">Z puszki (przed ukośnikiem)</span>
            </div>
        </div>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="singlebutton">Wyszukaj puszkę</label>
            <div class="col-md-4">
                <button id="singlebutton" name="singlebutton" class="btn btn-success">Wyszukaj puszkę</button>
            </div>
        </div>


        </fieldset>
    </form>

@endsection