<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CharityBox;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use App\Utils\MoneyCounter\MoneyCounter;
use App\Utils\Money;

class CsvDumpController extends Controller
{
   public function getDataForCSV()
   {
      $data = CharityBox::with('collector')
      ->select('id','collector_id','time_given','time_counted','amount_PLN','amount_EUR','amount_USD','amount_GPB')
      ->get();
      $csvData = [];
      $csvData[] = ['ID puszki','Wolontariusz','Godzina oddania','Godzina liczenia','Kwota w złotówkach'];
   

      foreach ($data as $row) {
         $collectorName = $row->collector->firstName . ' ' . $row->collector->lastName;
         $csvData[] = [
            $row->id,
            $collectorName,
            $row->time_given,
            $row->time_counted,
            $row->amount_PLN,
         ];
      }

      $csvFileName = 'charity_boxes.csv';
      $csvFile = Writer::createFromFileObject(new \SplTempFileObject());
      $csvFile->insertAll($csvData);

      $storagePath = 'charity_box_exports';
      $filePath = $storagePath . '/' . $csvFileName;

      Storage::put($filePath, $csvFile->toString());
      $downloadLink = route('api.api.box.download-csv', ['file' => $csvFileName]);

      return "$downloadLink";
   }

   public function downloadCharityBoxCSV($file)
   {
      $filePath = 'charity_box_exports/' . $file;

      if (Storage::exists($filePath)) {
         return response()->download(storage_path("app/{$filePath}"), $file);
      } 
      else {
         abort(404, 'File not found');
      }
   }
}
