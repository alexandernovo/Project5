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
        Schema::create('wastebottle', function (Blueprint $table) {
            $table->id("wastebottle_id");
            $table->string('brgy')->nullable();
            $table->string('municipality')->nullable();
            $table->string('province')->nullable();
            $table->string('purok')->nullable();
            $table->decimal('bottleinkg', 8, 2)->nullable();
            $table->decimal('riceinkg', 8, 2)->nullable();
            $table->decimal('totalinrice', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wastebottle');
    }
};
