<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        try {
            DB::connection('mongodb')->command(['ping' => 1]);
        } catch (\Exception $e) {
            return;
        }

        $this->call([
            AdminUserSeeder::class,
            CategoryEventSeeder::class,
        ]);
    }
}
