<head>
    <style>
        body{
            background: #0a0806ff;
            /*overflow-y:hidden;*/
            color: #fff;
        }
        p {
            color: #fff;
        }
        #latawiec-image {
            height: 100%;
            display: block;
        }

        #wrapper {
            display: flex;
        }
        #latawiec {
            flex: 1;
        }
        #hajs {
            flex: 0 0 65%;
        }
    </style>
</head>
<body>
<div id="wrapper">
    <div id="hajs">
        <h1>Zebraliśmy:</h1>
        <p>PLN: {{ $data['amount_PLN'] }}</p>
        <p>GBP: {{ $data['amount_GBP'] }}</p>
        <p>USD: {{ $data['amount_USD'] }}</p>
        <p>EUR:{{ $data['amount_EUR'] }}</p>

        <h1>W sumie (wg. aktualnego kursu NBP) około:</h1>
            EUR->PLN: {{ $data['rates']['EUR'] }}
            USD->PLN:{{ $data['rates']['USD'] }}
            GBP->PLN:{{ $data['rates']['GBP'] }}

        <div id="total">
            {{ $data['amount_total_in_PLN'] }}zł
        </div>
    </div>
    <div id="latawiec">
        <img id="latawiec-image" src="latawiec.png">
    </div>
</div>


</body>


