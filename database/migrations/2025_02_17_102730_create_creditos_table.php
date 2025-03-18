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
        Schema::create('creditos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            $table->decimal('monto_prestado',10,2);
            $table->decimal('tasa_interes',5,2);
            $table->enum('modalidad',['Diario','Semanal','Quincenal','Mensual']);
            $table->decimal('monto_total',12,2)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_final')->nullable();
            $table->enum('estado',['Pendiente','Pagado','Cancelado'])->default('Pendiente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('creditos');
    }
};
