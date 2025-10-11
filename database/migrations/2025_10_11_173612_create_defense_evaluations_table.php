<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('defense_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('cluster');
            $table->string('group_id'); // A1, A2, B1, etc.
            $table->enum('defense_type', ['PRE-ORAL', 'FINAL DEFENSE', 'REDEFENSE']);
            $table->string('redefense_type')->nullable(); // PRE-ORAL or FINAL DEFENSE for redefense
            $table->enum('result', ['Passed', 'Redefense', 'Failed']);
            $table->text('feedback')->nullable();
            $table->timestamps();
            
            $table->index(['department', 'cluster', 'group_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defense_evaluations');
    }
};
