@extends('layouts.app')

@section('content')
{{
var_dump($box)
}}

<form class="form-horizontal" method="POST" action="{{ route('box.verify.post', ['boxNumber' => $box->boxNumber]) }}">
    <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
        <legend>Zatwierdź puszkę</legend>

        <!-- Button -->
        <div class="form-group">
            <label class="col-md-4 control-label" for="confirm">Potwierdź puszkę</label>
            <div class="col-md-4">
                <button id="confirm" name="confirm" class="btn btn-success">Potwierdź puszkę</button>
            </div>
        </div>

    </fieldset>
</form>
@endsection
