<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        if (config('app.env') == 'local') {
            $this->call(CollectorsSeeder::class);
            $this->call(CharityBoxesSeeder::class);
        }
    }
}
