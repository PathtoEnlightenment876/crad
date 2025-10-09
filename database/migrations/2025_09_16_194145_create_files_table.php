<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path');
            $table->string('department');
            $table->integer('cluster');
            $table->integer('group_no');
            $table->string('status')->default('Pending');
            $table->text('feedback')->nullable();
            $table->unsignedBigInteger('user_id'); // student who uploaded
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void {
        Schema::dropIfExists('files');
    }
};
