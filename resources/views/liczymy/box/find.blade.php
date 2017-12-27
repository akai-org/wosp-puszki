@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.find.post') }}">
        <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
        <legend>Znajdź puszkę do rozliczenia</legend>

        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="boxNumber">Numer puszki</label>
            <div class="col-md-4">
                <input id="boxNumber" name="boxNumber" type="text" placeholder="Np. 235" class="form-control input-md" required="">
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