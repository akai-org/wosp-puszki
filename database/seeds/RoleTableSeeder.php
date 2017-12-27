<?php

use Illuminate\Database\Seeder;
use App\Role;

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
        //Wolontariusz liczący/skrzat (NIE WOLONTARIUSZ Z PUSZKĄ!)
        $roleVolounteer = new Role();
        $roleVolounteer->name = 'volounteer';
        $roleVolounteer->description = 'Wolontariusz liczący';
        $roleVolounteer->save();
    }
}
