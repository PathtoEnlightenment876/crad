<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('panel_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('panel_id'); // professor_id acting as panel
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();

            $table->foreign('panel_id')->references('id')->on('professors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('panel_slots');
    }
};
