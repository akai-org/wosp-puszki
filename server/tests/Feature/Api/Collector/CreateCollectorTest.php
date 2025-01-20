<?php

use App\Collector;
use App\User;

beforeEach(function () {
    // Tworzenie użytkownika z odpowiednimi uprawnieniami
    $this->collectorcoordinator = User::with('roles')->whereRelation('roles', 'name', 'collectorcoordinator')->first();
    $this->assertEquals($this->collectorcoordinator->name, 'wolokord');

});

test('a user can create a collector with valid data', function () {
    $this->actingAs($this->collectorcoordinator);

    $payload = [
        'collectorIdentifier' => '123ABC',
        'firstName' => 'John',
        'lastName' => 'Doe',
        'phoneNumber' => '123456789',
    ];

    $response = $this->postJson('/api/collectors', $payload);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'id',
            'identifier',
            'firstName',
            'lastName',
            'phoneNumber',
            'created_at',
            'updated_at',
        ]);

    $this->assertDatabaseHas('collectors', [
        'identifier' => $payload['collectorIdentifier'],
        'firstName' => $payload['firstName'],
        'lastName' => $payload['lastName'],
        'phoneNumber' => $payload['phoneNumber'],
    ]);
});

test('a user can NOT create a collector with a duplicate identifier', function () {
    $this->actingAs($this->collectorcoordinator);

    $collector = new Collector();
    $collector->identifier = '123ABCD';
    $collector->firstName = 'Jane';
    $collector->lastName = 'Smith';
    $collector->phoneNumber = '987654321';
    $collector->save();

    $payload = [
        'collectorIdentifier' => '123ABCD',
        'firstName' => 'Jane',
        'lastName' => 'Smith',
        'phoneNumber' => '987654321',
    ];

    $response = $this->postJson('/api/collectors', $payload);

    $response->assertStatus(422)
        ->assertJsonFragment(['message' => 'Taki collector identifier już występuje.']);
});

test('a user can NOT create a collector with invalid phone number', function () {
    $this->actingAs($this->collectorcoordinator);

    $payload = [
        'collectorIdentifier' => '456DEF',
        'firstName' => 'Anna',
        'lastName' => 'Kowalski',
        'phoneNumber' => 'invalid-phone',
    ];

    $response = $this->postJson('/api/collectors', $payload);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['phoneNumber']);

    $this->assertDatabaseMissing('collectors', [
        'identifier' => $payload['collectorIdentifier'],
    ]);
});

test('a user can NOT create a collector without authentication', function () {
    // Wylogowanie użytkownika
    auth()->logout();

    $payload = [
        'collectorIdentifier' => '789GHI',
        'firstName' => 'Peter',
        'lastName' => 'Parker',
        'phoneNumber' => '123456789',
    ];

    $response = $this->postJson('/api/collectors', $payload);

    $response->assertStatus(401); // Użytkownik nieautoryzowany
});
