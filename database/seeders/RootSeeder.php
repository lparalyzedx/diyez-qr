<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'phone' => '05050298283',
            'password' => bcrypt('password'),
            'remember_token' => Str::random(10),
        ]);

        $user->syncRoles('root');
    }
}
