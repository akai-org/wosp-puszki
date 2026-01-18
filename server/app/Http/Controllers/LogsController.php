<?php

namespace App\Http\Controllers;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('collectorcoordinator');
    }

    public function getAll()
    {
        return view('logs.box.display')
            ->with('ApiUrl', route('api.logs.list'))
            ->with('enableRefresh', true);
    }

    public function getBox($boxID)
    {
        return view('logs.box.display')
            ->with('ApiUrl', route('api.logs.box', ['boxID' => $boxID]))
            ->with('enableRefresh', false);
    }
}
