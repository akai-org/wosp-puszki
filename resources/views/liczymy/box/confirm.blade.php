@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('box.count.confirm', ['boxNumber' => $data['boxNumber']]) }}">
        <fieldset>

        {{ csrf_field() }}

        <!-- Form Name -->
            <legend>Potwierdź puszkę</legend>

            {{ var_dump($data) }}

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton">Potwierdź puszkę</label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-success">Potwierdź puszkę</button>
                </div>
            </div>

            {{-- TODO przycisk cofnij !!! --}}


        </fieldset>
    </form>

@endsection