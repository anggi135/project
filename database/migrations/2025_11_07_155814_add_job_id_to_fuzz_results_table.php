<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('fuzz_results', function (Blueprint $table) {
            if (!Schema::hasColumn('fuzz_results', 'job_id')) {
                $table->unsignedBigInteger('job_id')->after('id')->nullable();
                $table->foreign('job_id')
                      ->references('id')
                      ->on('fuzz_jobs')
                      ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('fuzz_results', function (Blueprint $table) {
            if (Schema::hasColumn('fuzz_results', 'job_id')) {
                $table->dropForeign(['job_id']);
                $table->dropColumn('job_id');
            }
        });
    }
};
