<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->truncate();
        $input = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'phone' => '12345678888',
            'status' => Admin::ACTIVE,
            'role_id' => 1,
            'password' => Hash::make('123456'),
            'remember_token' => Str::random(10),
        ];
        $admin = Admin::create($input);
        Log::info($admin);
    }
}
