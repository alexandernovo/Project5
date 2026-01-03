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
            $table->string('municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('purok')->nullable();
            $table->string('schedule_from')->nullable();
            $table->string('schedule_to')->nullable();
            $table->decimal('recyclable', 10, 2)->nullable();
            $table->decimal('biodegradable', 10, 2)->nullable();
            $table->decimal('nonbio', 10, 2)->nullable();
            $table->decimal('specialwaste', 10, 2)->nullable();
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
