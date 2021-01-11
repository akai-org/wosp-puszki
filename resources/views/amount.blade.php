@extends('layouts.home_page')

@section('content')
    <div style="width: 100vw; height: 100vh; overflow-x: hidden">
        <div class="collected_site collected_site--split row"
             style="background-image: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.3) 0%), url('{{ asset('images/background.svg') }}')">
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
        <?xml version="1.0" encoding="UTF-8" standalone="no"?>
        <!-- Created with Inkscape (http://www.inkscape.org/) -->

            <svg
                    xmlns:dc="http://purl.org/dc/elements/1.1/"
                    xmlns:cc="http://creativecommons.org/ns#"
                    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                    xmlns:svg="http://www.w3.org/2000/svg"
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                    width="430mm"
                    viewBox="0 0 430 600"
                    version="1.1"
                    id="svg8"
                    inkscape:version="0.92.4 (5da689c313, 2019-01-14)"
                    sodipodi:docname="Sztab.svg"
                    enable-background="new"
                    inkscape:export-filename="C:\Users\filip\bitmap.png"
                    inkscape:export-xdpi="96"
                    inkscape:export-ydpi="96">
                <defs
                        id="defs2">
                    <filter
                            inkscape:collect="always"
                            style="color-interpolation-filters:sRGB"
                            id="filter9402">
                        <feBlend
                                inkscape:collect="always"
                                mode="lighten"
                                in2="BackgroundImage"
                                id="feBlend9404" />
                    </filter>
                </defs>
                <sodipodi:namedview
                        id="base"
                        pagecolor="#ffffff"
                        bordercolor="#666666"
                        borderopacity="1.0"
                        inkscape:pageopacity="0.0"
                        inkscape:pageshadow="2"
                        inkscape:zoom="0.35"
                        inkscape:cx="920.37432"
                        inkscape:cy="1190.8291"
                        inkscape:document-units="mm"
                        inkscape:current-layer="layer2"
                        showgrid="false"
                        inkscape:window-width="1920"
                        inkscape:window-height="1017"
                        inkscape:window-x="-8"
                        inkscape:window-y="-8"
                        inkscape:window-maximized="1" />
                <metadata
                        id="metadata5">
                    <rdf:RDF>
                        <cc:Work
                                rdf:about="">
                            <dc:format>image/svg+xml</dc:format>
                            <dc:type
                                    rdf:resource="http://purl.org/dc/dcmitype/StillImage" />
                            <dc:title />
                        </cc:Work>
                    </rdf:RDF>
                </metadata>
                <g
                        inkscape:label="Layer 1"
                        inkscape:groupmode="layer"
                        id="layer1"
                        transform="translate(0,303)" />
                <g
                        inkscape:groupmode="layer"
                        id="layer2"
                        inkscape:label="Layer 2">
                    <g
                            id="g1641"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="fill:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="200.51569"
                                x="52.652096"
                                height="28.33057"
                                width="19.777945"
                                id="station01"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station01" />
                        <text
                                id="text852"
                                y="524.6601"
                                x="58.830456"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;fill-opacity:1;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="524.6601"
                                    x="58.830456"
                                    id="tspan850"
                                    sodipodi:role="line">1</tspan></text>
                    </g>
                    <g
                            id="g1647"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="165.77066"
                                x="52.652096"
                                height="28.33057"
                                width="19.777945"
                                id="station02"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station02" />
                        <text
                                id="text852-6"
                                y="489.67694"
                                x="57.67926"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;fill-opacity:1;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="489.67694"
                                    x="57.67926"
                                    id="tspan850-0"
                                    sodipodi:role="line">2</tspan></text>
                    </g>
                    <g
                            id="g1653"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="129.68927"
                                x="52.384827"
                                height="28.33057"
                                width="19.777945"
                                id="station03"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station03" />
                        <text
                                id="text852-6-3"
                                y="453.38904"
                                x="57.79916"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="453.38904"
                                    x="57.79916"
                                    id="tspan850-0-8"
                                    sodipodi:role="line">3</tspan></text>
                    </g>
                    <g
                            id="g1659"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="94.944229"
                                x="52.384827"
                                height="28.33057"
                                width="19.777945"
                                id="station04"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station04" />
                        <text
                                id="text852-6-3-7"
                                y="419.01007"
                                x="57.507904"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="419.01007"
                                    x="57.507904"
                                    id="tspan850-0-8-7"
                                    sodipodi:role="line">4</tspan></text>
                    </g>
                    <g
                            id="g1665"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="59.263744"
                                x="51.983921"
                                height="28.33057"
                                width="19.777945"
                                id="station05"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station05" />
                        <text
                                id="text852-6-3-7-5"
                                y="383.72845"
                                x="57.637997"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="383.72845"
                                    x="57.637997"
                                    id="tspan850-0-8-7-1"
                                    sodipodi:role="line">5</tspan></text>
                    </g>
                    <g
                            id="g1671"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="24.518721"
                                x="51.983921"
                                height="28.33057"
                                width="19.777945"
                                id="station06"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station06" />
                        <text
                                id="text852-6-3-7-9"
                                y="348.18243"
                                x="57.269695"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="348.18243"
                                    x="57.269695"
                                    id="tspan850-0-8-7-5"
                                    sodipodi:role="line">6</tspan></text>
                    </g>
                    <g
                            id="g1677"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-11.562675"
                                x="51.716652"
                                height="28.33057"
                                width="19.777945"
                                id="station07"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station07" />
                        <text
                                id="text852-6-3-7-7"
                                y="312.75531"
                                x="58.050686"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="312.75531"
                                    x="58.050686"
                                    id="tspan850-0-8-7-7"
                                    sodipodi:role="line">7</tspan></text>
                    </g>
                    <g
                            id="g1683"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-46.307713"
                                x="51.716652"
                                height="28.33057"
                                width="19.777945"
                                id="station08"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station08" />
                        <text
                                id="text852-6-3-7-4"
                                y="277.50089"
                                x="56.951488"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="277.50089"
                                    x="56.951488"
                                    id="tspan850-0-8-7-3"
                                    sodipodi:role="line">8</tspan></text>
                    </g>
                    <g
                            id="g1689"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-84.393623"
                                x="51.716652"
                                height="28.33057"
                                width="19.777945"
                                id="station09"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station09" />
                        <text
                                id="text852-6-3-7-4-2"
                                y="239.24548"
                                x="57.109158"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="239.24548"
                                    x="57.109158"
                                    id="tspan850-0-8-7-3-9"
                                    sodipodi:role="line">9</tspan></text>
                    </g>
                    <g
                            id="g1695"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-119.13864"
                                x="51.716652"
                                height="28.33057"
                                width="19.777945"
                                id="station10"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station10" />
                        <text
                                id="text852-6-3-7-4-6"
                                y="204.43475"
                                x="53.134712"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="204.43475"
                                    x="53.134712"
                                    id="tspan850-0-8-7-3-1"
                                    sodipodi:role="line">10</tspan></text>
                    </g>
                    <g
                            id="g1701"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-155.22005"
                                x="51.449383"
                                height="28.33057"
                                width="19.777945"
                                id="station11"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station11" />
                        <text
                                id="text852-6-3-7-4-6-5"
                                y="168.82675"
                                x="54.117817"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="168.82675"
                                    x="54.117817"
                                    id="tspan850-0-8-7-3-1-9"
                                    sodipodi:role="line">11</tspan></text>
                    </g>
                    <g
                            id="g1707"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-67.745906)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-189.96507"
                                x="51.449383"
                                height="28.33057"
                                width="19.777945"
                                id="station12"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station12" />
                        <text
                                id="text852-6-3-7-4-6-5-7"
                                y="134.16158"
                                x="53.09864"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="134.16158"
                                    x="53.09864"
                                    id="tspan850-0-8-7-3-1-9-0"
                                    sodipodi:role="line">12</tspan></text>
                    </g>
                    <g
                            id="g9410"
                            transform="matrix(1.2250852,0,0,1.1796943,-30.26752,-66.80097)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                transform="rotate(-90,151.50001,151.5)"
                                y="85.160629"
                                x="202.88844"
                                height="28.33057"
                                width="19.777945"
                                id="station13"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;filter:url(#filter9402)"
                                inkscape:label="station13" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4"
                                y="97.146469"
                                x="90.992783"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="97.146469"
                                    x="90.992783"
                                    id="tspan850-0-8-7-3-1-9-0-9"
                                    sodipodi:role="line">13</tspan></text>
                    </g>
                    <g
                            id="g1551"
                            transform="matrix(1.2250852,0,0,1.1796943,-30.26752,-66.80097)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                transform="rotate(-90,151.50001,151.5)"
                                y="127.30498"
                                x="203.1062"
                                height="28.33057"
                                width="19.777945"
                                id="station14"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                inkscape:label="station14" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6"
                                y="96.842957"
                                x="133.1403"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="96.842957"
                                    x="133.1403"
                                    id="tspan850-0-8-7-3-1-9-0-9-5"
                                    sodipodi:role="line">14</tspan></text>
                    </g>
                    <g
                            id="g1563"
                            transform="matrix(1.2250852,0,0,1.1796943,-30.26752,-66.80097)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                transform="rotate(-90,151.50001,151.5)"
                                y="210.16005"
                                x="202.77235"
                                height="28.33057"
                                width="19.777945"
                                id="station16"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                inkscape:label="station16" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3"
                                y="97.187302"
                                x="215.83226"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="97.187302"
                                    x="215.83226"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8"
                                    sodipodi:role="line">16</tspan></text>
                    </g>
                    <g
                            id="g1569"
                            transform="matrix(1.2250852,0,0,1.1796943,-30.26752,-66.80097)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                transform="rotate(-90,151.50001,151.5)"
                                y="249.28058"
                                x="203.24004"
                                height="28.33057"
                                width="19.777945"
                                id="station17"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                inkscape:label="station17" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3"
                                y="97.257858"
                                x="256.3157"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="97.257858"
                                    x="256.3157"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6"
                                    sodipodi:role="line">17</tspan></text>
                    </g>
                    <g
                            id="g1575"
                            transform="matrix(1.2250852,0,0,1.1796943,-30.26752,-66.80097)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                transform="rotate(-90,151.50001,151.5)"
                                y="289.10373"
                                x="203.1064"
                                height="28.33057"
                                width="19.777945"
                                id="station18"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                inkscape:label="station18" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8"
                                y="96.922775"
                                x="295.07611"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"
                                inkscape:label="text852-6-3-7-4-6-5-7-4-6-5-3-3-8"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="96.922775"
                                    x="295.07611"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1"
                                    sodipodi:role="line">18</tspan></text>
                    </g>
                    <g
                            id="g1581"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-196.78043"
                                x="335.89099"
                                height="28.33057"
                                width="19.777945"
                                id="station19"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station19" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4"
                                y="126.4222"
                                x="337.53873"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="126.4222"
                                    x="337.53873"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7"
                                    sodipodi:role="line">19</tspan></text>
                    </g>
                    <g
                            id="g1587"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480311,-58.658748)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-162.03542"
                                x="335.89099"
                                height="28.33057"
                                width="19.777945"
                                id="station20"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station20" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4"
                                y="161.61156"
                                x="336.15018"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="161.61156"
                                    x="336.15018"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5"
                                    sodipodi:role="line">20</tspan></text>
                    </g>
                    <g
                            id="g1593"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480333,-58.658737)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-125.95401"
                                x="336.15826"
                                height="28.33057"
                                width="19.777945"
                                id="station21"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station21" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4"
                                y="197.34967"
                                x="337.91196"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="197.34967"
                                    x="337.91196"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9"
                                    sodipodi:role="line">21</tspan></text>
                    </g>
                    <g
                            id="g1599"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-91.208992"
                                x="336.15826"
                                height="28.33057"
                                width="19.777945"
                                id="station22"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station22" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3"
                                y="232.23865"
                                x="336.63577"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="232.23865"
                                    x="336.63577"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5"
                                    sodipodi:role="line">22</tspan></text>
                    </g>
                    <g
                            id="g1605"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-53.123089"
                                x="336.15826"
                                height="28.33057"
                                width="19.777945"
                                id="station23"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station23" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3-4"
                                y="270.47089"
                                x="336.63693"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="270.47089"
                                    x="336.63693"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5-3"
                                    sodipodi:role="line">23</tspan></text>
                    </g>
                    <g
                            id="g9416"
                            inkscape:label="g9416"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="-18.378036"
                                x="336.15826"
                                height="28.33057"
                                width="19.777945"
                                id="station24"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station24" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3-4-4"
                                y="305.50662"
                                x="336.55606"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="305.50662"
                                    x="336.55606"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5-3-9"
                                    sodipodi:role="line">24</tspan></text>
                    </g>
                    <g
                            id="g1611"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="17.703342"
                                x="336.42554"
                                height="28.33057"
                                width="19.777945"
                                id="station25"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station25" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3-4-4-8"
                                y="341.6431"
                                x="336.97955"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="341.6431"
                                    x="336.97955"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5-3-9-5"
                                    sodipodi:role="line">25</tspan></text>
                    </g>
                    <g
                            id="g1617"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="52.448368"
                                x="336.42554"
                                height="28.33057"
                                width="19.777945"
                                id="station26"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station26" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3-4-4-8-3"
                                y="376.21985"
                                x="336.71588"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="376.21985"
                                    x="336.71588"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5-3-9-5-3"
                                    sodipodi:role="line">26</tspan></text>
                    </g>
                    <g
                            id="g9422"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="88.12886"
                                x="336.82645"
                                height="28.33057"
                                width="19.777945"
                                id="station27"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station27" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3-4-4-8-3-9"
                                y="411.94479"
                                x="338.22458"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="411.94479"
                                    x="338.22458"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5-3-9-5-3-1"
                                    sodipodi:role="line">27</tspan></text>
                    </g>
                    <g
                            id="g1623"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                y="122.8739"
                                x="336.82645"
                                height="28.33057"
                                width="19.777945"
                                id="station28"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station28" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3-4-4-8-3-9-7"
                                y="446.62656"
                                x="337.39935"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="446.62656"
                                    x="337.39935"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5-3-9-5-3-1-6"
                                    sodipodi:role="line">28</tspan></text>
                    </g>
                    <g
                            id="g1629"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)">
                        <rect
                                y="158.95529"
                                x="337.09372"
                                height="28.33057"
                                width="19.777945"
                                id="station29"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station29" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3-4-4-8-3-9-7-6"
                                y="482.79733"
                                x="337.57449"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:#000000;stroke-width:1.11630952;stroke-miterlimit:3;stroke-dasharray:none;stroke-opacity:1"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:3;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="482.79733"
                                    x="337.57449"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5-3-9-5-3-1-6-6"
                                    sodipodi:role="line">29</tspan></text>
                    </g>
                    <g
                            id="g1635"
                            transform="matrix(1.2250852,0,0,1.1796943,-33.480337,-58.658742)">
                        <rect
                                y="193.7003"
                                x="337.09372"
                                height="28.33057"
                                width="19.777945"
                                id="station30"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1"
                                transform="translate(0,303.00001)"
                                inkscape:label="station30" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5-3-3-8-4-4-4-3-4-4-8-3-9-7-6-3"
                                y="517.948"
                                x="337.42908"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:3;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:3;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="517.948"
                                    x="337.42908"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8-8-6-1-7-5-9-5-3-9-5-3-1-6-6-0"
                                    sodipodi:role="line">30</tspan></text>
                        <path
                                style="fill:none;stroke:#000000;stroke-width:0.17746472;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.17746472, 0.35492943;stroke-dashoffset:0;stroke-opacity:1"
                                d="m 356.8721,525.03189 -0.10113,33.3733"
                                id="path9484"
                                inkscape:connector-curvature="0" />
                        <path
                                style="fill:none;stroke:#000000;stroke-width:0.55316383;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                d="m 52.585033,558.47217 41.386548,-32.82314 v -176.5414 l 218.131089,0.3204 -10e-6,173.65779 44.6683,35.31938"
                                id="path9486"
                                inkscape:connector-curvature="0"
                                sodipodi:nodetypes="cccccc" />
                        <g
                                id="g9703"
                                transform="matrix(0.21597137,0,0,0.22428127,117.1131,342.81655)">
                            <g
                                    class="st0"
                                    id="Warstwa_2"
                                    style="display:none">
                            </g>
                            <g
                                    id="Warstwa_1">
                                <g
                                        id="Warstwa_11">
                                </g>

                            </g>
                            <g
                                    id="Warstwa_9">
                            </g>
                            <g
                                    class="st0"
                                    id="Warstwa_6"
                                    style="display:none">
                                <g
                                        class="st17"
                                        id="Warstwa_10"
                                        style="display:inline">
                                </g>

                                <g
                                        class="st17"
                                        id="Warstwa_8"
                                        style="display:inline">
                                </g>

                            </g>
                            <g
                                    class="st0"
                                    id="Warstwa_7"
                                    style="display:none">
                            </g>
                            <g
                                    id="Warstwa_3">
                                <g
                                        id="g9614">
                                    <path
                                            id="path9500"
                                            d="M 787.8,436.1 C 787,405 777,376.5 761.2,359.9 c -10.1,-10.6 -21.2,-18.7 -33,-24 -11,-4.9 -22.5,-7.4 -34.3,-7.4 -22,0 -39.9,8.5 -50.9,15.7 -4,2.6 -7.7,5.5 -11.2,8.6 -3.4,-3.2 -7.2,-6 -11.2,-8.6 -8.2,-5.3 -16.9,-9.3 -25.9,-12 4.1,-11.8 7,-23.5 8.6,-35 0.1,-1 0.3,-2.1 0.4,-3.1 0.1,-0.4 0.1,-0.9 0.2,-1.3 0.5,-4.7 1.1,-10.9 1,-17.9 0.1,-16.2 -2.8,-32 -8.6,-46.7 -5.6,-14.4 -13.9,-27.4 -24.5,-38.7 -12.4,-13.2 -27.4,-23.5 -44.6,-30.6 -17.3,-7.2 -36.2,-10.8 -55.9,-10.8 -37.5,0 -74.9,13.3 -105.4,37.5 -28,22.2 -47.7,51.9 -55.9,84.1 -9.7,-7.8 -20.7,-14.2 -33,-18.9 -14.5,-5.6 -29.3,-8.2 -46.5,-8.2 -4.8,0 -9.9,0.2 -15.5,0.6 -29,2.2 -56.8,12.6 -80.4,30.3 -14.9,11.1 -28.2,26.6 -39.6,45.9 -11.8,20.3 -20.9,44 -27,70.6 -1.9,8.1 -0.1,16.5 4.8,23.1 4.9,6.5 12.2,10.3 20.1,10.3 H 93 c 13.1,0 25.5,-0.1 36.6,-0.1 -2.3,1.4 -4.6,2.8 -6.7,4.2 -1.4,0.9 -2.9,1.9 -4.3,2.9 -3.8,2.6 -7.6,5.4 -11.1,8.3 -3.6,2.8 -7.1,5.8 -10.4,8.8 -4.9,4.5 -9.7,9.2 -14.2,14.2 -16.8,18.4 -30.6,40.1 -42.1,66.2 -9.4,21.3 -17.4,45.4 -25,75.8 -2,8.1 -0.3,16.8 4.5,23.4 4.8,6.6 12.4,10.5 20.3,10.5 l 526.5,-0.1 c 8.5,0 16.4,-4.4 21.1,-11.7 15.9,11.3 28.1,17.4 32.8,19.6 l 0.5,0.2 c 3.3,1.6 6.9,2.4 10.5,2.4 3.6,0 7.1,-0.8 10.4,-2.3 l 0.6,-0.3 c 10.9,-5.1 67.6,-34 114.5,-105.8 26.3,-40.3 31,-78.6 30.3,-103.5 z M 469.1,290 c -0.8,7.1 -7.7,13 -15.5,13 -7.8,0 -13,-5.9 -11.8,-13 1.2,-6.9 8,-12.3 15.4,-12.3 7.3,0 12.7,5.4 11.9,12.3 z"
                                            inkscape:connector-curvature="0" />

                                    <g
                                            id="g9612">
                                        <g
                                                id="g9608">
                                            <path
                                                    id="path9502"
                                                    d="m 397.9,395.2 c -13.1,6.8 -26.6,12.2 -40.2,15.9 l -28,90.8 C 456.4,493.2 565.6,383 578,293.3 c 0.1,-0.8 0.2,-1.7 0.3,-2.5 0,-0.4 0.1,-0.8 0.1,-1.1 0.5,-4.7 0.9,-9.6 0.9,-14.8 0.5,-56.6 -45.8,-99.8 -108,-99.8 -66,0 -127.8,48.6 -138.3,110.3 -8.5,50 18.9,93.4 64.9,109.8 z m 15.9,-106 c 3.6,-21 24.6,-37.6 47.1,-37.6 22.5,0 38.9,16.6 36.6,37.6 -2.5,21.7 -23.7,39.8 -47.5,39.8 -23.8,0 -39.9,-18.1 -36.2,-39.8 z"
                                                    class="st8"
                                                    inkscape:connector-curvature="0"
                                                    style="fill:#ffffff" />

                                            <path
                                                    id="path9504"
                                                    d="m 136.8,552.5 c -1.1,0 -2,0.3 -2.6,1 -0.6,0.6 -1.2,2.1 -1.9,4.5 l -6.8,22.2 c -0.8,2.6 -1.1,4.2 -1,4.8 0.2,0.5 0.8,0.8 2,0.8 1.1,0 2,-0.3 2.5,-1 0.6,-0.6 1.2,-2.1 1.9,-4.3 l 6.9,-22.5 c 0.7,-2.4 1.1,-3.9 0.9,-4.5 -0.1,-0.7 -0.7,-1 -1.9,-1 z"
                                                    class="st8"
                                                    inkscape:connector-curvature="0"
                                                    style="fill:#ffffff" />

                                            <g
                                                    id="g9594">
                                                <g
                                                        id="g9512">
                                                    <g
                                                            id="g9510">
                                                        <g
                                                                id="g9508">
                                                            <path
                                                                    id="path9506"
                                                                    d="m 743.1,379 c -31.3,-33.1 -65.5,-25.5 -86.7,-11.7 -19.4,12.5 -23.9,31.4 -24.6,34.7 -0.7,-3.3 -5.2,-22.2 -24.6,-34.7 -21.3,-13.8 -55.4,-21.3 -86.7,11.7 -20.3,21.4 -32.9,84.5 6.9,145.4 43.5,66.4 95.5,92.5 103.8,96.4 l 0.6,0.3 0.6,-0.3 c 8.3,-3.9 60.3,-29.9 103.8,-96.4 39.8,-60.9 27.3,-124 6.9,-145.4 z"
                                                                    class="st15"
                                                                    inkscape:connector-curvature="0"
                                                                    style="fill:#e12013" />

                                                        </g>

                                                    </g>

                                                </g>

                                                <g
                                                        id="g9592">
                                                    <g
                                                            id="g9590">
                                                        <path
                                                                id="path9514"
                                                                d="m 706.5,404.3 -3.5,-0.3 -0.7,16.1 -2.9,-0.2 -0.2,5.6 3.2,0.2 -0.7,19.4 c -0.1,5.3 1.5,8 5,8.2 2.5,0.1 4.1,-1.5 4.8,-4.6 l 0.3,-4.9 -3.2,-0.5 c -0.4,2.6 -1.1,3.8 -2.1,3.8 -0.9,0 -1.4,-0.5 -1.5,-1.5 l -0.1,-1.4 0.7,-18.1 4.9,0.4 0.2,-5.3 -5,-0.7 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9516"
                                                                d="m 736,426.4 c -0.2,-1.5 -0.4,-2.6 -0.6,-3.3 -0.9,-1.9 -2.6,-2.9 -5.3,-2.9 -2.6,-0.1 -4.4,1.4 -5.4,4.3 -0.4,1.5 -0.6,2.9 -0.6,4.3 l 3.6,-0.2 c -0.1,-0.7 0,-1.4 0.1,-2.2 0.3,-1.4 0.9,-2 1.8,-2.1 1.5,-0.1 2.2,2.4 2.1,7.2 -1.5,0 -3.2,0.5 -4.8,1.4 -3.2,1.9 -4.9,5.1 -5,9.8 -0.1,4.2 0.9,7.1 2.9,8.8 1.1,0.9 2.4,1.2 3.7,1.2 2.3,-0.2 3.6,-1.3 4,-3.6 l 0.1,3.4 4.4,-0.1 z m -9.9,15.5 c 0,-1.6 0.4,-3 1.2,-4.3 1,-1.5 2.6,-2.5 4.6,-2.6 0.1,0 0.1,2.3 0.4,7 0.2,3.6 -0.7,5.6 -2.6,5.7 -2.5,0.3 -3.7,-1.7 -3.6,-5.8 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9518"
                                                                d="m 718,420 -3.6,0.1 -0.2,31.7 h 4.4 c -0.3,-11.1 -0.3,-18 -0.1,-20.6 0.1,-2 0.7,-3.6 1.8,-4.7 0.8,-0.8 1.7,-1.3 2.7,-1.5 0.1,0 0.2,-1.6 0.2,-4.9 -1.7,0.1 -3.4,1.3 -5.1,3.9 -0.1,0 -0.1,-1.2 -0.1,-4 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9520"
                                                                d="m 685.6,433.2 c -0.1,-2.2 -0.4,-4.5 -0.9,-6.7 -1.2,-4.5 -3,-6.7 -5.7,-6.7 -2.8,0.1 -5,1.7 -6.5,5 -1.2,2.5 -1.8,5.2 -1.8,8.1 0,4.3 0.4,7.3 1.4,9.1 2.1,4.4 6.4,6.6 13,6.4 0.1,0 0,-1.8 -0.3,-5.3 -1.6,0.3 -3.2,0.2 -4.7,-0.5 -3.2,-1.2 -4.7,-4.3 -4.6,-9.2 z m -9.9,-2.6 c -0.3,0 -0.1,-1.2 0.4,-3.6 0.5,-2.3 1.3,-3.5 2.3,-3.6 1.5,-0.1 2.3,2.4 2.6,7.1 -2.8,0.2 -4.5,0.2 -5.3,0.1 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9522"
                                                                d="m 697.5,421.5 c -1.2,-0.5 -2.4,-0.9 -3.7,-0.7 -2.6,0.1 -4.3,2 -4.9,5.6 -0.4,2.6 0.1,5.4 1.7,8.3 1.8,3.2 2.8,5.6 2.8,6.8 0.1,2.6 -0.9,4.3 -2.9,5.3 l -3.1,0.5 0.2,5.4 c 4,0 6.8,-1.2 8.6,-3.6 1.1,-1.5 1.6,-3.4 1.6,-5.5 -0.1,-3.3 -1.1,-6.7 -2.9,-10.1 -1.5,-2.7 -2.1,-4.9 -1.5,-6.4 0.4,-1.4 1.2,-1.9 2.2,-1.9 0.5,0 1,0.2 1.5,0.5 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9524"
                                                                d="m 712.4,464.8 c -1.1,-0.1 -1.8,0.6 -2.4,2 -0.2,0.7 -0.4,1.4 -0.4,2.1 l 0.3,2.2 c 0.4,1.5 1.3,2.3 2.8,2.3 0.7,0.1 1.4,-0.5 1.9,-1.8 0.4,-1.1 0.7,-2 0.6,-2.9 -0.1,-2.6 -1.1,-3.9 -2.8,-3.9 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9526"
                                                                d="m 687.9,477.3 c -0.7,-0.5 -1.7,-0.9 -2.9,-1 -1.7,-0.2 -3,0.2 -4.2,1.2 -0.7,0.9 -1.2,1.3 -1.2,1.3 l -0.1,-5 c 0,-0.2 -1.4,-0.2 -4,0.1 l -0.3,30.2 c 3.1,0 4.6,-0.1 4.6,-0.2 0,-0.5 0.1,-6.7 0.2,-18.9 0.3,-2.2 1.3,-3.4 3,-3.5 1.4,0 2.3,0.9 2.6,2.7 0.2,13.1 0.4,19.7 0.4,19.9 3.5,-0.1 5.3,-0.2 5.4,-0.2 -0.2,-12.8 -0.5,-19.8 -0.8,-21.2 -0.7,-2.5 -1.6,-4.4 -2.7,-5.4 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9528"
                                                                d="m 705.2,481.1 c -1.3,-1.4 -2.8,-2.1 -4.4,-2.2 -1.5,-0.1 -2.9,0.5 -4.3,1.8 -2.5,2.2 -3.7,6.1 -3.6,11.8 0.1,7.4 2.2,12.1 6.4,14.2 1.4,0.6 2.9,1 4.8,1.1 1,0 2.1,0 3.5,-0.1 0.1,0 0.1,-1.6 0,-5 -1.7,0.2 -3.2,0.1 -4.8,-0.5 -3.2,-1.2 -4.8,-3.7 -4.8,-7.7 0,-0.2 1.8,-0.3 5.5,-0.4 3.6,-0.2 5.4,-0.2 5.4,-0.3 -0.1,-6 -1.4,-10.2 -3.7,-12.7 z m -6.3,3.2 c 0.4,-0.8 0.8,-1.2 1.2,-1.5 2.6,-0.1 4,2.6 4.4,8 -4.5,0.2 -6.8,0.2 -6.8,0.2 0,-3 0.4,-5.3 1.2,-6.7 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9530"
                                                                d="m 715.3,480.2 -4.6,0.2 1,27.5 c -0.2,9.5 -3.2,14.5 -9,14.6 -0.1,4.8 0.1,7.2 0.3,7.2 4.5,0 8.1,-2.2 10.6,-6.6 2.1,-3.6 3.2,-7.5 3.2,-11.8 0,-0.5 -0.5,-10.8 -1.5,-31.1 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9532"
                                                                d="m 664.6,411.6 c -0.1,2.2 0.6,3.4 1.9,3.4 1,0.1 1.6,-0.5 2,-1.8 0.3,-0.8 0.4,-1.5 0.4,-2.2 -0.1,-1.7 -0.9,-2.6 -2.2,-2.6 -1.2,0.1 -1.9,1.1 -2.1,3.2 z m 1.2,0.9 c 0.1,-0.1 0.1,-0.1 0,0 0.1,0.1 0.1,0.2 0.1,0.3 0,-0.1 -0.1,-0.2 -0.1,-0.3 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9534"
                                                                d="m 654.4,402.8 -3.8,0.2 -1.7,45.6 4.2,-0.2 0.3,-14.3 4.3,14.1 5.4,0.2 -7.5,-16.6 7.7,-12.7 -4.3,-0.2 -5.5,7.9 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9536"
                                                                d="m 582.7,399.1 h -4.4 l 0.7,49.1 h 4.4 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9538"
                                                                d="m 591.5,398.3 h -4.4 l -0.7,50.3 h 3.7 v -10.8 l 3.4,11 4.6,-0.2 -6.6,-17.7 8.1,-13.2 h -4.4 l -4.4,7 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9540"
                                                                d="m 602.5,424.4 c 0.7,-0.9 1.3,-1.2 2.1,-1.2 1.2,0 2.1,1.8 2.4,5.4 0,-0.2 -1.8,1.4 -5.3,4.7 -0.5,0.5 -1,1.2 -1.5,2.2 -1,1.8 -1.5,3.6 -1.4,5.5 0,2.4 0.7,4.3 1.8,5.4 0.8,0.8 1.8,1.2 2.8,1.2 2.8,0 4.6,-1.6 5.4,-4.9 l 1.2,4.6 3.8,-0.2 c -0.1,-6.4 -0.7,-13.2 -1.7,-20.3 -0.6,-4.7 -1.9,-7.8 -3.8,-9.2 -0.7,-0.5 -1.8,-0.8 -3.1,-0.8 -3.2,0 -5.4,2.7 -6.3,8.2 l 3,0.7 z m 3.9,17.4 c -1,1.2 -1.9,1.5 -2.8,0.9 -0.7,-0.4 -1,-1 -1.1,-1.8 -0.1,-1.5 0.3,-2.9 1.2,-4.3 0.9,-1.6 2.2,-2.7 3.7,-3.5 0.1,5 -0.2,8 -1,8.7 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9542"
                                                                d="m 571.7,420.7 c -1.8,-1.8 -3.7,-2.3 -6.1,-1.7 -2.4,0.7 -4,2.8 -4.8,6.3 -0.5,2.3 -0.8,4.3 -0.8,5.6 -0.1,0.6 0.1,2.7 0.3,6 0.3,4.6 2.1,8.1 5.5,10.1 1.8,1.2 5.1,1.5 9.5,0.8 l -0.7,-6.2 c -2.4,1.1 -4.6,1.1 -6.7,0.2 -1.3,-0.6 -2.2,-2 -2.9,-4.3 l -0.5,-3.2 c 6.2,-0.4 9.7,-0.7 10.4,-0.9 -0.5,-6.7 -1.6,-11 -3.2,-12.7 z m -2.9,4 c 0.4,0.6 0.8,1.7 1.3,3.3 0.4,1.5 0.6,2.3 0.4,2.4 -3.9,0.5 -5.9,0.7 -5.9,0.5 -0.3,-2.5 -0.2,-4.4 0.2,-5.8 0.4,-1.2 1,-1.9 1.6,-1.9 0.9,-0.1 1.7,0.4 2.4,1.5 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9544"
                                                                d="m 593.5,462.5 c -1.1,-0.1 -1.7,0.9 -1.8,3.1 0,0.8 0.3,1.5 0.8,1.9 0.5,0.5 1,0.7 1.4,0.7 1.3,0 2,-1 1.9,-3 -0.1,-1.7 -0.8,-2.6 -2.3,-2.7 z m 0.2,2.1 c 0,0.2 0.1,0.3 0,0.5 -0.1,0 -0.2,-0.1 -0.2,-0.2 v 0 c 0,-0.2 0,-0.3 0.2,-0.3 0,-0.1 0,-0.1 0,0 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9546"
                                                                d="m 577.4,478.7 h -2.7 l -2.9,12.5 -3.4,-11.9 -4.7,0.3 6.6,26.3 h 3.7 l 2.2,-15.5 5.9,15.5 h 4.4 l 3.7,-27.9 h -4.4 l -2.9,17 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9548"
                                                                d="m 621.4,460 -3.5,-0.1 -0.2,15.1 -3.9,-0.2 v 6.6 h 4 c -0.4,12.7 -0.6,19.5 -0.6,20.4 0,4.8 1.5,7.1 4.6,7 2.3,-0.1 4,-1.8 5.1,-5.1 l 0.8,-5 H 624 c -0.4,2.2 -1.2,3.2 -2.1,3.3 -0.6,0 -1,-0.5 -1.3,-1.6 l -0.3,-1.6 0.4,-17.3 5,-0.2 -0.3,-5.6 -4.3,-0.2 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9550"
                                                                d="m 597.8,484 3.4,0.5 0.5,-1.6 c 0.5,-1 1.2,-1.6 2.3,-1.7 2.1,-0.2 3.4,1.1 3.7,3.8 0,0.5 -0.4,1.1 -1.3,1.8 -1.3,0.9 -2.3,1.6 -3,2.2 -3,2.3 -4.5,5.2 -4.5,8.4 0,3.5 0.5,5.7 1.5,6.8 0.7,0.7 1.9,1.1 3.7,1.2 2.3,0.1 4.3,-1.9 5.8,-6.1 l 0.5,5.4 4.5,-0.2 c -1,-11.8 -1.8,-18.7 -2.6,-21.1 -1.5,-4.1 -4.3,-6.2 -8.3,-6.3 -2.4,0 -4,1.1 -5.2,3.4 -0.5,1.2 -0.9,2.4 -1,3.5 z m 7.5,7.3 c 1.5,-1.3 2.4,-1.9 2.7,-1.8 l 0.2,5.5 c -0.4,2.6 -1.3,4.3 -3,5.2 -1,0.5 -1.8,0.4 -2.3,-0.5 -0.7,-0.9 -0.8,-2.2 -0.6,-3.9 0.3,-1.5 1.3,-3 3,-4.5 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9552"
                                                                d="m 596.1,478.5 h -3.9 l -1.1,27.1 5.3,0.2 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9554"
                                                                d="m 648.2,424.9 c 0.1,0 0.3,-2.2 0.4,-6.7 -1.5,0 -2.9,0.6 -4.3,2.1 -1,1.6 -1.5,2.3 -1.6,2.3 0,-1.7 0.1,-3 0.1,-4 l -3.2,-0.3 c -0.4,18.7 -0.7,28.6 -1,30 l 4.6,-0.1 0.1,-19.5 1.2,-1.9 c 0.9,-1.3 2.2,-1.9 3.7,-1.9 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9556"
                                                                d="m 634,421.7 c -1.2,-1.6 -2.6,-2.5 -4.3,-2.4 -1.1,0.2 -2.2,0.9 -3.4,2.2 -2.3,2.6 -3.6,6.4 -4,11.7 -0.3,5.4 0.4,9.4 2.3,12 1.2,1.7 2.7,2.6 4.3,2.6 4.6,0.2 7,-4.5 7.3,-13.9 0.3,-5.6 -0.5,-9.7 -2.2,-12.2 z m -3.9,2.6 c 2.1,-0.1 3.1,3 3,9.3 0,3.2 -0.4,5.7 -1.4,7.4 -0.7,1.2 -1.5,1.9 -2.4,1.9 -1.2,0.1 -2.1,-1 -2.8,-3.2 -0.7,-1.9 -0.9,-3.8 -0.8,-5.8 0.4,-6.2 1.9,-9.4 4.4,-9.6 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9558"
                                                                d="m 635.4,476.4 c -1.8,0.1 -3.5,0.9 -4.8,2.6 -2,2.4 -2.9,5.9 -2.6,10.5 0.4,8.6 3.2,13.5 8.4,14.6 2.6,0.5 5.2,0.2 7.7,-0.9 l -1,-5.9 c -4.4,1.6 -7.5,0.9 -9.2,-1.8 -0.8,-1.4 -1.3,-3.2 -1.3,-5.5 6.9,-0.5 10.6,-0.7 10.9,-0.8 0.4,-8.7 -2.3,-13 -8.1,-12.8 z m 1.2,3.8 c 0.4,0.1 0.7,0.2 1,0.5 1.1,0.9 1.8,2.9 2.1,6.1 0,0 -1.1,0.2 -3.3,0.3 -2.3,0.2 -3.6,0.2 -4,0.2 -0.1,0 -0.1,-0.3 0,-1.1 0,-0.9 0.1,-1.6 0.4,-2.4 0.6,-2.4 1.7,-3.6 3.4,-3.6 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9560"
                                                                d="m 652.9,478.1 c -4,1.8 -6.4,6 -7,12.3 -0.7,7.3 0.7,12.3 4.2,15.2 2.4,1.9 5,2.6 7.6,1.9 0.1,-0.1 -0.1,-1.9 -0.6,-5.7 -4.7,-0.3 -7,-3.6 -6.8,-9.9 0.1,-2.8 1,-5 2.7,-6.4 1.5,-1.4 3.4,-2 5.4,-1.9 0.1,0 0.2,-2.2 0.2,-6.4 -1.7,-0.3 -3.6,0 -5.7,0.9 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9562"
                                                                d="m 661.7,482.9 c 3.8,-0.2 5.8,-0.3 5.9,-0.1 0.2,0.1 -2.2,8.4 -7.1,24.6 2.9,0.2 6.8,0.4 12,0.4 0.1,0 0.2,-1.6 0.4,-4.6 -3,0 -4.9,-0.1 -5.7,-0.1 -0.1,0 0.9,-4.3 3,-12.9 2.2,-8.7 3.2,-13 3.1,-13 h -11.7 c -0.1,0.7 -0.1,2.7 0.1,5.7 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9564"
                                                                d="m 554.5,411 c 0.6,0.2 1.1,0 1.5,-0.5 1.7,-2.3 1.2,-3.9 -1.5,-4.7 -0.8,0.1 -1.4,0.5 -1.8,1.3 -1,2.1 -0.4,3.4 1.8,3.9 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9566"
                                                                d="m 557,422.4 h -3.7 l -0.7,26.2 h 5.1 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9568"
                                                                d="m 561.4,459.5 -4.7,0.3 1.8,8.2 h 2.9 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9570"
                                                                d="m 560.3,477.8 c 0.8,0.1 1.6,0.3 2.3,0.7 l 1,-4.5 c -1.7,-0.5 -3.4,-0.6 -5.1,-0.5 -3.6,0.3 -5.7,2.2 -6.3,5.4 -0.5,2.8 0.1,5.8 1.9,9.1 1.9,3.5 2.9,6.3 2.7,8.4 -0.1,2.3 -1.3,4 -3.5,5.2 -1.2,0.5 -2.3,0.9 -3.3,1 l 0.5,5.6 c 1.8,0 3.7,-0.5 5.5,-1.5 3.7,-1.9 5.5,-5 5.6,-9.4 0,-2.5 -1,-5.7 -2.8,-9.7 -1.6,-3.5 -2.3,-5.9 -1.8,-7.3 0.5,-1.7 1.6,-2.5 3.3,-2.5 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9572"
                                                                d="m 646.5,534.5 c -0.9,2.4 -1.3,4.7 -1.4,7 0,3.9 0.4,7.1 1.5,9.8 1.3,3.4 3.2,5.1 5.9,5.3 2.6,0.1 4.4,-1.9 5.6,-5.9 0.8,-3 1.2,-6.6 1,-10.7 -0.1,-2.7 -0.6,-5.1 -1.5,-7 -1.2,-2.6 -3,-3.9 -5.4,-3.8 -2.5,0 -4.4,1.8 -5.7,5.3 z m 2.5,7.3 c 0.3,-4.8 1.3,-7.3 3.1,-7.3 2.2,-0.1 3.2,2.4 3.2,7.4 0,5.8 -1.1,8.7 -3.4,8.6 -0.9,-0.1 -1.6,-1.1 -2.2,-3.2 -0.5,-1.9 -0.8,-3.6 -0.7,-5.5 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9574"
                                                                d="m 637.3,531 c -1.8,0.2 -3.2,1.1 -4.3,2.7 -0.5,0.9 -1,1.7 -1.1,2.6 -0.4,-3.5 -1.8,-5.2 -4.5,-5 -1.2,0.1 -2.3,0.5 -3.3,1.5 -0.5,0.5 -0.8,0.9 -1.1,1.4 l 0.1,-3.3 -4,0.1 -1.1,27.9 4.6,-0.1 c 0.1,-9.8 0.3,-15.5 0.5,-17 0.3,-2.6 1.3,-4.1 3,-4.3 1.6,-0.2 2.6,0.7 2.8,2.7 l -0.7,18.8 4.8,0.1 0.1,-17.7 c 0.2,-2.2 1,-3.4 2.4,-3.5 1.4,-0.1 2.1,0.9 2.1,2.9 l 0.1,18.3 5.5,0.1 -0.7,-23.2 c -0.2,-3.6 -2,-5.2 -5.2,-5 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9576"
                                                                d="m 666,539.7 c 0,-2 0.5,-3.7 1.5,-5 1.2,-1.6 2.9,-2.4 5,-2.4 0.3,-3.7 0.4,-5.7 0.3,-5.7 -7.3,-0.4 -11.1,3.8 -11.3,12.6 -0.2,6.3 0.9,10.8 3.4,13.7 1.9,2.3 4.4,3.5 7.6,3.5 0.1,0 0.1,-2.4 0.1,-7.1 -2,-0.3 -3.5,-1.3 -4.8,-3 -1.2,-1.8 -1.8,-4 -1.8,-6.6 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9578"
                                                                d="m 613.6,509.5 c 0,-0.1 -1,-0.1 -2.8,0 -0.2,2.1 -0.2,3.6 -0.1,4.5 0.2,1.4 0.8,2.6 1.8,3.5 2.6,-1.2 3.9,-1.9 3.9,-1.9 -1,-0.9 -1.7,-2.2 -2.3,-3.8 -0.3,-1.5 -0.5,-2.2 -0.5,-2.3 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9580"
                                                                d="m 589.5,526 h -4.3 l -0.4,45 4.9,-0.2 -0.1,-16.3 c 1.1,0.8 2.6,1.2 4.6,1.2 2,-0.1 3.6,-1.5 4.6,-4.5 0.8,-2.4 1.2,-5.2 1.1,-8.3 -0.3,-5.8 -1.2,-9.9 -3.1,-12.4 -1.2,-1.7 -2.6,-2.5 -4,-2.5 -1.8,0.1 -2.9,0.9 -3.5,2.7 0.2,0.2 0.2,-1.4 0.2,-4.7 z m 1.4,8.3 0.9,-0.3 c 2.5,0.1 3.8,3.2 4.1,9.3 -0.4,4.9 -1.5,7.3 -3.4,7.3 -0.6,-0.1 -1.2,-0.3 -1.9,-0.8 l -0.8,-0.8 c -0.4,-1.5 -0.7,-3.7 -0.7,-6.9 0.1,-2.3 0.1,-4.2 0.4,-5.4 0.3,-1.2 0.7,-2 1.4,-2.4 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <path
                                                                id="path9582"
                                                                d="m 616.8,540.7 c -0.1,-4.3 -0.4,-7.2 -1,-9 -1,-3.1 -2.9,-4.6 -5.9,-4.6 -4.3,-0.1 -6.6,4.2 -6.9,12.9 -0.5,11.1 1.5,16.5 6.1,16.4 2.6,-0.1 4.5,-1.6 5.9,-4.6 1.2,-2.8 1.8,-6.5 1.8,-11.1 z m -7,-7.6 c 2,-0.2 3.2,2.2 3.5,7.1 0.2,6.7 -1,10.1 -3.6,10.4 -1.3,0.2 -2.3,-1.4 -2.7,-4.8 -0.2,-2.2 -0.3,-4.1 -0.2,-5.7 0.1,-1.5 0.4,-3 1,-4.4 0.5,-1.6 1.3,-2.5 2,-2.6 z"
                                                                class="st8"
                                                                inkscape:connector-curvature="0"
                                                                style="fill:#ffffff" />

                                                        <polyline
                                                                id="polyline9584"
                                                                points="687,533 681.9,549.2 679.3,531.3 674.6,531 679.1,559.1 671.5,573 677.8,575.9 692.7,533.3          687,533        "
                                                                class="st8"
                                                                style="fill:#ffffff" />

                                                        <polyline
                                                                id="polyline9586"
                                                                points="664.5,422.8 664,448.1 668.7,448.2 668.2,422.9 664.5,422.8        "
                                                                class="st8"
                                                                style="fill:#ffffff" />

                                                        <polyline
                                                                id="polyline9588"
                                                                points="542.3,449.4 537.2,434.8 533.5,449.4 529.1,449.4 524,423.2 527.7,423.2 531.3,439.4          534.3,423.2 537.9,423.2 543.1,439.4 546,421.6 550.4,421.6 546.7,449.4 542.3,449.4        "
                                                                class="st8"
                                                                style="fill:#ffffff" />

                                                    </g>

                                                </g>

                                            </g>

                                            <g
                                                    id="g9604">
                                                <polygon
                                                        id="polygon9596"
                                                        points="242.8,610.4 275,610.4 286.2,573.9 306.1,573.9 311.2,557.4 291.3,557.4 296.4,540.9 318.7,540.9 324.1,523.5 269.6,523.5 "
                                                        class="st8"
                                                        style="fill:#ffffff" />

                                                <polygon
                                                        id="polygon9598"
                                                        points="337.2,610.4 364,523.5 331.9,523.5 305.1,610.4 "
                                                        class="st8"
                                                        style="fill:#ffffff" />

                                                <polygon
                                                        id="polygon9600"
                                                        points="389.2,570.9 393.8,610.4 421.9,610.4 448.7,523.5 421.8,523.5 409.8,562.6 403.8,523.5 376.9,523.5 350.1,610.4 377,610.4 "
                                                        class="st8"
                                                        style="fill:#ffffff" />

                                                <path
                                                        id="path9602"
                                                        d="m 470.8,523.5 -43.2,87 h 33.2 l 6.7,-15.6 H 479 l -3.1,15.6 h 32.9 l 8.4,-87 z m 12.2,55.9 h -11.1 c 3.2,-7.7 9,-19.9 17.4,-36.5 -2.8,14.5 -4.9,26.6 -6.3,36.5 z"
                                                        class="st8"
                                                        inkscape:connector-curvature="0"
                                                        style="fill:#ffffff" />

                                            </g>

                                            <path
                                                    id="path9606"
                                                    d="m 561.3,565.4 9.8,-1.5 c 0.9,-3.1 1.9,-6.2 2.8,-9.2 l -9.8,1.5 10.1,-32.7 H 542 l -11.6,37.8 -6.6,1 -2.8,9.2 6.6,-1 -12.3,39.9 H 567 l 5.4,-17.4 h -19.6 z"
                                                    class="st8"
                                                    inkscape:connector-curvature="0"
                                                    style="fill:#ffffff" />

                                        </g>

                                        <path
                                                id="path9610"
                                                d="m 322.4,332.1 c -0.9,-2.6 -1.9,-5.1 -3,-7.6 -2.7,-6.1 -6,-11.9 -9.7,-17.2 -10.2,-14.7 -25.2,-25 -41.3,-31.2 -17.1,-6.5 -33.4,-7.3 -51.5,-6 -24.3,1.8 -47.4,10.4 -67.3,25.4 -13.3,10 -24,23.5 -32.7,38.2 -9.8,16.6 -18.2,37.2 -24.1,62.6 40.6,-0.1 74.3,-0.2 85.4,-0.2 1.9,-5 4,-9.6 6.2,-13.8 5.4,-10 11.8,-18 19.5,-22.9 11.2,-7 30.7,-8.5 37,6.3 7.9,18.4 -8.1,36.8 -33.1,48.7 -12.4,5.9 -26.3,12.9 -42,19.9 -3.1,1.4 -6.2,2.8 -9.1,4.3 -3,1.5 -5.8,3 -8.7,4.6 -1.4,0.8 -2.7,1.6 -4.1,2.3 -2.7,1.6 -5.3,3.2 -7.8,4.9 -1.3,0.8 -2.5,1.7 -3.8,2.5 -3.4,2.3 -6.6,4.8 -9.8,7.3 -3.1,2.5 -6.2,5.1 -9.1,7.7 -4.4,4 -8.5,8.1 -12.4,12.4 -31.4,34.5 -48.1,79.2 -60.9,130.1 h 189.4 l 27,-87.6 h -74.7 v 0 c 2.5,-1.3 5,-2.6 7.5,-3.9 5.9,-3.1 23.2,-12.1 26,-13.4 4.2,-1.9 8.4,-3.9 12.5,-5.8 27.2,-13.1 52.1,-28 71,-50.9 5,-6.1 9.7,-12.8 13.8,-20.1 0.4,-0.7 0.8,-1.5 1.2,-2.3 0.3,-0.6 0.7,-1.2 1,-1.8 7.6,-14.8 12.1,-30.7 13.3,-46.6 1.4,-15.6 -0.5,-31.3 -5.7,-45.9 z M 87.4,584 h 16.8 l -2.4,7.7 H 68.1 l 2,-6.5 c 13.7,-12.1 22,-19.6 24.7,-22.4 2.8,-2.9 4.4,-5.1 4.9,-6.7 0.4,-1.2 0.4,-2.2 0,-2.8 -0.4,-0.6 -1.2,-0.9 -2.3,-0.9 -1.2,0 -2.1,0.3 -2.9,1 -0.8,0.7 -1.5,2 -2.1,4 l -1.3,4.3 H 77.3 l 0.5,-1.7 c 0.8,-2.5 1.6,-4.5 2.4,-6 0.8,-1.5 2.1,-2.9 4,-4.3 1.8,-1.4 4,-2.5 6.4,-3.2 2.5,-0.7 5.2,-1.1 8.3,-1.1 6.1,0 10.4,1.1 12.8,3.4 2.4,2.2 3.1,5.1 2.1,8.5 -0.8,2.6 -2.5,5.3 -5.2,8.2 -2.6,2.9 -9.7,9.1 -21.2,18.5 z m 52.4,4.8 c -2,1.4 -4.2,2.3 -6.7,2.9 -2.4,0.6 -5,0.9 -7.8,0.9 -3.7,0 -6.6,-0.3 -8.9,-0.9 -2.2,-0.6 -3.9,-1.6 -4.9,-2.9 -1,-1.3 -1.6,-2.7 -1.8,-4.2 -0.2,-1.5 0.3,-3.8 1.2,-7 l 4.9,-15.8 c 1.3,-4.2 2.7,-7.3 4.3,-9.4 1.6,-2.1 4.1,-3.7 7.3,-5 3.3,-1.3 7,-1.9 11.1,-1.9 3.4,0 6.2,0.4 8.6,1.3 2.4,0.9 4,1.9 5,3.2 0.9,1.3 1.4,2.7 1.4,4.2 0,1.6 -0.6,4.1 -1.6,7.5 l -4.7,15.1 c -1.1,3.4 -2.1,5.9 -3.1,7.5 -0.8,1.6 -2.3,3.1 -4.3,4.5 z m 55.7,-35.2 c 7.8,-1.2 14.1,-3.6 19.1,-7.3 h 9 l -14,45.4 h -15.3 l 7.5,-24.4 c 1.1,-3.5 1.6,-5.6 1.6,-6.3 0,-0.7 -0.5,-1.2 -1.4,-1.6 -0.9,-0.4 -3.1,-0.5 -6.7,-0.5 h -1.5 z m -5.5,-4.8 c 2.4,2.2 3.1,5.1 2.1,8.5 -0.8,2.6 -2.5,5.3 -5.2,8.2 -2.7,2.9 -9.7,9.1 -21.2,18.5 h 16.8 l -2.4,7.7 h -33.7 l 2,-6.5 c 13.7,-12.1 22,-19.6 24.7,-22.4 2.8,-2.9 4.4,-5.1 4.9,-6.7 0.4,-1.2 0.4,-2.2 0,-2.8 -0.4,-0.6 -1.2,-0.9 -2.3,-0.9 -1.2,0 -2.1,0.3 -2.9,1 -0.8,0.7 -1.5,2 -2.1,4 l -1.3,4.3 h -13.7 l 0.5,-1.7 c 0.8,-2.5 1.6,-4.5 2.4,-6 0.8,-1.5 2.1,-2.9 4,-4.3 1.8,-1.4 4,-2.5 6.4,-3.2 2.5,-0.7 5.2,-1.1 8.3,-1.1 6,0.1 10.3,1.2 12.7,3.4 z"
                                                class="st8"
                                                inkscape:connector-curvature="0"
                                                style="fill:#ffffff" />

                                    </g>

                                </g>

                                <circle
                                        id="circle9616"
                                        r="21.5"
                                        cy="286.29999"
                                        cx="452.70001"
                                        class="st18"
                                        style="fill:#010202" />

                            </g>
                            <g
                                    class="st0"
                                    id="Warstwa_4"
                                    style="display:none">
                            </g>
                            <g
                                    class="st0"
                                    id="Warstwa_5"
                                    style="display:none">
                                <rect
                                        id="rect9620"
                                        height="3095"
                                        width="2078"
                                        class="st21"
                                        y="-613"
                                        x="-580"
                                        style="display:inline;fill:#010202" />

                            </g>
                        </g>
                        <text
                                xml:space="preserve"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:7.44082403px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#e12013;fill-opacity:1;stroke:none;stroke-width:0.11626288"
                                x="28.185268"
                                y="539.6626"
                                id="text9707"
                                transform="scale(0.98129956,1.0190568)"><tspan
                                    sodipodi:role="line"
                                    id="tspan9705"
                                    x="28.185268"
                                    y="539.6626"
                                    style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-family:Oswald;-inkscape-font-specification:Oswald;fill:#e12013;fill-opacity:1;stroke-width:0.11626288">Tu jesteś</tspan></text>
                    </g>
                    <g
                            id="g1557"
                            transform="matrix(1.2250852,0,0,1.1796943,-30.26752,-66.80097)"
                            style="stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none">
                        <rect
                                transform="rotate(-90,151.50001,151.5)"
                                y="168.96066"
                                x="202.93256"
                                height="28.33057"
                                width="19.777945"
                                id="rect4518-5-1-1-8"
                                style="fill-rule:nonzero;stroke:#000000;stroke-width:0.34770298;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                                inkscape:label="station15" />
                        <text
                                id="text852-6-3-7-4-6-5-7-4-6-5"
                                y="97.198219"
                                x="174.69472"
                                style="font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:14.11111069px;line-height:1.25;font-family:ISOCP3;-inkscape-font-specification:ISOCP3;letter-spacing:0px;word-spacing:0px;fill:#ffffff;fill-opacity:1;stroke:none;stroke-width:1.11630952;stroke-miterlimit:4;stroke-dasharray:none"
                                xml:space="preserve"><tspan
                                    style="font-style:normal;font-variant:normal;font-weight:500;font-stretch:normal;font-size:18.78076553px;font-family:Oswald;-inkscape-font-specification:'Oswald, Medium';font-variant-ligatures:normal;font-variant-caps:normal;font-variant-numeric:normal;font-feature-settings:normal;text-align:start;writing-mode:lr-tb;text-anchor:start;fill:#ffffff;stroke:#000000;stroke-width:1.11630952;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                                    y="97.198219"
                                    x="174.69472"
                                    id="tspan850-0-8-7-3-1-9-0-9-5-8"
                                    sodipodi:role="line">15</tspan></text>
                    </g>
                    <circle
                            style="fill:#e12013;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:3;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                            id="path1709"
                            cx="14.164133"
                            cy="572.72455"
                            r="9.0871639" />
                    <circle
                            style="fill:#e12013;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:3;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                            id="path1709-6"
                            cx="15.600775"
                            cy="12.530617"
                            r="6.6275368" />
                    <circle
                            style="fill:#e12013;fill-opacity:1;fill-rule:nonzero;stroke:#ffffff;stroke-width:0;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:3;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                            id="path1709-6-1"
                            cx="419.88062"
                            cy="10.228257"
                            r="6.6275368" />
                    <path
                            style="fill:none;stroke:#e12013;stroke-width:1.82939625;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1"
                            d="m 14.056046,581.63429 1.286313,-571.438926 404.496161,-0.02547 1.9045,582.163696"
                            id="path1749"
                            inkscape:connector-curvature="0"
                            sodipodi:nodetypes="cccc" />
                    <path
                            sodipodi:type="star"
                            style="fill:#e12013;fill-opacity:1;fill-rule:nonzero;stroke:#e12013;stroke-width:1.66499996;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1;paint-order:stroke markers fill"
                            id="path1753"
                            sodipodi:sides="3"
                            sodipodi:cx="379.78998"
                            sodipodi:cy="585.30017"
                            sodipodi:r1="13.343416"
                            sodipodi:r2="26.48023"
                            sodipodi:arg1="-0.51293504"
                            sodipodi:arg2="0.52449891"
                            inkscape:flatsided="false"
                            inkscape:rounded="0.02"
                            inkscape:randomized="0"
                            d="m 391.4162,578.75207 c 0.22767,0.39515 11.52663,19.41636 11.2944,19.80885 -0.23488,0.39698 -22.60165,0.0823 -23.06291,0.0819 -0.45605,-4.1e-4 -22.57837,0.27417 -22.80217,-0.12319 -0.22636,-0.4019 11.22953,-19.61477 11.46052,-20.01402 0.22838,-0.39475 11.05175,-19.69053 11.50777,-19.68567 0.46124,0.005 11.37212,19.53245 11.60239,19.93212 z"
                            inkscape:transform-center-x="2.1357181"
                            inkscape:transform-center-y="3.6675354"
                            transform="matrix(0.16199345,0.2868992,-0.2868992,0.16199345,528.21602,381.91137)" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 31.022972,518.68155 v 7.56711"
                            id="path9424"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.22669522;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.22669524, 0.22669524;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 31.023278,559.67105 -0.08247,40.49663"
                            id="path9426"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 30.695543,476.11655 0.327429,9.14361"
                            id="path9428"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 30.695543,442.69517 v -7.56713"
                            id="path9430"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 30.204399,393.03597 0.491144,8.67065"
                            id="path9432"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 30.204399,359.61455 v -7.56708"
                            id="path9434"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 29.876971,309.48245 0.327428,9.14362"
                            id="path9436"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 29.876971,268.49394 v 7.56709"
                            id="path9438"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 29.876971,223.5642 v 11.50832"
                            id="path9440"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 29.876971,182.57569 v 7.5671"
                            id="path9442"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 29.549544,140.01067 0.327427,9.14362"
                            id="path9444"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 29.549544,99.022163 v 7.567097"
                            id="path9446"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.28579047;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.28579048, 0.57158093;stroke-dashoffset:0;stroke-opacity:1"
                            d="M 74.061519,27.968153 29.549544,65.600764"
                            id="path9448"
                            inkscape:connector-curvature="0"
                            sodipodi:nodetypes="cc" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 108.76888,27.968149 16.92308,-0.256888"
                            id="path9450"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 160.3993,27.711261 16.32441,0.204847"
                            id="path9452"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 211.43108,27.916108 15.7654,0.18899"
                            id="path9454"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 275.12245,27.553378 -13.21862,0.55172"
                            id="path9456"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 309.82982,27.553378 14.07937,0.157649"
                            id="path9458"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.34759396;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.34759396, 0.69518789;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 358.61655,27.711031 43.62787,38.936865"
                            id="path9460"
                            inkscape:connector-curvature="0"
                            sodipodi:nodetypes="cc" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 402.24445,100.0693 v 7.56708"
                            id="path9462"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 402.24445,141.05779 0.32741,9.14363"
                            id="path9464"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 402.57186,183.62282 v 7.5671"
                            id="path9466"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 402.57186,224.61133 v 11.5083"
                            id="path9468"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 402.57186,269.54104 v 7.56713"
                            id="path9470"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 402.57186,310.52959 0.32744,9.14359"
                            id="path9472"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 402.8993,353.09457 v 7.56709"
                            id="path9474"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 402.8993,394.08308 0.49117,8.67065"
                            id="path9476"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 403.39047,436.17515 v 7.56713"
                            id="path9478"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 403.39047,477.16367 0.32741,9.14362"
                            id="path9480"
                            inkscape:connector-curvature="0" />
                    <path
                            style="fill:none;stroke:#000000;stroke-width:0.3180756;stroke-linecap:butt;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:0.31807561, 0.63615119;stroke-dashoffset:0;stroke-opacity:1"
                            d="m 403.71788,519.72871 v 7.56705"
                            id="path9482"
                            inkscape:connector-curvature="0" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713"
                            width="11.269715"
                            height="37.195"
                            x="81.22773"
                            y="68.645973" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8"
                            width="11.269715"
                            height="37.195"
                            x="81.22773"
                            y="105.84098" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6"
                            width="11.269715"
                            height="37.195"
                            x="81.22773"
                            y="143.03598" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8"
                            width="11.269715"
                            height="37.195"
                            x="81.22773"
                            y="180.23097" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-7"
                            width="11.269715"
                            height="37.195"
                            x="81.642853"
                            y="241.59656" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-7-8"
                            width="11.269715"
                            height="37.195"
                            x="81.642853"
                            y="278.79156" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-7-5"
                            width="11.269715"
                            height="37.195"
                            x="81.642853"
                            y="315.98654" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-4"
                            width="11.269715"
                            height="37.195"
                            x="337.53922"
                            y="67.844139" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-7"
                            width="11.269715"
                            height="37.195"
                            x="337.53922"
                            y="105.03915" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-0"
                            width="11.269715"
                            height="37.195"
                            x="337.53922"
                            y="142.23415" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-4"
                            width="11.269715"
                            height="37.195"
                            x="337.53922"
                            y="179.42914" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-7-7"
                            width="11.269715"
                            height="37.195"
                            x="337.60233"
                            y="241.97453" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-7-8-7"
                            width="11.269715"
                            height="37.195"
                            x="337.60233"
                            y="279.16953" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-7-5-4"
                            width="11.269715"
                            height="37.195"
                            x="337.60233"
                            y="316.3645" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-4-8"
                            width="11.269715"
                            height="37.195"
                            x="-79.915688"
                            y="-129.69244"
                            transform="matrix(0,-1,-1,0,0,0)" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-7-6"
                            width="11.269715"
                            height="37.195"
                            x="-79.915688"
                            y="-166.88745"
                            transform="matrix(0,-1,-1,0,0,0)" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-0-9"
                            width="11.269715"
                            height="37.195"
                            x="-79.113853"
                            y="-337.53922"
                            transform="matrix(0,-1,-1,0,0,0)" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-4-1"
                            width="11.269715"
                            height="37.195"
                            x="-79.113853"
                            y="-300.34421"
                            transform="matrix(0,-1,-1,0,0,0)" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-7-7-4"
                            width="11.269715"
                            height="37.195"
                            x="-79.113853"
                            y="-263.1492"
                            transform="matrix(0,-1,-1,0,0,0)" />
                    <rect
                            style="fill:none;fill-opacity:1;fill-rule:nonzero;stroke:#000000;stroke-width:0.22059961;stroke-linecap:round;stroke-linejoin:miter;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke markers fill"
                            id="rect9713-8-6-8-7-8-7-7"
                            width="11.269715"
                            height="37.195"
                            x="-79.915688"
                            y="-204.08246"
                            transform="matrix(0,-1,-1,0,0,0)" />
                </g>
                <style
                        id="style9490"
                        type="text/css">
                    .st0{display:none;}
                    .st1{display:inline;fill:#1B2748;}
                    .st2{fill:#25378A;}
                    .st3{fill:#2C4A9A;}
                    .st4{fill:#2B499A;}
                    .st5{fill:#2C4B9B;}
                    .st6{fill:#2C4E9D;}
                    .st7{fill:#2D4E9D;}
                    .st8{fill:#FFFFFF;}
                    .st9{fill:#2F4C9C;}
                    .st10{fill:none;}
                    .st11{opacity:0.6;fill:#FFFFFF;}
                    .st12{fill:#273579;}
                    .st13{display:none;fill:#E12013;}
                    .st14{display:none;fill:#BC1818;}
                    .st15{fill:#E12013;}
                    .st16{fill:#BC1818;}
                    .st17{display:inline;}
                    .st18{fill:#010202;}
                    .st19{fill:#001437;}
                    .st20{fill:#00305B;}
                    .st21{display:inline;fill:#010202;}
                </style>
            </svg>
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


        const get_station_number = username => username.match(/[\d]{2}$/);

        const fill_station = (station_no, color) => {
            const station = svg_map.getElementById(station_prefix+station_no)
            station.setAttribute("fill", color);
            station.style.fill = color;
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
                default:
                    color = "gray";
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

    </script>
@endpush