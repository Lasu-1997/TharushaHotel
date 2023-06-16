<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SystemCore\Entities\SitePreference;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);
        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
        ]);
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        $admin->assignRole($adminRole);
        $user->assignRole($userRole);

        SitePreference::create([
            'about_us' => '<p><strong id="docs-internal-guid-b5e64ffb-7fff-e21b-55ff-54b9c499c80e">The breathtaking sea side paradise destination at the heart of Unawatuna, all the magical and mythical destinations are just a few miles away.</strong></p>',
            'mission_vision' => '<p><strong id="docs-internal-guid-c8020e50-7fff-2a7e-82ad-eec7e5025559">For over X years we have provided luxury bedrooms and comfy stationary for many clients and we are proud of that. Welcome to Saffron your holiday paradise stay.</strong></p>',
            'address_line_1' => 'Address Line 1',
            'address_line_2' => 'Address Line 2',
            'address_line_3' => 'Address Line 3',
            'phone' => '+94-123456789',
            'email' => 'email@email.com',
        ]);
    }
}
