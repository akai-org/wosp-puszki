<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request): Factory|View|\Illuminate\View\View
    {

        $user = $request->user();
        $stations = Cache::get('stations_needing_help', []);
        $data = [
            'username' => $user->name
        ];

        return view('liczymy.main')->with('data', $data)->with('stations', $stations);
    }
}
