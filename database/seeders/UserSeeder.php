<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory(1)->create();
        $user = User::query()->where('id', 1)->first();
        $user->syncRoles('superadmin');
        Account::query()->create([
            'name' => 'IPARALYZED',
            'slug' => str()->slug('lparalyzed'),
            'owner_id' => $user->id
        ]);
    }
}
