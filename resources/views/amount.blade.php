<head>
    {{-- TODO Ajax zamiast reloadu, ale raczej nie będzie bolało --}}
    <meta http-equiv="refresh" content="30" />
    <script>
        setTimeout(function(){
            window.location.reload(1);
        }, 15000);
    </script>
    <style>
        body{
            background-color: #000000;
            /*overflow-y:hidden;*/
            color: #fff;
            font-family: lato, sans-serif;
        }
        p {
            color: #fff;
        }
        .image-top {
            max-width: 100%;
            max-height: 45vh;
        }

        .image-bottom {
            max-width: 100%;
            max-height: 45vh;
        }

        #wrapper {
            display: flex;
        }
        #latawiec {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            flex: 1;
        }
        #hajs {
            flex: 0 0 65%;
            text-align: center;
        }
        #serce-image {
            height: 30%;
            display: block;
            margin: 0 auto;
            margin-top: 5%;
        }
        #total {
            display: block;

            font-size: 3em;
        }
        .waluta {
            float: left;
            width: 25%;
        }
        #waluty {
            font-size: 2em;
        }
        footer {
            text-align: center;
        }
        h1 {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="hajs">
        <h1>Sztab WOŚP przy Politechnice Poznańskiej</h1>
        <img id="serce-image" src="serce.png">

        <h1>Zebraliśmy:</h1>
        <div id="waluty">
            <div class="waluta">
                <p>{{ number_format($data['amount_PLN'], 2, ',', ' ') }}zł</p>
            </div>
            <div class="waluta">
                <p>{{ number_format($data['amount_EUR'], 2, ',', ' ') }}€</p>
            </div>
            <div class="waluta">
                <p>{{ number_format($data['amount_GBP'], 2, ',', ' ') }}£</p>
            </div>
            <div class="waluta">
                <p>{{ number_format($data['amount_USD'], 2, ',', ' ') }}$</p>
            </div>
        </div>

        <h1>W sumie (wg. aktualnego kursu NBP) około:</h1>

        <div id="total">
            {{ number_format($data['amount_total_in_PLN'], 2, ',', ' ') }}zł
        </div>
        <div>
            Wolontariuszy na mieście: {{ $data['collectors_in_city'] }}
        </div>
    </div>
    <div id="latawiec">
        <img class="image-top" src="baczki.png">
        <img class="image-bottom" src="18_27Final_WOSP_motyl_podglad.png">
    </div>
</div>
<footer>
{{--    &copy 2017-{{ date('Y') }} <a href="http://wosp.put.poznan.pl/">Sztab WOŚP przy Politechnice Poznańskiej</a> i <a href="http://akai.org.pl">AKAI</a> <br>--}}
    Kursy: 1€->{{ $data['rates']['EUR'] }}zł
    1$->{{ $data['rates']['USD'] }}zł
    1£->{{ $data['rates']['GBP'] }}zł
</footer>

</body>
</html>

