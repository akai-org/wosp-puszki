@extends('layouts.app')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        #confirmed-table tr {

        }

        legend {
            margin-bottom: 0 !important;
        }

        .confirmed {
            background-color: #2ab27b !important;
        }
    </style>
    <script>

        function reloadBoxesToVerify(){
            //ładowanie listy puszek
            //Czyścimy listę puszek
            $('#toconfirm-table > tbody').empty();
            //Dodajemy załadowane puszki
            $.ajax({
                url: '{{ route('api.box.verify.list') }}',
                type: "GET",
                success: function (data) {
                    $.each(data, function (index, box) {
                        console.log(box);
                        $('#toconfirm-table').append(
                            '<tr>' +
                            '<td>'+box.collectorIdentifier+'</td>' +
                            '<td>'+box.collector.firstName + ' ' + box.collector.lastName + '</td>' +
                            '<td>'+box.amount_EUR+'€</td>' +
                            '<td>'+box.amount_GBP+'£</td>' +
                            '<td>'+box.amount_USD +'$</td>' +
                            '<td>'+box.amount_PLN+'zł</td>\n' +
                            '<td>'+box.comment+'</td>' +
                            '<td>' +
                            '<form id="confirm-form-'+box.id+'" method="post" onsubmit="">' +
                            '{{ csrf_field() }}' +
                            '<input type="hidden" name="boxID" value="'+box.id+'">' +
                            '<input class="confirm btn btn-success" type="button"  name="confirm" value="Zatwierdź"/>' +
                            '</form>' +
                            '</td>' +
                            '<td><a href="'+
                            '{{ url('/liczymy/box/display') }}/'+
                            +box.id+'">Podgląd</a>' +
                            '</td>' +
                            '<td><a href="{{ url('/liczymy/box/modify')}}/'+box.id+'">Modyfikuj</a>' +
                            '</td>' +
                            '<td>'+box.time_counted+'</td>');
                        //Dodajemy listener do wysłania

                        $("#confirm-form-"+box.id+" > input.confirm").click(function (e) {
                            e.preventDefault();

                            $.ajax({
                                url: '{{ url('/liczymy/box/verify') }}',
                                type: "POST",
                                data: {
                                    'boxID': box.id,
                                },
                                success: function (data) {
//                                    console.log('confirmed' + box.id);
                                    //Zwrócić sukces TODO
                                    reloadBoxesToVerify();
                                    reloadVerifiedBoxes();
                                },
                                error: function (data) {
                                    console.log(data.responseText);
                                }
                                //TODO zwracać error

                            });
                        });
                    });

                }
            });
        }

        function reloadVerifiedBoxes(){
            //ładowanie listy puszek
            //Czyścimy listę puszek
            $('#confirmed-table > tbody').empty();
            //Dodajemy załadowane puszki
            $.ajax({
                url: '{{ route('api.box.verified') }}',
                type: "GET",
                success: function (data) {
                    $.each(data, function (index, box) {
                        console.log(box);
                        $('#confirmed-table').append(
                            '<tr>' +
                            '<td>'+box.collectorIdentifier+'</td>' +
                            '<td>'+box.collector.firstName + ' ' + box.collector.lastName + '</td>' +
                            '<td>'+box.amount_EUR+'€</td>' +
                            '<td>'+box.amount_GBP+'£</td>' +
                            '<td>'+box.amount_USD +'$</td>' +
                            '<td>'+box.amount_PLN+'zł</td>\n' +
                            '<td>'+box.comment+'</td>' +
                            '<td>' +
                            '<form id="un-confirm-form-'+box.id+'" method="post" onsubmit="">' +
                            '{{ csrf_field() }}' +
                            '<input type="hidden" name="boxID" value="'+box.id+'">' +
                            '<input class="unconfirm btn btn-error" type="button" name="unconfirm" value="Cofnij zatwierdzenie"/>' +
                            '</form>' +
                            '</td>' +
                            '<td><a href="'+
                            '{{ url('/liczymy/box/display') }}/'+
                            +box.id+'">Podgląd</a>' +
                            '</td>' +
                            '<td>Najpierw cofnij</a>' +
                            '</td>' +
                            '<td>'+box.time_confirmed+'</td>');
                        //Dodajemy listener do wysłania

                        $("#un-confirm-form-"+box.id+" > input.unconfirm").click(function (e) {
                            e.preventDefault();

                            $.ajax({
                                url: '{{ url('/liczymy/api/box/unverify') }}',
                                type: "POST",
                                data: {
                                    'boxID': box.id,
                                },
                                success: function (data) {
//                                    console.log(box.id);
//                                    console.log('UNconfirmed' + box.id);

                                    //Zwrócić sukces TODO
                                    reloadVerifiedBoxes();
                                    reloadBoxesToVerify();
                                },
                                error: function (data) {
                                    console.log(data.responseText);
                                }
                                //TODO zwracać error

                            });
                        });
                    });

                }
            });
        }

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            });
            //Przeładowujemy puszki do zatwierdzenia
            reloadBoxesToVerify();
            reloadVerifiedBoxes();

        });
    </script>
