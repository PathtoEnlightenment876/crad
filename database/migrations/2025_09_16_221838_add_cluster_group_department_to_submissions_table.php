<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (!Schema::hasColumn('submissions', 'department')) {
                $table->string('department')->nullable()->after('id');
            }
            if (!Schema::hasColumn('submissions', 'cluster')) {
                $table->integer('cluster')->nullable()->after('department');
            }
            if (!Schema::hasColumn('submissions', 'group_no')) {
                $table->integer('group_no')->nullable()->after('cluster');
            }
        });
    }

    public function down(): void
    {
        Schema::table('submissions', function (Blueprint $table) {
            if (Schema::hasColumn('submissions', 'group_no')) {
                $table->dropColumn('group_no');
            }
            if (Schema::hasColumn('submissions', 'cluster')) {
                $table->dropColumn('cluster');
            }
            if (Schema::hasColumn('submissions', 'department')) {
                $table->dropColumn('department');
            }
        });
    }
};
