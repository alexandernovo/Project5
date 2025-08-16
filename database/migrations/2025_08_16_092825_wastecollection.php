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
        Schema::create('wastecollection', function (Blueprint $table) {
            $table->id("wastecollect_id");
            $table->string('barangay')->nullable();
            $table->string('schedule_from')->nullable();
            $table->string('schedule_to')->nullable();
            $table->integer('recyclable')->nullable();
            $table->integer('biodegradable')->nullable();
            $table->integer('nonbio')->nullable();
            $table->integer('specialwaste')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wastecollection');
    }
};
