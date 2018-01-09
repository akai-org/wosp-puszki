@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('user.password.post', ['user' => $user]) }}" autocomplete="off">
        <fieldset>

        {{ csrf_field() }}


        <!-- Form Name -->
            <legend>Ustaw nowe hasło dla użytkownika: <em>{{ $user->name }}</em></legend>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password">Hasło</label>
                <div class="col-md-4">
                    <input id="password" name="password" type="password" class="form-control input-md" required="">
                </div>
            </div>

            <!-- Password input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="password_confirmation">Potwierdzenie hasła</label>
                <div class="col-md-4">
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control input-md" required="">
                </div>
            </div>

            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-success">Ustaw hasło</button>
                </div>
            </div>

        </fieldset>
    </form>

@endsection