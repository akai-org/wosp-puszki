<?php

namespace App\Http\Controllers\Api;

use App\CharityBox;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use App\Utils\CurrencyEnum;
use Money\Currency;
use App\Utils\Money;
use App\Utils\RatesConverter\Converters\ConvertEurToPln;
use App\Utils\RatesConverter\Converters\ConvertGbpToPln;
use App\Utils\RatesConverter\Converters\ConvertUsdToPln;
use App\Utils\RatesFetcherFactory;

class CsvDumpController extends Controller
{
   public function getDataForCSV()
   {
      $data = CharityBox::with('collector')
      ->select('id','collector_id','time_given','time_counted','amount_PLN','amount_EUR','amount_USD','amount_GBP')
      ->get();
      $csvData = [];
      $csvData[] = ['ID puszki','Wolontariusz','Godzina oddania','Godzina liczenia','Kwota w złotówkach'];
      $currencies = [
         'PLN' => new Currency(CurrencyEnum::PLN_NAME->value),
         'EUR' => new Currency(CurrencyEnum::EUR_NAME->value),
         'USD' => new Currency(CurrencyEnum::USD_NAME->value),
         'GBP' => new Currency(CurrencyEnum::GBP_NAME->value),
      ];

      foreach ($data as $row) {
         $money = [
            'PLN' => new Money($row->amount_PLN * 100,$currencies['PLN']),//liczymy na gorszach
            'EUR' => new Money($row->amount_EUR * 100,$currencies['EUR']),
            'USD' => new Money($row->amount_USD * 100,$currencies['USD']),
            'GBP' => new Money($row->amount_GBP * 100,$currencies['GBP']),
         ];

         $rates = RatesFetcherFactory::config()::build();
         $pln = $money['PLN'];
         $eur = ConvertEurToPln::create($money['EUR'], $rates);
         $usd = ConvertUsdToPln::create($money['USD'], $rates);
         $gbp = ConvertGbpToPln::create($money['GBP'], $rates);
         
         $total = array_sum([
            $pln->getMoney()->getAmount(),
            $usd->convert()->getMoney()->getAmount(),
            $eur->convert()->getMoney()->getAmount(),
            $gbp->convert()->getMoney()->getAmount(),
         ]);
         $collectorName = $row->collector->firstName . ' ' . $row->collector->lastName;
         $csvData[] = [
            $row->id,
            $collectorName,
            $row->time_given,
            $row->time_counted,
            $total/100, //wrzucamy w złotówkach nie w groszach
         ];
      }

      $csvFileName = 'charity_boxes.csv';
      $csvFile = Writer::createFromFileObject(new \SplTempFileObject());
      $csvFile->insertAll($csvData);

      $storagePath = 'charity_box_exports';
      $filePath = $storagePath . '/' . $csvFileName;

      Storage::put($filePath, $csvFile->toString());
      $downloadLink = route('api.api.box.download-csv', ['file' => $csvFileName]);

      return $downloadLink;
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
