<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('id');
        });
        
        Schema::table('submissions', function (Blueprint $table) {
            $table->id()->first();
        });
    }

    public function down(): void
    {
        // Cannot reverse this migration safely
    }
};