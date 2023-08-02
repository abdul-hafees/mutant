<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::where('email', 'admin@gmail.com')->delete();

        $admin = Admin::create([
            'name' => 'Admin',
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt("password"), // password
            'remember_token' => Str::random(10),
        ]);

        //        $admin->assignRole('admin');

    }
}
