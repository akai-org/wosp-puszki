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
        $boxID = $this->ask('Podaj numer WOLONTARIUSZA do oznaczenia:');
        CharityBox::where('collectorIdentifier', $boxID)->update(['is_special_box' => true]);
        $this->info('Puszki wolontariusza zostały oznaczone jako specjalne');
    }
}
