<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         // Add role_id to users table
         Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id');
        });

        DB::statement("UPDATE users SET role_id = 1 WHERE role_id IS NULL");

        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable(false)->change();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
