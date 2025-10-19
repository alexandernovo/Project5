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

            $table->string('ctpo')->nullable();
            $table->string('brgy_cert')->nullable();
            $table->string('orno_check')->nullable();
            $table->string('cr_check')->nullable();
            $table->string('tax_check')->nullable();

            $table->datetime('expiration')->nullable();
            $table->datetime('date_renewal')->nullable();
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
