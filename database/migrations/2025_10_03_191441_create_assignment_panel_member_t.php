<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('assignment_panel_member', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('final_assignment_id');
            $table->unsignedBigInteger('professor_id');
            $table->timestamps();

            $table->foreign('final_assignment_id')->references('id')->on('final_assignments')->onDelete('cascade');
            $table->foreign('professor_id')->references('id')->on('professors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assignment_panel_member');
    }
};
