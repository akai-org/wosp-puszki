@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.create.post') }}">
        <fieldset>

            {{ csrf_field() }}

            <!-- Form Name -->
            <legend>Dodawanie puszki</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="boxNumber">Numer puszki</label>
                <div class="col-md-4">
                    <input id="boxNumber" name="boxNumber" type="text" placeholder="Np. 343" class="form-control input-md" required="" value="{{  old('boxNumber') }}">
                    <span class="help-block">Numer kolejny puszki (to przed ukośnikiem)</span>
                </div>
            </div>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="collectorIdentifier">Numer wolontariusza</label>
                <div class="col-md-4">
                    <input id="collectorIdentifier" name="collectorIdentifier" type="text" placeholder="Np. AWS4562" class="form-control input-md" required="" value="{{  old('collectorIdentifier') }}">
                    <span class="help-block">Z identyfikatora (Na puszce po ukośniku)</span>
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