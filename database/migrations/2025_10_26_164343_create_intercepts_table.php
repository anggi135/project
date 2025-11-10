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
        Schema::create('intercepts', function (Blueprint $table) {
            $table->id();
            $table->string('ext_id')->unique();
            $table->string('client_ip')->nullable();
            $table->string('method')->nullable();
            $table->text('url')->nullable();
            $table->json('request_headers')->nullable();
            $table->longText('request_body_base64')->nullable();
            $table->integer('request_body_size')->nullable();
            $table->integer('response_status')->nullable();
            $table->json('response_headers')->nullable();
            $table->longText('response_body_base64')->nullable();
            $table->integer('response_body_size')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intercepts');
    }
};
