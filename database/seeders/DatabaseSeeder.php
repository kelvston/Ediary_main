<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $adminRole = Role::create(['name' => 'admin']);
        $lawyerRole = Role::create(['name' => 'lawyer']);
        $clientRole = Role::create(['name' => 'client']);

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@ediary.com',
            'password' => bcrypt('admin@123'),
            'role_id' => $adminRole->id
        ]);

        $lawyer = User::create([
            'name' => 'Nicodemus Mbukoti',
            'email' => 'mbukoti@ediary.com',
            'password' => bcrypt('Mbukoti@2025'),
            'role_id' => $lawyerRole->id
        ]);
        Settings::create([
            'user_id' => $lawyer->id,
            'notification_preference' => 'email',
            'timezone' => 'Africa/Nairobi',
            'default_reminder_time' => 30
        ]);
    }
}
