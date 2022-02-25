<?php

use App\User;

beforeEach(function () {
    $this->volounteer = User::with('roles')->whereRelation('roles', 'name', 'volounteer')->first();
    $this->assertEquals($this->volounteer->name, 'wosp01');
    $this->actingAs($this->volounteer);
});

test('box creation is protected from volounteers', function () {
    $response = $this->get('/liczymy/box/create');

    $response->assertStatus(302);
});

test('boxes list is protected from volounteers', function () {
    $response = $this->get('/liczymy/box/list');

    $response->assertStatus(302);
});

test('away boxes list is protected from volounteers', function () {
    $response = $this->get('/liczymy/box/list/away');

    $response->assertStatus(302);
});
