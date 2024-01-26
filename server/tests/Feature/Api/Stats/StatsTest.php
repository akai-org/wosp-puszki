<?php

use App\CharityBox;
use App\Collector;
use App\Role;
use App\User;
use Illuminate\Testing\Fluent\AssertableJson;

test('as a volounteer I can get stats', function () {
    //Wchodzę na stats
    $response = $this->get('api/stats');

    $response->assertStatus(200);

    $response->assertJson(fn (AssertableJson $json) =>
    $json->whereType('rates', 'array')
        ->whereAllType([
            'amount_PLN' => 'string',
            'amount_EUR' => 'string',
            'amount_GBP' => 'string',
            'amount_USD' => 'string',
            'amount_total_in_PLN' => 'string',
            'collectors_in_city' => 'integer',
        ])
    );

});
