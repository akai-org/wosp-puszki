<?php

namespace App\Console\Commands;

use App\CharityBox;
use Illuminate\Console\Command;

class DisplayUncountedCollectors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'display:uncounted';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays uncounted collectors';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $boxes = CharityBox::where('is_counted', false)->with('collector')->orderBy('collectorIdentifier')->get();

        if ($boxes->isEmpty()) {
            $this->info('All boxes have been counted! Great job.');
            return;
        }

        $headers = ['ID', 'Wolontariusz', 'Telefon', 'Wydano o'];

        $data = $boxes->map(function ($box) {
            return [
                'ID'     => $box->collector->identifier,
                'Wolontariusz'   => "{$box->collector->firstName} {$box->collector->lastName}",
                'Telefon'  => $box->collector->phoneNumber,
                'Wydano o'  => $box->time_given,
            ];
        });

        $this->newLine();
        $this->line(' <fg=yellow;options=bold>Uncounted Charity Boxes</> ');
        $this->table($headers, $data);
        $this->newLine();
    }
}
