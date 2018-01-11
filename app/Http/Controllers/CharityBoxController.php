<?php

namespace App\Http\Controllers;

use App\CharityBox;
use App\Collector;
use Auth;
use Illuminate\Http\Request;
use Money\Money;
use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CharityBoxController extends Controller
{
    public function __construct()
    {
        //Zabezpieczamy autoryzacją (każdy zalogowany użytkownik ma dostęp)
        $this->middleware('auth');
    }

    //Dodaj nową puszkę (formularz)
    public function getCreate(){
        return view('liczymy.box.create');
    }

    //Dodaj nową puszkę
    public function postCreate(Request $request){
        $error = '';
        //Sprawdź poprawność danych (id/puszka)
        $request->validate([
            'collectorIdentifier' => 'required|between:1,255'
        ]);

        $collector = Collector::where('identifier', '=', $request->input('collectorIdentifier'));
        //Sprawdź czy wolontariusz istnieje
        if(!$collector->exists()){
            $error = 'Brak wolontariusza o takim identyfikatorze.';
        }

        //Dodaj puszkę
        if(empty($error)) {
            $collector = Collector::where('identifier', '=', $request->input('collectorIdentifier'))->first();

            //Brak błędów
            $box = new CharityBox();
            $box->collectorIdentifier = trim($request->input('collectorIdentifier'));
            $box->collector_id = $collector->id;
            $box->is_given_to_collector = true;
            $box->given_to_collector_user_id = Auth::user()->id;
            $box->time_given = Carbon::now();
            $box->save();

            Log::info(Auth::user()->name . " dodał/a puszkę o numerze (wolontariusz): " . $box->id .
             " (" . $box->collectorIdentifier . ")");

            //Redirect do dodawania kolejnej puszki
            return view('liczymy.box.create')->with('message',
                'Dodano puszkę wolontariusza ' .
                $collector->firstName . ' ' . $collector->lastName);

        } else {
            //Zwracamy błąd
            $request->flash();
            return view('liczymy.box.create')->with('error', $error);
        }
    }

    //Znajdź puszkę (formularz)
    public function getFind() {
        return view('liczymy.box.find');
    }

    //Znajdź puszkę (formularz)
    public function postFind(Request $request) {
        //Wyszukujemy użytkownika
        //Podajemy dane do sprawdzenia
        $request->validate([
            'collectorIdentifier' => 'required|exists:collectors,identifier|alpha_num|between:1,255'
        ]);
        $collector = Collector::where('identifier', '=', $request->input('collectorIdentifier'))->first();

        //Puszki zbieracza
        $boxes = $collector->boxes()->get();

        //Sprawdź czy wolontariusz ma nierozliczoną puszkę
        //iteracja po wszystkich puszkach TODO
        foreach ($boxes as $box) {
            if (!$box->is_counted) {
                return view('liczymy.box.found')->with('box', $box)->with('collector', $collector);
            }
        }

        return redirect()->route('box.find')
            ->with('error', 'Wszystkie puszki wolontariusza: ' . $request->input('collectorIdentifier') . 'są rozliczone.');

    }

    //Rozlicz puszkę (formularz)
    public function getCount(Request $request, $boxID){
        //Sprawdź czy nie jest rozliczona
        $box = CharityBox::where('id', '=', $boxID)->first();

        Log::info(Auth::user()->name . " rozpoczął/ęła rozliczanie puszki : " . $box->id .
            "/" . $box->collectorIdentifier);

        if(!$box->isCounted) {
            return view('liczymy.box.count')->with('box', $box);
        } else {
            return redirect()->route('box.find')
                ->with('error', 'Puszka została już rozliczona, numer puszki: ' . $box->id . 'Wolontariusz: '. $box->collectorIdentifier);
        }
    }

    //Rozlicz puszkę
    public function postCount(Request $request, $boxID){
        //Sprawdzamy czy pola są wypełnione, i czy poprawnie?
        $request->validate([
            //PLN
            'count_1gr' => 'required|integer|between:0,10000',
            'count_2gr' => 'required|integer|between:0,10000',
            'count_5gr' => 'required|integer|between:0,10000',
            'count_10gr' => 'required|integer|between:0,10000',
            'count_20gr' => 'required|integer|between:0,10000',
            'count_50gr' => 'required|integer|between:0,10000',
            'count_1zl' => 'required|integer|between:0,10000',
            'count_2zl' => 'required|integer|between:0,10000',
            'count_5zl' => 'required|integer|between:0,10000',
            'count_10zl' => 'required|integer|between:0,10000',
            'count_20zl' => 'required|integer|between:0,10000',
            'count_50zl' => 'required|integer|between:0,10000',
            'count_100zl' => 'required|integer|between:0,10000',
            'count_200zl' => 'required|integer|between:0,10000',
            'count_500zl' => 'required|integer|between:0,10000',
            //Waluty obce
            'amount_EUR' => 'required|numeric|between:0,10000',
            'amount_USD' => 'required|numeric|between:0,10000',
            'amount_GBP' => 'required|numeric|between:0,10000',
            'comment' => ''
        ]);

        //Przeliczamy sumę hajsu
        //Ilości są w groszach
        $total = Money::PLN(0);
        $total = $total->add(Money::PLN($request->input('count_1gr')));
        $total = $total->add(Money::PLN($request->input('count_2gr') * 2));
        $total = $total->add(Money::PLN($request->input('count_5gr') * 5));
        $total = $total->add(Money::PLN($request->input('count_10gr') * 10));
        $total = $total->add(Money::PLN($request->input('count_20gr') * 20));
        $total = $total->add(Money::PLN($request->input('count_50gr') * 50));
        $total = $total->add(Money::PLN($request->input('count_1zl') * 100));//1zł=100gr
        $total = $total->add(Money::PLN($request->input('count_2zl') * 200));
        $total = $total->add(Money::PLN($request->input('count_5zl') * 500));
        $total = $total->add(Money::PLN($request->input('count_10zl') * 1000));
        $total = $total->add(Money::PLN($request->input('count_20zl') * 2000));
        $total = $total->add(Money::PLN($request->input('count_50zl') * 5000));
        $total = $total->add(Money::PLN($request->input('count_100zl') * 10000));
        $total = $total->add(Money::PLN($request->input('count_200zl') * 20000));
        $total = $total->add(Money::PLN($request->input('count_500zl') * 50000));

        //Formatowanie
        $currencies = new ISOCurrencies();

        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        $totalFormatted = $moneyFormatter->format($total); // outputs 1.00 (decimal)

        //Kompilujemy dane
        $data = [
            'boxID' => $boxID,
            'count_1gr' => $request->input('count_1gr'),
            'count_2gr' => $request->input('count_2gr'),
            'count_5gr' => $request->input('count_5gr'),
            'count_10gr' => $request->input('count_10gr'),
            'count_20gr' => $request->input('count_20gr'),
            'count_50gr' => $request->input('count_50gr'),
            'count_1zl' => $request->input('count_1zl'),
            'count_2zl' => $request->input('count_2zl'),
            'count_5zl' => $request->input('count_5zl'),
            'count_10zl' => $request->input('count_10zl'),
            'count_20zl' => $request->input('count_20zl'),
            'count_50zl' => $request->input('count_50zl'),
            'count_100zl' => $request->input('count_100zl'),
            'count_200zl' => $request->input('count_200zl'),
            'count_500zl' => $request->input('count_500zl'),
            //Waluty obce
            'amount_EUR' => $request->input('amount_EUR'),
            'amount_USD' => $request->input('amount_USD'),
            'amount_GBP' => $request->input('amount_GBP'),
            'comment' => $request->input('comment'),
            'amount_PLN' => $totalFormatted
        ];

        Log::info(Auth::user()->name . " zakończył/a rozliczanie puszki: " . $boxID . " " . json_encode($data));

        //Zapisujemy dane w sesji
        session(['boxData' => $data]);

        // Flash input in case user wants to go back
        $request->flash();

        //Przedstawiamy do weryfikacji
        return view('liczymy.box.confirm')->with('data', $data);

    }

    //Potwierdź puszkę (dla wolontariusza)
    public function confirm(Request $request, $boxID){
        //Zapisz puszkę do bazy
        $box = CharityBox::where('id', '=', $boxID)->first();

        $box->is_counted=true;
        $box->counting_user_id = Auth::user()->id;
        //Add money
        $data = \Session::get('boxData');
        $box->count_1gr = $data['count_1gr'];
        $box->count_2gr = $data['count_2gr'];
        $box->count_5gr = $data['count_5gr'];
        $box->count_10gr = $data['count_10gr'];
        $box->count_20gr = $data['count_20gr'];
        $box->count_50gr = $data['count_50gr'];
        $box->count_1zl = $data['count_1zl'];
        $box->count_2zl = $data['count_2zl'];
        $box->count_5zl = $data['count_5zl'];
        $box->count_10zl = $data['count_10zl'];
        $box->count_20zl = $data['count_20zl'];
        $box->count_50zl = $data['count_50zl'];
        $box->count_100zl = $data['count_100zl'];
        $box->count_200zl = $data['count_200zl'];
        $box->count_500zl = $data['count_500zl'];
        $box->amount_PLN = $data['amount_PLN'];
        $box->amount_EUR = $data['amount_EUR'];
        $box->amount_USD = $data['amount_USD'];
        $box->amount_GBP = $data['amount_GBP'];
        $box->comment = $data['comment'];

        $box->time_counted = Carbon::now();

        $box->save();

        //Wyczyść sesję
        \Session::remove('boxData');

        Log::info(Auth::user()->name . " przekazał/a puszkę: " . $boxID . " do zatwierdzenia");
        //Zwróć info że puszka zapisana
        return redirect()->route('box.find')
            ->with('message', 'Puszka '. $box->id . ' została przesłana do zatwierdzenia. ('.$box->amount_PLN.'zł)');
    }

    //Potwierdź puszkę (dla administratora)
    public function getVerifyList(){
        $boxesToConfirm = CharityBox::with('collector')   // remove n+1 problem
            ->where('is_given_to_collector', '=', true)
            ->where('is_counted', '=', true)
            ->where('is_confirmed', '=', false)
            ->get();

        return view('liczymy.box.verifyList')->with('boxes', $boxesToConfirm);
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
    public function postVerify(Request $request, $boxID){
        $box = CharityBox::where('id', '=', $boxID)->first();
        $box->is_confirmed = true;
        $box->user_confirmed_id = Auth::user()->id;
        $box->time_confirmed = Carbon::now();
        $box->save();

        //Drukuj potwierdzenie?
        //TODO
        Log::info(Auth::user()->name . " zatwierdził/a puszkę: " . $box->id);

        return redirect()->route('box.verify.list')->with(
            'message', 'Puszka nr ' . $box->id . ' potwierdzona ('.$box->amount_PLN.'zł)'
        );
    }

    //Wyświeltl wszystkie puszki (dla administratora)
    public function getList(){
        $boxes = CharityBox::with('collector')->get(); // remove n+1 problem

        return view('liczymy.box.list')->with('boxes', $boxes);
    }

    //Wyświeltl puszki, które nie zostały rozliczone (dla administratora)
    public function getListAway(){
        $boxes = CharityBox::with('collector')->where('is_counted', '=', 0)->get(); // remove n+1 problem

        return view('liczymy.box.list')->with('boxes', $boxes);
    }

    //Wyświetl zawartość pojedynczej puszki (dla administratora)
    public function display(Request $request, $boxID){
        $box = CharityBox::where('id', '=', $boxID)->first();

        return view('liczymy.box.display')->with('box', $box);
    }
}
