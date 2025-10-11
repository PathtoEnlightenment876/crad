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
        Schema::create('defense_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('department');
            $table->string('section');
            $table->string('group_id');
            $table->string('defense_type');
            $table->string('original_defense_type')->nullable();
            $table->unsignedBigInteger('assignment_id')->nullable();
            $table->date('defense_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('set_letter');
            $table->string('status')->default('scheduled');
            $table->json('panel_data')->nullable();
            $table->softDeletes();
            $table->timestamps();
            
            $table->index(['department', 'section', 'defense_type']);
            $table->index(['group_id', 'defense_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('defense_schedules');
    }
};
