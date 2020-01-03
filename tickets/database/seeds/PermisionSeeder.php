<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guest = new Permission();
        $guest->name = 'Create tasks';
        $guest->slug = 'create-tasks';
        $guest->save();

        $admin = new Permission();
        $admin->name = 'Manage tasks';
        $admin->slug = 'manage-tasks';
        $admin->save();
    }
}
