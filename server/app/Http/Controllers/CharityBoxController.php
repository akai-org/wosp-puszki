<?php

namespace App\Http\Controllers;

use App\BoxEvent;
use App\CharityBox;
use App\Lib\BoxOperator\BoxOperator;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CharityBoxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('admin')->only(
            ['getVerifyList', 'getVerify', 'postVerify', 'getList', 'getListAway', 'getModify', 'postModify']
        );
    }

    public function getCreate(): Factory|View|\Illuminate\View\View
    {
        return view('box.create');
    }

    public function postCreate(Request $request): RedirectResponse|Factory|View|\Illuminate\View\View
    {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->giveByCollectorIdentifier($request->input('collectorIdentifier'));
        } catch (Exception $e) {
            return redirect()->route('box.create')
                ->with('error', $e->getMessage());
        }

        return view('box.create')->with('message', 'Wydano puszkę wolontariuszowi '.$box->collector->display.$box->display_id);
    }

    public function getFind(): Factory|View|\Illuminate\View\View
    {
        return view('box.find');
    }

    public function postFind(Request $request): RedirectResponse|Factory|View|\Illuminate\View\View
    {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->findLatestUncountedByCollectorIdentifier($request->input('collectorIdentifier'));
        } catch (Exception $e) {
            return redirect()->route('box.find')
                ->with('error', 'Wszystkie puszki wolontariusza są rozliczone.');
        }

        return view('box.found')->with('box', $box);
    }

    public function getCount(Request $request, int $boxID): RedirectResponse|Factory|View|\Illuminate\View\View
    {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->startCountByBoxID($request, $boxID);
        } catch (Exception $e) {
            return redirect()->route('box.find')
                ->with('error', $e->getMessage());
        }

        return view('box.count')->with('box', $box);
    }

    public function postCount(Request $request, int $boxID): RedirectResponse|Factory|View|\Illuminate\View\View
    {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->updateBoxByBoxID($request, $boxID);
        } catch (Exception $e) {
            return redirect()->route('box.find')
                ->with('error', 'ERROR');
        }

        // Flash input in case user wants to go back
        $request->flash();

        return view('box.confirm')->with('box', $box);
    }

    public function confirm(Request $request, int $boxID): RedirectResponse
    {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->confirmBoxByBoxID($boxID);
        } catch (Exception $e) {
            return redirect()->route('box.find')
                ->with('error', 'ERROR');
        }

        return redirect()->route('box.find')
            ->with('message', 'Puszka wolontariusza '.$box->collector->display.' została przesłana do zatwierdzenia. ('.$box->amount_PLN.'zł)');
    }

    public function getVerifyList(): Factory|View|\Illuminate\View\View
    {
        return view('box.verifyList');
    }

    public function getDisplay(int $boxID): Factory|View|\Illuminate\View\View
    {
        $box = CharityBox::where('id', '=', $boxID)->first();

        return view('box.display')->with('box', $box);
    }

    public function getVerify(int $boxID): RedirectResponse|Factory|View|\Illuminate\View\View
    {
        $box = CharityBox::where('id', '=', $boxID)->first();

        if ($box->is_given_to_collector && $box->is_counted && ! $box->is_confirmed) {
            return view('box.verify')->with('box', $box);
        } else {
            return redirect()->route('main')->with('error', 'Puszka nie może być potwierdzona');
        }
    }

    public function postVerify(Request $request): false|string
    {
        $box = CharityBox::where('id', '=', $request->boxID)->first();
        $box->is_confirmed = true;
        $box->user_confirmed_id = $request->user()->id;
        $box->time_confirmed = Carbon::now();
        $box->save();

        $event = new BoxEvent;
        $event->type = 'verified';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = '';
        $event->save();

        return json_encode(
            [
                'message' => 'Puszka nr '.$box->id.' potwierdzona ('.$box->amount_PLN.'zł)',
                'status' => 'success',
            ]
        );
    }

    public function getList(): Factory|View|\Illuminate\View\View
    {
        $boxes = CharityBox::with('collector')->get(); // remove n+1 problem

        return view('box.list')->with('boxes', $boxes);
    }

    public function getListAway(): Factory|View|\Illuminate\View\View
    {
        $boxes = CharityBox::with('collector')->where('is_counted', '=', 0)->get(); // remove n+1 problem

        return view('box.list')->with('boxes', $boxes);
    }

    public function getModify(int $boxID): Factory|View|\Illuminate\View\View
    {
        $box = CharityBox::where('id', '=', $boxID)->first();

        if ($box->is_confirmed) {
            abort(404, 'Nie można modyfikować zatwierdzonej puszki.');
        }

        return view('box.modify')->with('box', $box);
    }

    public function postModify(Request $request, int $boxID): RedirectResponse
    {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->updateBoxByBoxID($request, $boxID);
        } catch (Exception $e) {
            abort(404);
        }

        return redirect()->route('box.verify.list')->with('message', 'Zapisano puszkę wolontariusza '.$box->collectorIdentifier.', ID w bazie:'.$box->id.' ('.$box->amount_PLN.'zł)');
    }
}
