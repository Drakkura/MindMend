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
        Schema::create('psikolog', function (Blueprint $table) {
            $table->increments('docid');
            $table->string('docemail', 255)->nullable();
            $table->string('docname', 255)->nullable();
            $table->string('docpassword', 255)->nullable();
            $table->string('doctel', 15)->nullable();
            $table->tinyInteger('specialties')->nullable()->index();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('psikolog');
    }
};
