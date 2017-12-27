@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('collector.create.post') }}">
        <fieldset>

        {{ csrf_field() }}


        <!-- Form Name -->
            <legend>Dodawanie wolontariusza</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="collectorIdentifier">Numer wolontariusza</label>
                <div class="col-md-4">
                    <input id="collectorIdentifier" name="collectorIdentifier" type="text" placeholder="Np. AWS4562" class="form-control input-md" required="">
                    <span class="help-block">Z identyfikatora</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="firstName">Imię</label>
                <div class="col-md-4">
                    <input id="firstName" name="firstName" type="text" placeholder="Jan" class="form-control input-md" required="">
                    <span class="help-block">Imię wolontariusza</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="lastName">Nazwisko</label>
                <div class="col-md-4">
                    <input id="lastName" name="lastName" type="text" placeholder="Kowalski" class="form-control input-md" required="">
                    <span class="help-block">Nazwisko wolontariusza</span>
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">Dodaj wolontariusza</label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-success">Dodaj wolontariusza</button>
                </div>
            </div>

        </fieldset>
    </form>

@endsection