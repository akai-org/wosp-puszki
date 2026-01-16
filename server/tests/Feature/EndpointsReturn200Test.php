<?php

test('homepage loads', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('panel fails to load without login', function () {
    $response = $this->get('/liczymy');

    $response->assertStatus(302);
});
