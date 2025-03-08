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
        Schema::create('case_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('reminder_date');
            //$table->enum('recurring', ['none', 'daily', 'weekly', 'monthly'])->default('none');
            $table->enum('recurring', ['none', 'minute', 'five_minutes', 'daily', 'weekly', 'monthly'])->default('none');

            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->unsignedBigInteger('case_id')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_reminders');
    }
};
