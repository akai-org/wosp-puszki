<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('collectorcoordinator');
    }

    public function getAll(): Factory|View|\Illuminate\View\View
    {
        return view('liczymy.logs.box.display')
            ->with('ApiUrl', route('api.logs.list'))
            ->with('enableRefresh', true);
    }

    public function getBox(int $boxID): Factory|View|\Illuminate\View\View
    {
        return view('liczymy.logs.box.display')
            ->with('ApiUrl', route('api.logs.box', ['boxID' => $boxID]))
            ->with('enableRefresh', false);
    }
}
