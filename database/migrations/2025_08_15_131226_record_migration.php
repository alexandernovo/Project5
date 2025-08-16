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
        Schema::create('records', function (Blueprint $table) {
            $table->id("record_id");
            $table->integer("client_id");
            $table->string('ornumber')->nullable();
            $table->string('association')->nullable();
            $table->string('model_no')->nullable();
            $table->string('brand')->nullable();
            $table->string('serial_no')->nullable();
            $table->string('lot_no')->nullable();
            $table->string('requester')->nullable();
            $table->string('name_other')->nullable();
            $table->string('status')->nullable();
            $table->string('type')->nullable();
            $table->datetime('expiration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
