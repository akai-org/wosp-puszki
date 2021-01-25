@extends('layouts.home_page')

@section('content')
    <div style="width: 100vw; height: 100vh; overflow-x: hidden; background-image: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.3) 0%), url('{{ asset('images/background.svg') }}');   background-repeat: no-repeat;
            background-position: top center;
            background-size: cover;
            background-color: #1b2748;">
        <div class="collected_site collected_site--split row">
            <section class="main">
                <div class="final-logo">
                    <img src="{{ asset('images/logo_final.svg') }}">
                </div>
                <h2>Zebraliśmy</h2>
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
                        <div class="extras-field-description">
                            Wolontariuszy
                        </div>
                        <div class="extras-field-description">
                            na mieście
                        </div>

                        <div class="extras-field-value" id="collectors_in_city">
                            {{ $data['collectors_in_city'] }}
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
            href="http://akai.org.pl" class="footer-akai"><span style="color: #FAA21B">A</span>KAI</a> <br>
    Kursy: 1€→{{ $data['rates']['EUR'] }}zł
    1$→{{ $data['rates']['USD'] }}zł
    1£→{{ $data['rates']['GBP'] }}zł
@endsection

@push('scripts')
    <script defer type="text/javascript">
        const svg_map = document.querySelector(".map_site > svg");
        const station_prefix = "station";
        const booked_stations = 5;

        const get_station_number = username => username.match(/[\d]{2}$/);

        const fill_station = (station_no, color) => {
            if (parseInt(station_no) >= 30 - booked_stations) {
                color = "blue";
            }

            const station = svg_map.getElementById(station_prefix + station_no)
            if (station != null) {
                station.setAttribute("fill", color);
                station.style.fill = color;
            }
        }

        const process_station_status = (username, status) => {
            let color;
            switch (status) {
                case 'busy':
                    color = "red";
                    break;
                case 'ready':
                    color = "green";
                    break;
                case 'booksy':
                    color = "blue";
                    break;
                default:
                    color = "black";
            }

            const station_no = get_station_number(username);
            if (station_no != null)
                fill_station(station_no, color);
        }

        process_station_status("TeamAsia05", "ready");

        Echo.join(`station-status.busy`)
            .here(users => users.forEach(user => process_station_status(user.username, "busy")))
            .joining(user => process_station_status(user.username, "busy"))
            .leaving(user => process_station_status(user.username, "inactive"));

        Echo.join(`station-status.ready`)
            .here(users => users.forEach(user => process_station_status(user.username, "ready")))
            .joining(user => process_station_status(user.username, "ready"))
            .leaving(user => process_station_status(user.username, "inactive"));

        for (let i = 0; i < 5; i++) {
            process_station_status("TeamAsia05" + (30-i), "booksy");
        }

    </script>
@endpush