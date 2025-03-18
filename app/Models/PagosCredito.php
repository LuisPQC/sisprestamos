<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagosCredito extends Model
{
    use HasFactory;

    protected $fillable = [
        'credito_id',
        'monto_pagado',
        'fecha_pago',
        'criterio',
    ];

    // Relación con el modelo Credito
    public function credito()
    {
        return $this->belongsTo(Credito::class, 'credito_id');
    }

}
