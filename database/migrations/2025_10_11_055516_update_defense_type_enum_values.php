<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('defense_type');
        });
        
        Schema::table('submissions', function (Blueprint $table) {
            $table->enum('defense_type', [
                'Pre-Oral', 
                'Final Defense', 
                'Pre-Oral Re-Defense', 
                'Final Defense Re-Defense'
            ])->after('documents');
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->dropColumn('defense_type');
        });
        
        Schema::table('submissions', function (Blueprint $table) {
            $table->enum('defense_type', ['Pre-Oral', 'Final Defense'])->after('documents');
        });
    }
};