<?php

namespace App\Console\Commands;

use App\CharityBox;
use Illuminate\Console\Command;

class MarkBoxSpecial extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'box:special';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $boxID = $this->ask('Podaj numer puszki do oznaczenia:');

        $box = CharityBox::find($boxID);
        $box->is_special_box = true;
        $box->save();
        $this->info('Puszka oznaczona jako specjalna');
    }
}
