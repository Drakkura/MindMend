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
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('scheduleid');
            $table->string('docid', 255)->nullable()->index();
            $table->string('title', 255)->nullable();
            $table->date('scheduledate')->nullable();
            $table->time('scheduletime')->nullable();
            $table->smallInteger('nop')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule');
    }
};
