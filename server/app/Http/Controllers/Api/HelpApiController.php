<?php

namespace App\Http\Controllers\Api;

use App\Events\HelpRequested;
use App\Events\HelpResolved;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpApiController extends Controller
{
    public function request(Request $request)
    {
        $userName = $request->user()->name;

        HelpRequested::dispatch($userName);

        return response()->json(['status' => 'Help requested']);
    }

    public function resolve(Request $request)
    {
        $userName = $request->user()->name;

        HelpResolved::dispatch($userName);

        return response()->json(['status' => 'Help resolved']);
    }
}
