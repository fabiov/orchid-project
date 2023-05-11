<?php
declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => null,
            'password' => '$2y$10$D55aEwiL8jLPvNEKVzrvi.1ZGg0PZY8T1glDRqGIoKMvyRRHL7To.',
            'remember_token' => '',
            'created_at' => '2023-05-11 20:31:12',
            'updated_at' => '2023-05-11 20:31:12',
            'permissions' => '{"platform.index":true,"platform.systems.roles":true,"platform.systems.users":true,"platform.systems.attachment":true}',
        ]);
    }
}
