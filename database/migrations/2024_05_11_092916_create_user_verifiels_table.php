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
        Schema::dropIfExists('user_verifies');
        Schema::create('user_verifies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('token')->nullable()->default(null);
            $table->timestamp('expires_at')->nullable();
            $table->string('email_verify')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_verifiels');
    }
};
