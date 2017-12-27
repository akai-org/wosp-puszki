<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role:
        $roleSuperadmin = Role::where('name', '=', 'superadmin')->first();
        $roleAdmin = Role::where('name', '=', 'admin')->first();
        $roleVolounteer = Role::where('name', '=', 'volounteer')->first();

        //Dodawanie superadministratora
        $superadmin = new User();
        $superadmin->name = 'superadmin';
        $superadmin->password = bcrypt('zaq12wsx');
        $superadmin->save();
        $superadmin->roles()->attach($roleSuperadmin);
        //Dodawanie administratora
        $admin = new User();
        $admin->name = 'admin';
        $admin->password = bcrypt('zaq12wsx');
        $admin->save();
        $admin->roles()->attach($roleAdmin);
        //Dodawanie użytkownika
        $volounteer = new User();
        $volounteer->name = 'wosp01';
        $volounteer->password = bcrypt('zaq12wsx');
        $volounteer->save();
        $volounteer->roles()->attach($roleVolounteer);

    }
}
