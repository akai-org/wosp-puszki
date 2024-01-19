<?php

use App\User;

beforeEach(function () {
    $this->superadmin = User::with('roles')->whereRelation('roles', 'name', 'superadmin')->first();
    $this->assertEquals($this->superadmin->name, 'superadmin');
    $this->actingAs($this->superadmin);
});

test('panel loads as superadmin', function () {
    $response = $this->get('/liczymy');

    $response->assertStatus(200);
});

test('create box loads as superadmin', function () {
    $response = $this->get('/liczymy/box/create');

    $response->assertStatus(200);
});

test('logs loads as superadmin', function () {
    $response = $this->get('/liczymy/logs/all');

    $response->assertStatus(200);
});
