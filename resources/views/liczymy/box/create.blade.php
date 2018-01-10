@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.create.post') }}" autocomplete="off">
        <fieldset>

            {{ csrf_field() }}

            <!-- Form Name -->
            <legend>Dodawanie puszki</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="collectorIdentifier">Numer wolontariusza</label>
                <div class="col-md-4">
                    <input id="collectorIdentifier" name="collectorIdentifier" type="text" placeholder="Np. 345" class="form-control input-md" required="" value="{{  old('collectorIdentifier') }}">
                    <span class="help-block">Z identyfikatora (Na puszce <b>przed ukośnikiem</b>)</span>
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

@endsection