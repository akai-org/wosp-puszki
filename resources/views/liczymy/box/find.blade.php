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
            const webSocket = new WebSocket('ws://' + window.location.host + ':6001/ws/queue');

            let intervalLoop;

            const sendReadyMsg = webSocket.send(window.encodeQueueStatusUpdate("READY", "{{ auth()->user()->name }}"));
            const sendBusyMsg = webSocket.send(window.encodeQueueStatusUpdate("BUSY", "{{ auth()->user()->name }}"));

            joinButton.addEventListener('click', function (e) {
                clearInterval(timeOutLoop);
                joinButton.classList.add('hidden');
                leaveButton.classList.remove('hidden');
                collectorIdentifierForm.classList.remove('hidden');
                intervalLoop = setInterval(sendReadyMsg, 1500);
            });

            leaveButton.addEventListener('click', function () {
                clearInterval(timeOutLoop);
                joinButton.classList.remove('hidden');
                leaveButton.classList.add('hidden');
                collectorIdentifierForm.classList.add('hidden');
                intervalLoop = setInterval(sendBusyMsg, 1500);
            });
        </script>
@endpush