@endsection
@section('content')
    <script type="text/javascript">
        {{-- Skrypt do wysłania potwierdzenia bez przeładowania strony --}}

    </script>
    {{-- Lista puszek do zatwierdzenia --}}
    <legend>Lista puszek do zatwierdzenia</legend>
    <table class="table table-striped table-hover" id="toconfirm-table">
        <thead>
        <tr>
            <th>Numer ID</th>
            <th>Wolontariusz</th>
            <th>EUR</th>
            <th>GBP</th>
            <th>USD</th>
            <th>PLN</th>
            <th>Komentarz</th>
            <th>Zatwierdź</th> {{-- Ticzek zatwierdzający --}}
            <th>Podgląd</th>
            <th>Modyfikuj</th>
            <th>Godzina przeliczenia</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        {{--@foreach($boxesToConfirm as $box)--}}
            {{--<tr>--}}
                {{--<td>{{ $box->collector->identifier }}</td>--}}
                {{--<td>{{$box->collector->firstName}} {{$box->collector->lastName}}</td>--}}
                {{--<td>{{ $box->amount_EUR }}€</td>--}}
                {{--<td>{{ $box->amount_GBP }}£</td>--}}
                {{--<td>{{ $box->amount_USD }}$</td>--}}
                {{--<td>{{ $box->amount_PLN }}zł</td>--}}
                {{--<td>{{ $box->comment}}</td>--}}
                {{--@if($box->is_confirmed)--}}
                     {{--Wyświetlamy ptaszka jeżeli potwierdzona puszka --}}
                {{--@endif--}}
                {{--<td>--}}
                    {{--<form class="confirm-btn" action="" method="post">--}}
                        {{--{{ csrf_field() }}--}}
                        {{--<input type="hidden" name="boxID"--}}
                               {{--value="{{ $box->id }}">--}}
                        {{--<input class="btn btn-success" type="submit"--}}
                               {{--name="confirm" value="Zatwierdź"/>--}}
                    {{--</form>--}}
                {{--</td>--}}
                {{--<td><a href="{{route('box.display',['boxID' => $box->id])}}">Podgląd</a>--}}
                {{--</td>--}}
                {{--<td><a href="{{ route('box.modify', ['boxID' => $box->id]) }}">Modyfikuj</a>--}}
                {{--</td>--}}
                {{--<td>{{ $box->time_counted }}</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    </table>

    {{-- Lista puszek zatwierdzonych --}}
    <legend>Lista puszek zatwierdzonych</legend>
    <table class="table table-striped table-hover" id="confirmed-table">
        <thead>
        <tr>
            <th>Numer ID</th>
            <th>Wolontariusz</th>
            <th>EUR</th>
            <th>GBP</th>
            <th>USD</th>
            <th>PLN</th>
            <th>Komentarz</th>
            <th>Cofnij zatwierdzenie</th> {{-- Ticzek zatwierdzający --}}
            <th>Podgląd</th>
            <th>Modyfikuj</th>
            <th>Godzina zatwierdzenia</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
{{--        @foreach($boxesConfirmed as $box)--}}
            {{--<tr class="confirmed">--}}
                {{--<td>{{ $box->collector->identifier }}</td>--}}
                {{--<td>{{$box->collector->firstName}} {{$box->collector->lastName}}</td>--}}
                {{--<td>{{ $box->amount_EUR }}€</td>--}}
                {{--<td>{{ $box->amount_GBP }}£</td>--}}
                {{--<td>{{ $box->amount_USD }}$</td>--}}
                {{--<td>{{ $box->amount_PLN }}zł</td>--}}
                {{--<td>{{ $box->comment}}</td>--}}
                {{--@if($box->is_confirmed)--}}
                    {{-- Wyświetlamy ptaszka jeżeli potwierdzona puszka --}}
                {{--@endif--}}
                {{--<td>--}}{{--}}<a href="{{ route('box.verify', ['boxID' => $box->id]) }}">Zatwierdź</a>--}}{{--</td>--}}
                {{--<td><a href="{{route('box.display',['boxID' => $box->id])}}">Podgląd</a>--}}
                {{--</td>--}}
                {{--<td><a class="disabled" href="#">Modyfikuj</a></td>--}}
                {{--<td>{{ $box->time_confirmed }}</td>--}}
            {{--</tr>--}}
        {{--@endforeach--}}
    </table>
@endsection