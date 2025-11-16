<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Lib\BoxOperator\BoxOperator;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;
use PhpOffice\PhpSpreadsheet\Worksheet\Table;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class DataDumpController extends Controller
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
    $lastDumped = Cache::get('lastCsvDump', Carbon::create(1990));
    $file = $this->getFileName($lastDumped, 'csv');
    if ($lastChangedBoxDate->lt($lastDumped)) {// porównujemy date ostatniej zmieniony puszki z datą ostatniego exportu
      $filePath = 'charity_box_exports/' . $file;
      if (Storage::exists($filePath)) {
        return response()->download(storage_path("app/{$filePath}"), $file);
      }
    }
    $data = $bo->getAll();
    $csvData = [];
    $csvData[] = ['ID Wolo', 'Imię i Nazwisko', 'Numer telefonu', 'Godzina oddania', 'Godzina liczenia', 'Godzina potwierdzenia', 'Zebrane PLN', 'Zebrane EUR', 'Zebrane USD', 'Zebrane GBP', "Inne"];
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
    $csvFileName = $this->getFileName($date, 'csv');
    $csvFile = Writer::createFromFileObject(new \SplTempFileObject());
    $csvFile->insertAll($csvData);

    $storagePath = 'charity_box_exports';
    $filePath = $storagePath . '/' . $csvFileName;
    Storage::put($filePath, $csvFile->toString());
    Cache::set('lastCsvDump', $date); //Dodajemy do cache date exportu

    return response()->download(storage_path("app/{$filePath}"), $file);
  }

  /**
   * @OA\Get(
   *      path="/api/charityBoxes/xlsx",
   *      operationId="getCharityBoxesXLSX",
   *      tags={"CharityBoxes"},
   *      summary="Get XLSX with charity boxes",
   *      description="What it says on the box, returns XLSX file",
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
  public function getCharityBoxesXLSX(Request $request)
  {
    $bo = new BoxOperator($request->user()->id);
    $lastChangedBoxDate = $bo->lastChangedBox()->updated_at;
    $lastDumped = Cache::get('lastXlsxDump', Carbon::create(1990));
    $file = $this->getFileName($lastDumped, 'xlsx');
    if ($lastChangedBoxDate->lt($lastDumped)) {// porównujemy date ostatniej zmieniony puszki z datą ostatniego exportu
      $filePath = 'charity_box_exports/' . $file;
      // if (Storage::exists($filePath)) {
      //   return response()->download(storage_path("app/{$filePath}"), $file);
      // }
    }
    $data = $bo->getAll();
    $dataLen = count($data) + 1;
    $columnNames = ['ID Wolo', 'Imię i Nazwisko', 'Numer telefonu', 'Godzina oddania', 'Godzina liczenia', 'Godzina potwierdzenia', 'Zebrane PLN', 'Zebrane EUR', 'Zebrane USD', 'Zebrane GBP', "Inne"];

    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();
    $activeWorksheet->setTitle('Puszki');

    for ($i = 1; $i < count($columnNames) + 1; $i++) {
      $activeWorksheet->setCellValue([$i, 1], $columnNames[$i - 1]);
    }
    foreach ($data as $i => $value) {
      $collectorName = $value->collector->firstName . ' ' . $value->collector->lastName;
      $Y = $i + 2;
      $activeWorksheet->setCellValue("A" . "{$Y}", $value->collectorIdentifier);
      $activeWorksheet->setCellValue("B" . "{$Y}", $collectorName);
      $activeWorksheet->setCellValue("C" . "{$Y}", $value->collector->phoneNumber);
      $activeWorksheet->setCellValue("D" . "{$Y}", $value->time_given);
      $activeWorksheet->setCellValue("E" . "{$Y}", $value->time_counted);
      $activeWorksheet->setCellValue("F" . "{$Y}", $value->time_confirmed);
      $activeWorksheet->setCellValue("G" . "{$Y}", $value->amount_PLN);
      $activeWorksheet->setCellValue("H" . "{$Y}", $value->amount_EUR);
      $activeWorksheet->setCellValue("I" . "{$Y}", $value->amount_USD);
      $activeWorksheet->setCellValue("J" . "{$Y}", $value->amount_GBP);
      $activeWorksheet->setCellValue("K" . "{$Y}", $value->comment);
    }

    $table = new Table("A1:K{$dataLen}", 'Tabela_Puszki');
    $activeWorksheet->addTable($table);

    $columns = str_split("ABCDEFGHIJK");
    foreach ($columns as $column) {
      $activeWorksheet->getColumnDimension($column)->setAutoSize(true);
    }
    $activeWorksheet->calculateColumnWidths();

    $date = Carbon::now();
    $xlsxFileName = $this->getFileName($date, 'xlsx');

    ob_start(); // Trzeba exportować do bufora, bo Writer nie daje opcji pobrania output streamu
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    $xlsxContent = ob_get_contents();
    ob_end_clean();

    $storagePath = 'charity_box_exports';
    $filePath = $storagePath . '/' . $xlsxFileName;
    Storage::put($filePath, $xlsxContent);
    Cache::set('lastXlsxDump', $date); //Dodajemy do cache date exportu

    return response()->download(storage_path("app/{$filePath}"), $file);
  }

  public function getFileName(Carbon $date, string $ext): string
  {
    return 'charity_boxes' . $date->timestamp . '.' . $ext;
  }
}
