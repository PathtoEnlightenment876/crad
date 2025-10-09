<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('assignment_panels', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assignment_id')->constrained()->onDelete('cascade');
        $table->foreignId('panel_id')->constrained('panels')->onDelete('cascade');
        $table->string('availability')->nullable();
        $table->string('role')->default('Panel Member');
        $table->string('expertise')->nullable();
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};
