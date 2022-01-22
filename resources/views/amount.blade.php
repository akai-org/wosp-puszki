@extends('layouts.home_page')

@section('content')
    <div class="waves"></div>
    <div style="width: 100vw; height: 100vh; overflow-x: hidden; background-image: url('{{ asset('images/background.svg') }}');   background-repeat: no-repeat;
            background-position: top center;
            background-size: cover;
            position: absolute;
            z-index: 1">
        <div class="collected_site collected_site--split row">
            <section class="main">
                <div class="logos-container">
                    <img class="logos-container__img" src="{{ asset('images/su.svg') }}">
                    <img class="logos-container__img--main logos-container__img"
                         src="{{ asset('images/logo_final.png') }}">
                    <img class="logos-container__img" src="{{ asset('images/akai.svg') }}">
                </div>
                <img class="collected-label" src="{{asset('images/zebralismy.svg')}}">
                <h1 class="total">
                <span id="amount_total_in_PLN">
                    {{ $data['amount_total_in_PLN'] }}
                </span>
                    zł
                </h1>
            </section>
            <section class="details">
                <div class="currencies">
                    <div class="currency">
                        <p>
                        <span id="amount_PLN">
                            {{ $data['amount_PLN'] }}
                        </span>
                            zł
                        </p>
                    </div>
                    <div class="currency">
                        <p>
                        <span id="amount_EUR">
                            {{ $data['amount_EUR'] }}
                        </span>
                            €</p>
                    </div>
                    <div class="currency">
                        <p>
                        <span id="amount_GBP">
                            {{ $data['amount_GBP'] }}
                        </span>
                            £</p>
                    </div>
                    <div class="currency">
                        <p>
                        <span id="amount_USD">
                            {{ $data['amount_USD'] }}
                        </span>
                            $</p>
                    </div>
                </div>
                <div class="extras">
                    <div class="extras-field">
                        <div class="extras-field-value" id="collectors_in_city">
                            {{ $data['collectors_in_city'] }}
                        </div>
                        <div class="extras-field-description">
                            Wolontariuszy
                        </div>
                    </div>
                    <div class="extras-field">
                        <div class="extras-field-value" id="collectors_in_city">
                            {{ $data['collectors_in_city'] }}
                        </div>
                        <div class="extras-field-description">
                            Czynnych
                        </div>
                        <div class="extras-field-description">
                            Stanowisk
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="map_site map_site--split">
            @include('svg.map_vertical')
        </div>
    </div>
@endsection
@section('footer')
    &copy 2017-{{ date('Y') }} <a href="http://wosp.put.poznan.pl/">Sztab WOŚP przy Politechnice Poznańskiej</a> i <a
            href="http://akai.org.pl" class="footer-akai">AKAI</a> <br>
    <div class="footer__currency">
        Kursy: 1€ → {{ $data['rates']['EUR'] }}zł |
        1$ → {{ $data['rates']['USD'] }}zł |
        1£ → {{ $data['rates']['GBP'] }}zł |
    </div>
@endsection

@push('scripts')
    <script defer type="text/javascript">
        const svgz_map = document.querySelector(".map_site > svg");
        const station_prefix = "station";
        const webSocket = new WebSocket('ws://' + window.location.hostname + ':6001/ws/queue');
        const STATUS_UNKNOWN = 0;
        const STATUS_READY = 1;
        const STATUS_BUSY = 2;

        const get_station_number = username => username.match(/[\d]{2}$/);

        const fill_station = (station_no, color) => {
            const station = svg_map.getElementById(station_prefix + station_no)
            if (station != null) {
                station.setAttribute("fill", color);
                station.style.fill = color;
            }
        }

        const process_station_status = (username, status) => {
            let color;
            switch (status) {
                case STATUS_BUSY:
                    color = "red";
                    break;
                case STATUS_READY:
                    color = "green";
                    break;
                case STATUS_UNKNOWN:
                default:
                    color = "black";
            }

            const station_no = get_station_number(username);
            if (station_no != null)
                fill_station(station_no, color);
        }

        webSocket.onmessage = function (message) {
            // let stationsStatus = JSON.parse(message);
            for (const [key, value] of Object.entries(JSON.parse(message.data))) {
                process_station_status(key, value.st);
            }
        }

        let intervalId = window.setInterval(function () {
            webSocket.send(JSON.stringify({
                s: "STATUS",
                st: "guest",
                t: Date.now()
            }));
        }, 1500);

        function loadDoc() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    let json = JSON.parse(this.responseText);
                    document.getElementById("amount_PLN").textContent = json.amount_PLN;
                    document.getElementById("amount_EUR").textContent = json.amount_EUR;
                    document.getElementById("amount_GBP").textContent = json.amount_GBP;
                    document.getElementById("amount_USD").textContent = json.amount_USD;
                    document.getElementById("amount_total_in_PLN").textContent = json.amount_total_in_PLN;
                    document.getElementById("collectors_in_city").textContent = json.collectors_in_city;
                    // document.getElementById("demo").innerHTML =
                    //     this.responseText;
                    console.log(this.responseText)
                }
            };
            xhttp.open("GET", 'http://' + window.location.hostname + '/api', true);
            xhttp.send();
        }

        let intervalId2 = window.setInterval(function () {
            loadDoc()
        }, 5000);


    </script>
@endpush