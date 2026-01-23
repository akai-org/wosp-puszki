<?php

namespace App\Console\Commands;

use App\CharityBox;
use App\Events\DuplicateBoxFound;
use Cache;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class AlertDuplicatedBoxes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alert:duplicatedBoxes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks for potentially duplicated CharityBoxes created since the last run';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastRun = Cache::get('alert:duplicatedBoxes:last_run', Carbon::now()->startOfCentury());
        $now = Carbon::now();
        $this->info('Checking for duplicates created after: '.$lastRun->toDateTimeString());

        $duplicateGroups = DB::table('charity_boxes')
            ->select(['collectorIdentifier', DB::raw('COUNT(*) as count'), DB::raw('MAX(created_at) as latest_creation')])
            ->where('is_counted', false) // or 0, depending on your schema
            ->groupBy('collectorIdentifier')
            ->havingRaw('COUNT(*) >= 2')
            ->havingRaw("MAX(created_at) >= '$lastRun'")
            ->get();

        if ($duplicateGroups->isEmpty()) {
            $this->info('No new duplicates found.');
            Cache::put('alert:duplicatedBoxes:last_run', $now);

            return;
        }

        $this->error('Duplicates found: '.$duplicateGroups->count());

        $duplicateGroups->each(function ($group) {
            $givenBoxes = CharityBox::where('collectorIdentifier', $group->collectorIdentifier)->where('is_counted', false)->get();
            DuplicateBoxFound::dispatch($group->collectorIdentifier, $givenBoxes);
        });

        Cache::put('alert:duplicatedBoxes:last_run', $now);
    }
}
