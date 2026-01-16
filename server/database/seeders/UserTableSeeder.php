<?php

namespace Database\Seeders;

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role:
        $roleSuperadmin = Role::where('name', '=', 'superadmin')->first();
        $roleAdmin = Role::where('name', '=', 'admin')->first();
        $roleVolounteer = Role::where('name', '=', 'volounteer')->first();
        $roleCollectorCoordinator = Role::where('name', '=', 'collectorcoordinator')->first();

        // Dodawanie superadministratora
        $superadmin = new User;
        $superadmin->name = 'superadmin';
        $superadmin->password = Hash::make('zaq12wsx');
        $superadmin->save();
        $superadmin->roles()->attach($roleSuperadmin);
        // Dodawanie administratora
        $admin = new User;
        $admin->name = 'admin';
        $admin->password = Hash::make('zaq12wsx');
        $admin->save();
        $admin->roles()->attach($roleAdmin);
        // Dodawanie koordynatora wolontariuszy
        $collectorCoordinator = new User;
        $collectorCoordinator->name = 'wolokord';
        $collectorCoordinator->password = Hash::make('koordynacja');
        $collectorCoordinator->save();
        $collectorCoordinator->roles()->attach($roleCollectorCoordinator);
        // Dodawanie użytkownika
        // Generowanie 50 użytkowników
        for ($i = 1; $i <= 50; $i++) {
            $volounteer = new User;
            $number = str_pad($i, 2, 0, STR_PAD_LEFT);
            $volounteer->name = 'wosp'.$number;
            $password = 'teamRoksana'.$number;
            $volounteer->password = Hash::make($password);
            echo $volounteer->name.':'.$password.PHP_EOL;
            $volounteer->save();
            $volounteer->roles()->attach($roleVolounteer);
        }

    }
}
