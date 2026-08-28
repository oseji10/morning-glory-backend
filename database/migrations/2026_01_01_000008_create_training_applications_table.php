<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('qualification')->nullable();
            $table->string('preferred_cohort')->nullable();
            $table->string('referral_source')->nullable();
            $table->text('motivation')->nullable();
            $table->string('status')->default('pending'); // pending | reviewed | accepted | enrolled | rejected
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_applications');
    }
};
