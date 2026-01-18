<?php

namespace App\Console\Commands;

use App\CharityBox;
use Illuminate\Console\Command;

class DisplayStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:display-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays statistics for the volunteer boxes';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        // 5 biggest boxes
        $biggestBoxes = CharityBox::confirmed()
            ->orderBy('amount_PLN', 'desc')
            ->limit(5)
            ->get(['id', 'amount_PLN']);

        // 5 last boxes with time of confirmation
        $lastBoxes = CharityBox::confirmed()
            ->where('amount_PLN', '>', 0)
            ->orderBy('time_counted', 'desc')
            ->limit(5)
            ->get(['id', 'time_counted']);

        // 5 boxes with biggest time outside (time_counted - time_given) and their amounts
        $biggestTimeOutsideBoxes = CharityBox::confirmed()
            ->orderByRaw('EXTRACT(EPOCH FROM (time_counted - time_given)) DESC')
            ->limit(5)
            ->get(['id', 'time_counted', 'time_given', 'amount_PLN']);

        $statistics = [
            'biggest_boxes' => $biggestBoxes,
            'last_boxes' => $lastBoxes,
            'biggest_time_outside_boxes' => $biggestTimeOutsideBoxes,
        ];

        $this->info((string)json_encode($statistics, JSON_PRETTY_PRINT));
    }
}
