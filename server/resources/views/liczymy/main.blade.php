@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h1 style="text-align: center;font-size: 3em">
            Zebraliśmy:<br>
            <span style="">{{ \App\totalCollected() }}zł</span>
        </h1>
        <br>
        <h1 style="text-align: center;font-size: 3em">
            Razem z walutami obcymi i eSkarbonką:<br>
            <span style="">{{ \App\totalCollectedWithForeign() }}zł</span>
        </h1>
    </div>
    <br>
    <div class="row">
        @if(Auth::user()->hasAnyRole(['admin', 'superadmin']))
        <div class="col-sm-6" id="puszka-daj">
            {{-- Przycisk "Wydaj puszkę" --}}
            <a class="btn btn-success btn-lg btn-block" href="{{ route('box.create') }}">
                Wydaj puszkę wolontariuszowi
            </a>
        </div>
        <div class="col-sm-6" id="puszka-rozlicz">
            {{-- Przycisk "Rozlicz puszkę" --}}
            <a class="btn btn-info btn-lg btn-block" href="{{ route('box.find') }}">
                Rozlicz puszkę
            </a>
        </div>
        @else
            <div class="col-sm-12" id="puszka-rozlicz">
                {{-- Przycisk "Rozlicz puszkę" --}}
                <a class="btn btn-info btn-lg btn-block" href="{{ route('box.find') }}">
                    Rozlicz puszkę
                </a>
            </div>
        @endif

    </div>
</div>
@endsection
