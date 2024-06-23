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
        Schema::create('patient', function (Blueprint $table) {
            $table->increments('pid');
            $table->string('pemail', 255)->nullable();
            $table->string('pname', 255)->nullable();
            $table->string('ppassword', 255)->nullable();
            $table->string('paddress', 255)->nullable();
            $table->date('pdob')->nullable();
            $table->string('ptel', 15)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};
