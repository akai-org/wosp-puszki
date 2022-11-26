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

test('as a collectorcoordinator I can give out a box through API', function () {
    //WIP
    $this->actingAs($this->collectorcoordinator, 'sanctum');

    $this->getJson('api/health');

//    $this->actingAs($this->volounteer);

    $this->collector = Collector::orderBy('id', 'asc')->first();
    $this->box = CharityBox::where('collectorIdentifier', '=', $this->collector->identifier)->orderBy('created_at', 'desc')->first();

    //Wchodzę na rozliczanie puszki
    $response = $this->get('api/collectors/' . $this->collector->identifier . '/boxes/latestUncounted');

    $response->assertStatus(200);
});
