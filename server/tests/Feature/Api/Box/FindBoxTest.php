<?php

use App\CharityBox;
use App\Collector;
use App\Role;
use App\User;

beforeEach(function () {
    $this->collectorCoordinatorRoleId = Role::where('name', '=', 'collectorcoordinator')->first()->id;
    $this->collectorcoordinator = User::with('roles')->whereRelation('roles', 'name', 'collectorcoordinator')->first();
    $this->assertEquals($this->collectorcoordinator->name, 'wolokord');
});

test('as a collectorcoordinator I can find a box through API', function () {
    $this->actingAs($this->collectorcoordinator);


    $this->box = CharityBox::where('is_counted', false)->orderBy('created_at', 'desc')->first();
    $this->collector = Collector::where('identifier', '=', $this->box->collectorIdentifier)->first();

    //Wchodzę na rozliczanie puszki
    $response = $this->get('api/collectors/' . $this->collector->identifier . '/boxes/latestUncounted');

    $response->assertStatus(200);

    $response->assertJson(
        [
            "id" => $this->box->id,
            "collectorIdentifier" => $this->collector->identifier,
            "collector_id" => $this->collector->id,
            "is_given_to_collector" => true,
            "given_to_collector_user_id" => $this->box->given_to_collector_user_id,
            "time_given" => $this->box->time_given,
            "is_counted" => 0,
            "counting_user_id" => null,
            "time_counted" => null,
            "is_confirmed" => 0,
            "user_confirmed_id" => null,
            "time_confirmed" => null,
            "count_1gr" => 0,
            "count_2gr" => 0,
            "count_5gr" => 0,
            "count_10gr" => 0,
            "count_20gr" => 0,
            "count_50gr" => 0,
            "count_1zl" => 0,
            "count_2zl" => 0,
            "count_5zl" => 0,
            "count_10zl" => 0,
            "count_20zl" => 0,
            "count_50zl" => 0,
            "count_100zl" => 0,
            "count_200zl" => 0,
            "count_500zl" => 0,
            "amount_PLN" => "0.00",
            "amount_EUR" => "0.00",
            "amount_USD" => "0.00",
            "amount_GBP" => "0.00",
            "comment" => $this->box->comment,
            "created_at" => $this->box->created_at->timezone('UTC')->format('Y-m-d\TH:i:s.u\Z'),
            "updated_at" => $this->box->updated_at->timezone('UTC')->format('Y-m-d\TH:i:s.u\Z'),
            "is_special_box" => 0,
            "collector" => [
                "id" => $this->collector->id,
                "identifier" => $this->collector->identifier,
                "firstName" => $this->collector->firstName,
                "lastName" => $this->collector->lastName,
                "created_at" => $this->collector->created_at->timezone('UTC')->format('Y-m-d\TH:i:s.u\Z'),
                "updated_at" => $this->collector->updated_at->timezone('UTC')->format('Y-m-d\TH:i:s.u\Z')
            ]
        ]
    );

});
