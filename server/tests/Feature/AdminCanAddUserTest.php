<?php

use App\Role;
use App\User;

beforeEach(function () {
    $this->superAdminRoleId = Role::where('name', '=', 'superadmin')->first()->id;
    $this->superadmin = User::with('roles')->orderBy('id')->whereRelation('roles', 'name', 'superadmin')->first();
    $this->assertEquals($this->superadmin->name, 'superadmin');
    $this->actingAs($this->superadmin);
});

test('as a superadmin I can see add user form with correct labels in order', function () {
    $response = $this->get('/user/create');

    $response->assertSeeInOrder([
        'Nazwa użytkownika',
        'Hasło',
        'Potwierdzenie hasła',
        'Typ użytkownika',
    ]);

    $response->assertStatus(200);
});

test('as a superadmin I can add a user', function () {
    $response = $this->post('/user/create', [
        'userName' => 'testUser',
        'password' => 'haslo1234',
        'password_confirmation' => 'haslo1234',
        'role' => 'superadmin',
    ]);

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'name' => 'testUser',
    ]);

    $this->addedUser = User::orderBy('id', 'desc')->first();

    $this->assertDatabaseHas('role_user', [
        'role_id' => $this->superAdminRoleId,
        'user_id' => $this->addedUser->id,
    ]);

    // Check if visible on list
    $response = $this->get('/user/list');

    $response->assertSee('testUser');

});

afterEach(function () {
    if (! empty($this->addedUser)) {
        $this->addedUser->delete();
        $userId = $this->addedUser->id;
        DB::delete("DELETE FROM role_user where role_id = $this->superAdminRoleId  and user_id = $userId;");
    }

});
