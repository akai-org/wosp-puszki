<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('superadmin');
    }

    public function getCreate()
    {
        return view('user.create');
    }

    public function postCreate(Request $request)
    {
        $request->validate([
            'userName' => 'required|alpha_num|between:1,255|unique:users,name',
            'password' => 'required|confirmed|between:1,255',
            'role' => 'required|in:volounteer,admin,superadmin'
        ]);

        $user = new User();
        $user->name = $request->input('userName');
        $user->password = bcrypt($request->input('password'));

        $user->save();

        $role = Role::where('name', '=', $request->input('role'))->first();
        $user->roles()->attach($role);

        Log::info(Auth::user()->name . " utworzył/a użytkownika: " . $user->name);

        return redirect()->route('user.create')->with('message',
            'Dodano użytkownika ' . $user->name);
    }

    public function getPassword(User $user)
    {
        return view('user.password')->with('user', $user);
    }

    public function postPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|confirmed|between:1,255'
        ]);

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->route('user.list')->with('message',
            'Zmieniono hasło dla użytkownika: ' . $user->name);
    }

    public function getList()
    {
        $users = User::with('roles')->get();
        return view('user.list')->with('users', $users);
    }
}
