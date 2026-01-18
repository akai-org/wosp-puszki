<?php

use App\User;

beforeEach(function () {
    $this->superadmin = User::with('roles')->orderBy('id')->whereRelation('roles', 'name', 'superadmin')->first();
    $this->assertEquals($this->superadmin->name, 'superadmin');
    $this->actingAs($this->superadmin);
});

test('panel loads as superadmin', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('create box loads as superadmin', function () {
    $response = $this->get('/box/create');

    $response->assertStatus(200);
});

test('logs loads as superadmin', function () {
    $response = $this->get('/logs/all');

    $response->assertStatus(200);
});
