<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Collector;

class ImportCollectors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:collectors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import volounteers from csv file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $file = storage_path('app/wolontariusze_utf8.csv');

        $this->info('import:' . $file);
        $contents = file_get_contents($file);

        $reader = Reader::createFromString($contents);
        $reader->setDelimiter(';');

        $reader->setHeaderOffset(0);

        $records = $reader->getRecords();
        $i = 0;
        foreach ($records as $offset => $record) {
            $this->info($record['id_number']);
            $collector = new Collector();
            $exploded = $record['id_number'];
            $exploded = explode('/', $exploded);
            //$this->info();
            $collector->identifier = $exploded[0];
            $exploded = mb_split(' ', $record['fullName']);
            $collector->firstName = $exploded[0];
            $collector->lastName = end($exploded);
            $i++;
            $collector->save();
        }
        $this->info('Dodano rekordów: ' . $i);

    }
}
