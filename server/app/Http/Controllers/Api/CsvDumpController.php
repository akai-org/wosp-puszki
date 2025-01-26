<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lib\BoxOperator\BoxOperator;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class CsvDumpController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic:,name');
        $this->middleware('collectorcoordinator');
    }
    /**
     * @OA\Get(
     *      path="/api/charityBoxes/csv",
     *      operationId="getCharityBoxesCSV",
     *      tags={"CharityBoxes"},
     *      summary="Get CSV with charity boxes",
     *      description="What it says on the box, returns CSV file",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     * )
     */
   public function getCharityBoxesCSV(Request $request)
   {
        $bo = new BoxOperator($request->user()->id);
        $lastChangedBoxDate = $bo->lastChangedBox()->updated_at;
        $lastDumped = Cache::get('lastCsvDump',Carbon::create(1990));
        $file = $this->getFileName($lastDumped);
        if($lastChangedBoxDate->lt($lastDumped)){// porównujemy date ostatniej zmieniony puszki z datą ostatniego exportu
            $filePath = 'charity_box_exports/' . $file;
            if (Storage::exists($filePath)) {
                return response()->download(storage_path("app/{$filePath}"), $file);
            }
        }
        $data = $bo->getAll();
        $csvData = [];
        $csvData[] = ['ID Wolo','Imię i Nazwisko', 'Numer telefonu', 'Godzina oddania','Godzina liczenia','Godzina potwierdzenia', 'Zebrane PLN', 'Zebrane EUR', 'Zebrane USD', 'Zebrane GBP', "Inne"];
        foreach ($data as $row) {
            $collectorName = $row->collector->firstName . ' ' . $row->collector->lastName;
            $csvData[] = [
                $row->collectorIdentifier,
                $collectorName,
                $row->collector->phoneNumber,
                $row->time_given,
                $row->time_counted,
                $row->time_confirmed,
                $row->amount_PLN,
                $row->amount_EUR,
                $row->amount_USD,
                $row->amount_GBP,
                $row->comment
            ];
        }
        $date = Carbon::now();
        $csvFileName = $this->getFileName($date);
        $csvFile = Writer::createFromFileObject(new \SplTempFileObject());
        $csvFile->insertAll($csvData);

        $storagePath = 'charity_box_exports';
        $filePath = $storagePath . '/' . $csvFileName;
        Storage::put($filePath, $csvFile->toString());
        Cache::set('lastCsvDump',$date); //Dodajemy do cache date exportu

        return response()->download(storage_path("app/{$filePath}"), $file);
   }

   public function getFileName(Carbon $date) : string
   {
       return 'charity_boxes'.$date->timestamp.'.csv';
   }
}
