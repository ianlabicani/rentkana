<?php

namespace Database\Seeders;

use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['id' => Str::uuid(),'name' => 'admin']);
        Role::create(['id' => Str::uuid(),'name' => 'renter']);
        Role::create(['id' => Str::uuid(),'name' => 'landlord']);
    }
}
