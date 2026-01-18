@extends('layouts.app')

@section('content')
    <div class="container">
        <form class="form-horizontal" method="POST" action="{{ route('box.create.post') }}" autocomplete="off"
              onsubmit="singlebutton.disabled = true; return true;">
            <fieldset>

            {{ csrf_field() }}

            <!-- Form Name -->
                <legend>Wydawanie puszki</legend>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="collectorIdentifier">Numer identyfikatora</label>
                    <div class="col-md-4">
                        {{-- https://developer.mozilla.org/en-US/docs/Web/Security/Securing_your_site/Turning_off_form_autocompletion --}}
                        <input id="collectorIdentifier" name="collectorIdentifier" type="text" placeholder="Np. 345"
                               class="form-control input-md" required="" value="{{  old('collectorIdentifier') }}"
                               autocomplete="nope">
                        <span class="help-block">Z identyfikatora (Na puszce <b>przed ukośnikiem</b>)</span>
                        <h3 class="warning">Jeśli puszka ma mieć prefix PF, do numeru na puszce dodaj 10 000, a jeśli PS to 20 000</h3>
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton">Dodaj puszkę</label>
                    <div class="col-md-4">
                        <button id="singlebutton" name="singlebutton" class="btn btn-success">Dodaj puszkę</button>
                    </div>
                </div>

            </fieldset>
        </form>
    </div>

@endsection
