@extends('layouts.home_page')

@section('styles')
    <meta http-equiv="refresh" content="30">
@endsection

@section('content')
    <script>
        window.setTimeout(function () {
            window.location.reload();
        }, 30000);
    </script>
    <div style="width: 100vw; height: 100vh; overflow-x: hidden; background-color: green !important;">
        <div class="collected_site collected_site--full row" style="background-color: green !important;">
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
            <style>
                .details:before {
                    content: none !important;
                }
            </style>
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
    </div>
@endsection
@section('footer')
    &copy 2017-{{ date('Y') }} <a href="http://wosp.put.poznan.pl/">Sztab WOŚP przy Politechnice Poznańskiej</a> i <a
            href="http://akai.org.pl" class="footer-akai"><span style="color: #FAA21B">A</span>KAI</a> <br>
    Kursy: 1€→{{ $data['rates']['EUR'] }}zł
    1$→{{ $data['rates']['USD'] }}zł
    1£→{{ $data['rates']['GBP'] }}zł
@endsection