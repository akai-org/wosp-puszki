<?php

use App\Role;
use App\User;

beforeEach(function () {
    $this->collectorCoordinatorRoleId = Role::where('name', '=', 'collectorcoordinator')->first()->id;
    $this->collectorcoordinator = User::with('roles')->whereRelation('roles', 'name', 'collectorcoordinator')->first();
    $this->assertEquals($this->collectorcoordinator->name, 'wolokord');
});

test('as a collectorcoordinator I access API through sanctum auth', function () {

    $this
        ->actingAs($this->collectorcoordinator, 'sanctum')
        ->getJson('api/health')
        ->assertOk();
});
