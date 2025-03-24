<?php

namespace App\Http\Controllers;

use App\Models\Credito;
use App\Models\PagosCredito;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PagosCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'credito_id' => 'required|exists:creditos,id',
            'monto_pagado' => 'required|numeric|min:0.01',
            'fecha_pago' => 'required|date',
            'criterio' => 'required|in:interes,capital',
        ]);

        $credito = Credito::where('id',$request->credito_id)->first();

        $totalPagadoCapital = PagosCredito::where('credito_id', $credito->id)
            ->where('criterio', 'capital')
            ->sum('monto_pagado') ?? 0; // Asegurar que no sea NULL


        
        if ( ((float)$credito->monto_prestado) === ((float)$totalPagadoCapital+$request->monto_pagado) ) {
            //echo "es igual";
            $pagoCredito = PagosCredito::create([
                'credito_id' => $request->credito_id,
                'monto_pagado' => $request->monto_pagado,
                'fecha_pago' => $request->fecha_pago,
                'criterio' => $request->criterio,
            ]);

            $credito->fecha_final = $request->fecha_pago;
            $credito->estado = 'Pagado';
            $credito->save();
    
            return redirect()->back()
                ->with('mensaje','Se registro el pago de la manera correcta')
                ->with('icono','success');
        } else {
            //echo "no es igual";
            $pagoCredito = PagosCredito::create([
                'credito_id' => $request->credito_id,
                'monto_pagado' => $request->monto_pagado,
                'fecha_pago' => $request->fecha_pago,
                'criterio' => $request->criterio,
            ]);
    
            return redirect()->back()
                ->with('mensaje','Se registro el pago de la manera correcta')
                ->with('icono','success');

        }

    
    }

    /**
     * Display the specified resource.
     */
    public function show(PagosCredito $pagosCredito)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PagosCredito $pagosCredito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PagosCredito $pagosCredito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pago = PagosCredito::find($id);
        $pago->delete();

        return redirect()->back()
            ->with('mensaje','Se elimino el pago del cliente de la manera correcta')
            ->with('icono','success');
    }
}
