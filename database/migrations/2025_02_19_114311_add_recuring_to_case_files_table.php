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
        Schema::table('cases', function (Blueprint $table) {
            $table->string('recurring')->nullable()->after('status');
            $table->string('judge')->nullable()->after('recurring');
            $table->boolean('notification')->nullable()->after('judge');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->string('recurring')->nullable()->after('status');
            $table->string('judge')->nullable()->after('recurring');
            $table->boolean('notification')->nullable()->after('judge');
        });
    }
};
