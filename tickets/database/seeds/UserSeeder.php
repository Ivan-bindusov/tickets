<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
use App\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $guest = Role::where('slug', 'guest')->first();
        $admin = Role::where('slug', 'admin')->first();
        $guestPermission = Permission::where('slug', 'create-tasks')->first();
        $adminPermission = Permission::where('slug', 'manage-tasks')->first();

        $user1 = new User();
        $user1->name = 'Jon Deer';
        $user1->email = 'john.deer@mail.ru';
        $user1->password = bcrypt('secret');
        $user1->save();
        $user1->roles()->attach($guest);
        $user1->permissions()->attach($guestPermission);

        $user1 = new User();
        $user1->name = 'Mike Leo';
        $user1->email = 'mike.leo@mail.ru';
        $user1->password = bcrypt('secret');
        $user1->save();
        $user1->roles()->attach($admin);
        $user1->permissions()->attach($adminPermission);
    }
}
