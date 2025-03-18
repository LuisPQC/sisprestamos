<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $table = 'creditos';

    protected $fillable = [
        'cliente_id',
        'monto_prestado',
        'tasa_interes',
        'modalidad',
        'monto_total',
        'fecha_inicio',
        'fecha_final',
        'estado',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function pagosCredito(){
        return $this->hasMany(PagosCredito::class);
    }
}
