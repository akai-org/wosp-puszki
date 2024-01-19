<?php

use App\User;

beforeEach(function () {
    $this->volounteer = User::with('roles')->whereRelation('roles', 'name', 'volounteer')->first();
    $this->assertEquals($this->volounteer->name, 'wosp01');
    $this->actingAs($this->volounteer);
});

test('user adding is protected from volounteers', function () {
    $response = $this->get('/liczymy/user/create');

    $response->assertStatus(302);
});

test('user list is protected from volounteers', function () {
    $response = $this->get('/liczymy/user/list');

    $response->assertStatus(302);
});

test('logs are protected from volounteers', function () {
    $response = $this->get('/liczymy/logs/all');

    $response->assertStatus(302);
});

test('volounteer list is protected from volounteers', function () {
    $response = $this->get('/liczymy/collector/list');

    $response->assertStatus(302);
});

test('volounteer adding is protected from volounteers', function () {
    $response = $this->get('/liczymy/collector/create');

    $response->assertStatus(302);
});