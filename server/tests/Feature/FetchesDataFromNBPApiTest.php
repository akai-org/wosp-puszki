<?php

use App\Lib\Rates\CurrentRatesFetcher;

test('it correctly fetches rates data from NBP', function () {
    $fetcher = new CurrentRatesFetcher();
    $rates = $fetcher->fetchRates();

    $this->assertIsArray($rates);

    $this->assertIsFloat($rates['USD']);
    $this->assertIsFloat($rates['GBP']);
    $this->assertIsFloat($rates['EUR']);

    //These tests will fail in geopolitical turmoil
    $this->assertGreaterThanOrEqual(4.00, $rates['USD']);
    $this->assertGreaterThanOrEqual(4.00, $rates['GBP']);
    $this->assertGreaterThanOrEqual(4.00, $rates['EUR']);

    $this->assertLessThanOrEqual(5.00, $rates['USD']);
    $this->assertLessThanOrEqual(6.00, $rates['GBP']);
    $this->assertLessThanOrEqual(5.00, $rates['EUR']);
});

