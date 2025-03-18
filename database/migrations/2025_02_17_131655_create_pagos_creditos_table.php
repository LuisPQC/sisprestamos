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
        Schema::create('pagos_creditos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('credito_id');
            $table->foreign('credito_id')->references('id')->on('creditos')->onDelete('cascade');

            $table->decimal('monto_pagado',10,2);
            $table->date('fecha_pago');
            $table->enum('criterio',['interes','capital']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos_creditos');
    }
};
