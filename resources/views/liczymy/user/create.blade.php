@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('user.create.post') }}">
        <fieldset>

        {{ csrf_field() }}


        <!-- Form Name -->
            <legend>Dodawanie użytkownika</legend>

            <!-- Text input-->
            <div class="form-group">
                <label class="col-md-4 control-label" for="userName">Nazwa użytkownika</label>
                <div class="col-md-4">
                    <input id="userName" name="userName" type="text" class="form-control input-md" required="">
                </div>
            </div>

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

            <!-- Select role -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="role">Typ użytkownika</label>
                <div class="col-md-4">
                    <select id="role" name="role" class="form-control">
                        <option value="volounteer">Wolontariusz</option>
                        <option value="admin">Admin</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                </div>
            </div>
            <!-- Button -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                    <button id="singlebutton" name="singlebutton" class="btn btn-success">Dodaj użytkownika</button>
                </div>
            </div>

        </fieldset>
    </form>

@endsection