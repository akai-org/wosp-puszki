@extends('layouts.app')

@section('content')

    <div id="statusButtons">
        <div>
            <button id="join" class="btn btn-success btn-lg" value="">Jestem gotowy rozliczyć nastepną puszkę</button>
            <button id="leave" class="btn btn-warning btn-lg hidden" >Nie chcę rozliczać dalej - przerwa</button>
        </div>
    </div>

    <div id="collectorIdentifierForm" class="hidden">
        <form class="form-horizontal" method="POST" action="{{ route('box.find.post') }}" autocomplete="off" role="presentation">
            <fieldset>

            {{ csrf_field() }}

            <!-- Form Name -->
                <legend>Znajdź puszkę do rozliczenia</legend>

                {{-- Hidden input to trick chrome --}}
                <input style="display:none">
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="collectorIdentifier">Numer identyfikatora</label>
                    <div class="col-md-4">
                        <input id="collectorIdentifier" name="collectorIdentifier" type="text" placeholder="Np. 235" class="form-control input-md" required="" autocomplete="new-password">
                        <span class="help-block">Z puszki (przed ukośnikiem)</span>
                        <h3 class="warning">Jeśli puszka ma prefix PF, do numeru na puszce dodaj 10 000, a jeśli PS to 20 000</h3>
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
    </div>


@endsection

@push('scripts')
        <script defer type="text/javascript">

            const joinButton = document.querySelector('#join');
            const leaveButton = document.querySelector('#leave');
            const collectorIdentifierForm = document.querySelector('#collectorIdentifierForm');
            const webSocket = new WebSocket('ws://' + window.location.hostname + ':6001/ws/queue');

            let intervalLoop;
            let id = '{{auth()->user()->name}}';
            id = parseInt(id.slice(-2));

            const sendReadyMsg = () => fetch(`http://${window.location.hostname}/api/stations/${id}/ready`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).then(response => console.log(JSON.stringify(response)));
            const sendUnknownMsg = () => fetch(`http://${window.location.hostname}/api/stations/${id}/unknown`, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            }).then(response => console.log(JSON.stringify(response)));

            sendUnknownMsg();
            joinButton.addEventListener('click', function (e) {
                clearInterval(intervalLoop);
                joinButton.classList.add('hidden');
                leaveButton.classList.remove('hidden');
                collectorIdentifierForm.classList.remove('hidden');
                sendReadyMsg();
                intervalLoop = setInterval(sendReadyMsg, 60000);
            });

            leaveButton.addEventListener('click', function () {
                clearInterval(intervalLoop);
                joinButton.classList.remove('hidden');
                leaveButton.classList.add('hidden');
                collectorIdentifierForm.classList.add('hidden');
                sendUnknownMsg();
                intervalLoop = setInterval(sendUnknownMsg, 60000);
            });
        </script>
@endpush
