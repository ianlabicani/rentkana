<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'renter', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'landlord', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
