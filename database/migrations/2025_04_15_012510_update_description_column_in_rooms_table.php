<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Change 'description' column to JSON type
            $table->json('description')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Revert 'description' back to string or text if needed
            $table->text('description')->nullable()->change();
        });
    }
};
