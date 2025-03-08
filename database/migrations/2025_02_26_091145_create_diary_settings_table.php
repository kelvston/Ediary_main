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
        Schema::create('diary_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            // Notification Settings
            $table->boolean('email_notifications')->default(true);

            // Language Settings
            $table->string('language', 5)->default('en');

            // Date Format Settings
            $table->string('date_format', 10)->default('Y-m-d');

            // Time Format Settings
            $table->string('time_format', 5)->default('24');

            // Theme Settings
            $table->enum('theme', ['light', 'dark'])->default('light');

            // Font Size Settings
            $table->enum('font_size', ['small', 'medium', 'large'])->default('medium');

            // Custom Background Image
            $table->string('background_image')->nullable();

            // Privacy Settings
            $table->enum('privacy', ['private', 'friends', 'public'])->default('private');

            // Text Formatting Settings
            $table->enum('text_formatting', ['normal', 'bold', 'italic'])->default('normal');

            // Reminder Settings
            $table->boolean('reminders')->default(true);

            // Export Settings
            $table->boolean('export_enabled')->default(true);

            // Multiple Diaries Settings
            $table->boolean('multiple_diaries')->default(false);

            // Cloud Backup Settings
            $table->enum('cloud_backup', ['google_drive', 'dropbox', 'none'])->default('none');

            $table->timestamps();

            // Foreign Key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diary_settings');
    }
};
