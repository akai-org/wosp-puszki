<?php

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->superadmin = User::with('roles')->whereRelation('roles', 'name', 'superadmin')->first();
    $this->assertEquals($this->superadmin->name, 'superadmin');
    $this->actingAs($this->superadmin);
});

test('as an admin I can see add user form with correct labels in order', function () {
    $response = $this->get('/liczymy/user/create');

    $response->assertSeeInOrder([
        'Nazwa użytkownika',
        'Hasło',
        'Potwierdzenie hasła',
        'Typ użytkownika',
    ]);


    $response->assertStatus(200);
});

test('as a superadmin I can add a user', function () {
    $response = $this->post('/liczymy/user/create', [
        'userName' => 'testUser',
        'password' => 'haslo1234',
        'password_confirmation' => 'haslo1234',
        'role' => 'superadmin',
    ]);

    $response->assertStatus(302);

    $this->assertDatabaseHas('users', [
        'name' => 'testUser',
    ]);

    $user = User::orderBy('id', 'desc')->first();
    $role = Role::where('name', '=', 'superadmin')->first();

    $this->assertDatabaseHas('role_user', [
        'role_id' => $role->id,
        'user_id' => $user->id
    ]);

    //Check if visible on list
    $response = $this->get('/liczymy/user/list');

    $response->assertSee('testUser');

    //Cleanup to be refactored
    $user->delete();
    DB::delete("DELETE FROM role_user where role_id = $role->id and user_id = $user->id;");

});