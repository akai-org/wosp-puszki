@extends('layouts.app')

@section('styles')
<style>
    .give{
        background-color: #bae1ff;
    }
    .found{
        background: #FFAACC;
    }
    .startedCounting{
        background-color: #CCAAFF;
    }
    .endedCounting{
        background-color: #FFAAEE;
    }
    .confirmed{
        background-color: #FFF79A;
    }
    .verified{
        background-color: #82CA9D;
    }
    .modified{
        background-color: #F7977A;
    }
    .unverified{
        background-color: black;
    }
</style>
<script type="text/javascript">

    function eventTypeToMessage(type) {
        switch (type) {
            case 'give':
                return 'Wydanie puszki';
                break;
            case 'found':
                return 'Wyszukanie puszki';
                break;
            case 'startedCounting':
                return 'Rozpoczęcie przeliczania puszki';
                break;
            case 'endedCounting':
                return 'Zakończenie przeliczania puszki';
                break;
            case 'confirmed':
                return 'Puszka przeliczona i wysłana do zatwierdzenia';
                break;
            case 'verified':
                return 'Puszka zatwierdzona przez administratora';
                break;
            case 'modified':
                return 'Puszka zmodyfikowana przez administratora';
                break;
            case 'unverified':
                return 'Cofnięcie zatwierdzenia przez administratora';
                break;
            default:
                return 'Nieznany typ wydarzenia ' + type;
        }
    }

    function refreshLogs() {
        //ładowanie listy puszek
        //Czyścimy listę puszek
        $('#logs-table > tbody').empty();
        //Dodajemy załadowane puszki
        $.ajax({
            url: '{{ $ApiUrl }}',
            type: "GET",
            success: function (data) {
                $.each(data, function (index, event) {
                    $('#logs-table').append(
                        '<tr class="'+event.type+'">' +
                        '<td>' + event.user.name + '</td>' +
                        '<td>' + event.box.collectorIdentifier + '</td>' +
                        '<td>' + event.box.id + '</td>' +
                        '<td>' + event.type + '</td>' +
                        '<td>' + eventTypeToMessage(event.type) + '</td>' +
                        '<td>' + event.created_at + '</td>' +
                        '</tr>'
                    );
                });

            }
        });
    }

    $(document).ready(function () {
        refreshLogs();


        //Przeładowanie co x sekund
        @if($enableRefresh)
        setInterval(function () {
            refreshLogs();
        }, {{ $interval ?? 10000 }});
        @endif
    });


</script>
@endsection

@section('content')
<div class="container">
    <legend>Logi</legend>
    <table id="logs-table" class="table table-bordered table-hover table-condensed">
        <thead>
        <tr>
            <th>
                Użytkownik
            </th>
            <th>
                Wolontariusz
            </th>
            <th>
                Puszka
            </th>
            <th>
                Akcja
            </th>
            <th>
                Inne
            </th>
            <th>
                Czas
            </th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection