<?php

use App\CharityBox;
use App\Collector;
use App\Role;
use App\User;
use Illuminate\Testing\Fluent\AssertableJson;

beforeEach(function () {
    $this->volounteerRoleId = Role::where('name', '=', 'volounteer')->first()->id;
    $this->volounteer = User::with('roles')->orderBy('id')->whereRelation('roles', 'name', 'volounteer')->first();
    $this->assertEquals($this->volounteer->name, 'wosp01');
});

test('as a volounteer I can get exchange rates', function () {
    $this->actingAs($this->volounteer);

    //Wchodzę na rates
    $response = $this->get('api/currency/rates');

    $response->assertStatus(200);

    $response->assertJson(fn (AssertableJson $json) =>
    $json->whereType('rates', 'array')
        ->whereAllType([
            'rates.EUR' => 'double',
            'rates.USD' => 'double',
            'rates.GBP' => 'double',
        ])
    );

});
