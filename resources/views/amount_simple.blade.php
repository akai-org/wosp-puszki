@extends('layouts.home_page')

@section('content')
    <div class="collected_site--full row"
         style="background-image: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.3) 0%), url('{{ asset('images/background.svg') }}')">
        <section class="main">
            <div class="logos-container">
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
@endsection
@section('footer')
    &copy 2017-{{ date('Y') }} <a href="http://wosp.put.poznan.pl/">Sztab WOŚP przy Politechnice Poznańskiej</a> i <a
            href="http://akai.org.pl" class="footer-akai"><span style="color: #FAA21B">A</span>KAI</a> <br>
    Kursy: 1€→{{ $data['rates']['EUR'] }}zł
    1$→{{ $data['rates']['USD'] }}zł
    1£→{{ $data['rates']['GBP'] }}zł
@endsection
