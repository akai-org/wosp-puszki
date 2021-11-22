<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Dodawanie ról użytkowników
        //SuperAdministrator - wszystko
        $roleSuperadmin = new Role();
        $roleSuperadmin->name = 'superadmin';
        $roleSuperadmin->description = 'SuperAdministrator';
        $roleSuperadmin->save();
        //Administrator - zatwierdzanie puszek, dodawanie wolontariuszy
        $roleAdmin = new Role();
        $roleAdmin->name = 'admin';
        $roleAdmin->description = 'Administrator';
        $roleAdmin->save();
        //Collector Coordinator - koordynator wolontariuszy, wydawanie puszek, lista wolontariuszy
        $roleCollectorCoordinator  = new Role();
        $roleCollectorCoordinator->name = 'collectorcoordinator';
        $roleCollectorCoordinator->description = 'Koordynator wolontariuszy';
        $roleCollectorCoordinator->save();
        //Wolontariusz liczący/skrzat (NIE WOLONTARIUSZ Z PUSZKĄ!)
        $roleVolounteer = new Role();
        $roleVolounteer->name = 'volounteer';
        $roleVolounteer->description = 'Wolontariusz liczący';
        $roleVolounteer->save();
    }
}
