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
            $table->string('ornumber');
            $table->string('association');
            $table->string('model_no');
            $table->string('brand');
            $table->string('serial_no');
            $table->string('lot_no');
            $table->string('requester');
            $table->string('name_other');
            $table->string('status');
            $table->string('type');
            $table->datetime('expiration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
