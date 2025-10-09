<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('committees', function (Blueprint $table) {
        $table->string('adviser_name')->nullable();
        $table->string('panel1')->nullable();
        $table->string('panel2')->nullable();
        $table->string('panel3')->nullable();
    });
}

public function down()
{
    Schema::table('committees', function (Blueprint $table) {
        $table->dropColumn(['adviser_name', 'panel1', 'panel2', 'panel3']);
    });
}

};
