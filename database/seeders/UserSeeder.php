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
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => '123456', 'role' => 1],
            ['name' => 'Manager', 'email' => 'manager@gmail.com', 'password' => '123456', 'role' => 2],
        ];

        foreach ($users as $userData) {

            $user = User::firstOrCreate(
                ['email' => $userData['email']], // Check by email
                ['name' => $userData['name'], 'password' => Hash::make($userData['password'])] // Create if not found
            );

            // It fixes a bug
            $user->password = Hash::make($userData['password']);
            $user->save();

            // Assign roles
            $user->roles()->sync($userData['role']);
        }

        $user = User::create([
            'name' => 'Test User', // Replace with desired name
            'email' => 'testuser@example.com', // Replace with desired email
            'password' => Hash::make('123456'), // Securely hash the password
        ]);

    }

}
