<?php

use Illuminate\Testing\Fluent\AssertableJson;

test('as a volounteer I can get stats', function () {
    // Wchodzę na stats
    $response = $this->get('api/stats');

    $response->assertStatus(200);

    $response->assertJson(fn (AssertableJson $json) => $json->whereType('rates', 'array')
        ->whereAllType([
            'amount_PLN' => ['double', 'integer'],
            'amount_PLN_unconfirmed' => ['double', 'integer'],
            'amount_PLN_eskarbonka' => ['double', 'integer'],
            'amount_EUR' => ['double', 'integer'],
            'amount_GBP' => ['double', 'integer'],
            'amount_USD' => ['double', 'integer'],
            'rates' => 'array',
            'amount_total_in_PLN' => ['double', 'integer'],
            'collectors_in_city' => 'integer',
            'amount_allegro' => ['double', 'integer', 'null'],
        ])
    );

});
