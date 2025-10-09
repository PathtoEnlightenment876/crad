<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('committees', function (Blueprint $table) {
            if (!Schema::hasColumn('committees','adviser_name')) $table->string('adviser_name')->nullable();
            if (!Schema::hasColumn('committees','panel1')) $table->string('panel1')->nullable();
            if (!Schema::hasColumn('committees','panel2')) $table->string('panel2')->nullable();
            if (!Schema::hasColumn('committees','panel3')) $table->string('panel3')->nullable();
            if (!Schema::hasColumn('committees','submission_id')) $table->foreignId('submission_id')->nullable()->constrained('submissions')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('committees', function (Blueprint $table) {
            // you can drop columns if needed (careful in production)
        });
    }
};

