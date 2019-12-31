<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guest = new Role();
        $guest->title = 'Guest';
        $guest->slug = 'guest';
        $guest->save();

        $admin = new Role();
        $admin->title = 'Admin';
        $admin->slug = 'admin';
        $admin->save();
    }
}
