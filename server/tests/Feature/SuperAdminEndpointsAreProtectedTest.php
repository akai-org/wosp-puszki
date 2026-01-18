<?php

use App\User;

beforeEach(function () {
    $this->volounteer = User::with('roles')->orderBy('id')->whereRelation('roles', 'name', 'volounteer')->first();
    $this->assertEquals($this->volounteer->name, 'wosp01');
    $this->actingAs($this->volounteer);
});

test('user adding is protected from volounteers', function () {
    $response = $this->get('/user/create');

    $response->assertStatus(302);
});

test('user list is protected from volounteers', function () {
    $response = $this->get('/user/list');

    $response->assertStatus(302);
});

test('logs are protected from volounteers', function () {
    $response = $this->get('/logs/all');

    $response->assertStatus(302);
});

test('volounteer list is protected from volounteers', function () {
    $response = $this->get('/collector/list');

    $response->assertStatus(302);
});

test('volounteer adding is protected from volounteers', function () {
    $response = $this->get('/collector/create');

    $response->assertStatus(302);
});
