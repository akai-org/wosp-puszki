<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function __construct()
    {
        // Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        $user = $request->user();
        $stations = Cache::get('stations_needing_help', []);
        $data = [
            'username' => $user->name,
        ];

        return view('liczymy.main')->with('data', $data)->with('stations', $stations);
    }
}
