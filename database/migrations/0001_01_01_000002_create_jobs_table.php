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
        // Laravel queue tables
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
        });

        // Fuzzing tables
        Schema::create('fuzz_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('target');
            $table->text('scope_regex')->nullable();
            $table->string('wordlist_name')->nullable();
            $table->text('wordlist_path')->nullable();
            $table->integer('concurrency')->default(5);
            $table->float('rate_limit')->default(2.0);
            $table->boolean('respect_robots')->default(true);
            $table->enum('status',['pending','running','paused','finished','failed','stopped'])->default('pending');
            $table->json('meta')->nullable();
            $table->timestamps();
        });

        Schema::create('fuzz_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fuzz_job_id')->constrained('fuzz_jobs')->cascadeOnDelete();
            $table->string('url');
            $table->integer('status')->nullable();
            $table->integer('length')->nullable();
            $table->text('snippet')->nullable();
            $table->text('headers')->nullable();
            $table->text('matched_word')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuzz_results');
        Schema::dropIfExists('fuzz_jobs');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('jobs');
    }
};
