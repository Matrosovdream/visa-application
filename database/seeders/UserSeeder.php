<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run()
    {
        $users = [
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => 'MAsp9811!', 'role' => 1],
            ['name' => 'Manager', 'email' => 'manager@gmail.com', 'password' => '123456', 'role' => 2],
        ];

        foreach ($users as $user) {

            $userId = User::firstOrCreate(
                ['email' => $user['email']], // Check by email
                ['name' => $user['name'], 'password' => bcrypt($user['password'])] // Create if not found
            );

            // Assign roles
            $userId->roles()->sync($user['role']);
        }

        $user = User::create([
            'name' => 'Test User', // Replace with desired name
            'email' => 'testuser@example.com', // Replace with desired email
            'password' => Hash::make('123456'), // Securely hash the password
        ]);

    }

}
