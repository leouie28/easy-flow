<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workspace;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Mark Test',
            'email' => 'user@test.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123'),
            'role_id' => 2
        ]);

        $workspace = Workspace::create([
            'name' => "$user->name Workspace",
            'description' => 'Default workspace'
        ]);
        $workspace->users()->attach($user, ['role' => 'owner', 'active' => true]);

        $workspace2 = Workspace::create([
            'name' => "$user->name(2) Workspace",
            'description' => 'Default workspace'
        ]);
        $workspace2->users()->attach($user, ['role' => 'owner']);

        // User::create([
        //     'name' => 'Mark Test 2',
        //     'email' => 'user2@test.com',
        //     'password' => Hash::make('123'),
        //     'role_id' => 2
        // ]);

        User::create([
            'name' => 'Test 2',
            'email' => 'admin@test.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('123'),
            'role_id' => 1
        ]);
    }
}
