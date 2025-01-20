<?php

namespace App\Http\Controllers;

use App\BoxEvent;
use App\CharityBox;
use App\Lib\BoxOperator\BoxOperator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CharityBoxController extends Controller
{

    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');

        $this->middleware('admin')->only(
            ['getVerifyList', 'getVerify', 'postVerify', 'getList', 'getListAway', 'getModify', 'postModify']
        );
    }

    //Dodaj nową puszkę (formularz)
    public function getCreate(){
        return view('liczymy.box.create');
    }

    //Dodaj nową puszkę
    public function postCreate(Request $request){
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->giveByCollectorIdentifier($request->input('collectorIdentifier'));
        } catch (\Exception $e) {
            return redirect()->route('liczymy.box.create')
                ->with('error', $e->getMessage());
        }

        return view('liczymy.box.create')->with('message', 'Wydano puszkę wolontariuszowi ' . $box->collector->display . $box->display_id);
    }

    //Znajdź puszkę (formularz)
    public function getFind() {
        return view('liczymy.box.find');
    }

    //Znajdź puszkę (formularz)
    public function postFind(Request $request) {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->findLatestUncountedByCollectorIdentifier($request->input('collectorIdentifier'));
        } catch (\Exception $e) {
            return redirect()->route('box.find')
                ->with('error', 'Wszystkie puszki wolontariusza są rozliczone.');
        }

        return view('liczymy.box.found')->with('box', $box);
    }

    //Rozlicz puszkę (formularz)
    public function getCount(Request $request, $boxID){
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->startCountByBoxID($request, $boxID);
        } catch (\Exception $e) {
            return redirect()->route('box.find')
                ->with('error', $e->getMessage());
        }

        return view('liczymy.box.count')->with('box', $box);
    }

    //Rozlicz puszkę
    public function postCount(Request $request, $boxID){
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->updateBoxByBoxID($request, $boxID);
        } catch (\Exception $e) {
            return redirect()->route('box.find')
                ->with('error', 'ERROR');
        }

        // Flash input in case user wants to go back
        $request->flash();

        //Przedstawiamy do weryfikacji
        return view('liczymy.box.confirm')->with('box', $box);
    }

    //Potwierdź puszkę (dla wolontariusza)
    public function confirm(Request $request, $boxID){
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->confirmBoxByBoxID($boxID);
        } catch (\Exception $e) {
            return redirect()->route('box.find')
                ->with('error', 'ERROR');
        }

        //Zwróć info że puszka zapisana
        return redirect()->route('box.find')
            ->with('message', 'Puszka wolontariusza ' . $box->collector->display . ' została przesłana do zatwierdzenia. (' . $box->amount_PLN . 'zł)');
    }

    //Lista puszek do potwierdzenia (dla administratora)
    public function getVerifyList(){
        //Używa API w CharityBoxApiController
        return view('liczymy.box.verifyList');
    }

    //Wyświetl pojedynczą puszkę
    public function getDisplay(Request $request, $boxID) {
        $box = CharityBox::where('id', '=', $boxID)->first();

        return view('liczymy.box.display')->with('box', $box);
    }

    //Potwierdź puszkę (dla administratora)
    public function getVerify(Request $request, $boxID){
        $box = CharityBox::where('id', '=', $boxID)->first();

        //Sprawdź czy puszka jest przeliczona
        if($box->is_given_to_collector && $box->is_counted && !$box->is_confirmed){
            return view('liczymy.box.verify')->with('box', $box);
        } else {
            return redirect()->route('main')->with('error', 'Puszka nie może być potwierdzona');
        }
    }

    //Potwierdź puszkę (dla administratora)
    public function postVerify(Request $request){
        $box = CharityBox::where('id', '=', $request->boxID)->first();
        $box->is_confirmed = true;
        $box->user_confirmed_id = $request->user()->id;
        $box->time_confirmed = Carbon::now();
        $box->save();

        //Drukuj potwierdzenie?
        //TODO
        //Zapisujemy event do bazy

        $event = new BoxEvent();
        $event->type = 'verified';
        $event->box_id = $box->id;
        $event->user_id = $request->user()->id;
        $event->comment = '';
        $event->save();

        //BoxConfirmed::dispatch();

        return json_encode(
            [
                'message' => 'Puszka nr ' . $box->id . ' potwierdzona ('.$box->amount_PLN.'zł)',
                'status' => 'success'
            ]
        );
    }

    //Wyświetl wszystkie puszki (dla administratora)
    public function getList(){
        $boxes = CharityBox::with('collector')->get(); // remove n+1 problem

        return view('liczymy.box.list')->with('boxes', $boxes);
    }

    //Wyświeltl puszki, które nie zostały rozliczone (dla administratora)
    public function getListAway(){
        $boxes = CharityBox::with('collector')->where('is_counted', '=', 0)->get(); // remove n+1 problem

        return view('liczymy.box.list')->with('boxes', $boxes);
    }

    //Modyfikuj puszkę (dla administratora)
    public function getModify($boxID) {
        $box = CharityBox::where('id', '=', $boxID)->first();

        //TODO fix this nicer
        //abezpieczenie że zatwierdzonej puszki nie można modyfikować
        if($box->is_confirmed) {
            abort('404', 'Nie można modyfikować zatwierdzonej puszki.');
        }

        return view('liczymy.box.modify')->with('box', $box);
    }

    //Modyfikuj puszkę (dla administratora)
    public function postModify(Request $request, $boxID) {
        $bo = new BoxOperator($request->user()->id);

        try {
            $box = $bo->updateBoxByBoxID($request, $boxID);
        } catch (\Exception $e) {
            abort(404);
        }

        return redirect()->route('box.verify.list')->with('message', 'Zapisano puszkę wolontariusza ' . $box->collectorIdentifier . ', ID w bazie:' . $box->id . ' (' . $box->amount_PLN  . 'zł)');
    }
}
