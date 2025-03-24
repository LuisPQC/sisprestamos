<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Credito;
use App\Models\PagosCredito;
use App\Models\Configuracion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $creditos = Credito::all();
        return view('admin.creditos.index', compact('creditos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('admin.creditos.create',compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'monto_prestado' => 'required|numeric|min:0.01',
            'tasa_interes' => 'required|numeric|min:0|max:100',
            'modalidad' => 'required|in:Semanal,Quincenal,Diario,Mensual',
            'fecha_inicio' => 'required|date',
        ]);
    
        $credito = Credito::create([
            'cliente_id' => $request->cliente_id,
            'monto_prestado' => $request->monto_prestado,
            'tasa_interes' => $request->tasa_interes,
            'modalidad' => $request->modalidad,
            'fecha_inicio' => $request->fecha_inicio,
            'estado' => 'Pendiente',
        ]);

        return redirect()->route('admin.creditos.index')
        ->with('mensaje','Se registro el credito del cliente de la manera correcta')
        ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $credito = Credito::findOrFail($id);

    // Obtener pagos según el criterio (interés y capital)
    $pagos_interes = PagosCredito::where('credito_id', $credito->id)
        ->where('criterio', 'interes')
        ->get();
    $pagos_capital = PagosCredito::where('credito_id', $credito->id)
        ->where('criterio', 'capital')
        ->get();

    $fechaInicio = Carbon::parse($credito->fecha_inicio);
    $fechaActual = Carbon::now();

    // Calculamos la cantidad de períodos según la modalidad
    $diferencia = match ($credito->modalidad) {
        'Diario'    => max(1, $fechaInicio->diffInDays($fechaActual)), // Mínimo 1 día
        'Semanal'   => max(1, $fechaInicio->diffInWeeks($fechaActual)), // Mínimo 1 semana
        'Quincenal' => max(1, floor($fechaInicio->diffInDays($fechaActual) / 15)), // Mínimo 1 quincena
        'Mensual'   => max(1, $fechaInicio->diffInMonths($fechaActual)), // Mínimo 1 mes
        default     => throw new \Exception("Modalidad no válida"),
    };

    // Sumar pagos de interés y capital
    $totalPagadoInteres = PagosCredito::where('credito_id', $credito->id)
        ->where('criterio', 'interes')
        ->sum('monto_pagado');

    $totalPagadoCapital = PagosCredito::where('credito_id', $credito->id)
        ->where('criterio', 'capital')
        ->sum('monto_pagado');

    // Calcular saldo pendiente de capital
    $saldoCapitalPendiente = max(0, $credito->monto_prestado - $totalPagadoCapital);

    // Convertir la tasa de interés a decimal y ajustar para la modalidad diaria
    $tasaInteresDecimal = $credito->tasa_interes / 100;

    if ($credito->modalidad === 'Diario') {
        // Si la tasa es anual, convertir a diaria
        $tasaInteresDecimal = ($tasaInteresDecimal * 12) / 365;
    }

    // Calcular intereses sobre el saldo pendiente del capital
    $intereses = $saldoCapitalPendiente * $tasaInteresDecimal * $diferencia;
    $interesesCalculados = number_format($intereses, 2);

    // Calcular saldo pendiente de intereses
    $saldoInteresPendiente = max(0, $intereses - $totalPagadoInteres);
    $saldoInteresPendienteFormateado = number_format(round($saldoInteresPendiente, 1), 2);

    // Formateo de valores
    $saldoCapitalPendienteFormateado = number_format(round($saldoCapitalPendiente, 1), 2);
    $fechaInicioFormato = $fechaInicio->format('d-m-Y');
    $fechaActualFormato = $fechaActual->format('d-m-Y');

    return view('admin.creditos.show', compact(
        'credito', 
        'pagos_interes', 
        'pagos_capital',
        'interesesCalculados', 
        'totalPagadoInteres',
        'totalPagadoCapital', 
        'saldoInteresPendienteFormateado',
        'saldoCapitalPendienteFormateado',
        'fechaInicioFormato', 
        'fechaActualFormato'
    ));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credito $credito)
    {
        //
    }
    
    public function comprobantedepago($id, $saldoCapitalPendienteFormateado, $saldoInteresPendienteFormateado){

        $pago = PagosCredito::find($id);
        $credito = Credito::where('id',$pago->credito_id)->first();
        $cliente = Cliente::where('id',$credito->cliente_id)->first();
        $fecha_cancelado = $pago->fecha_pago;
        $timestamp = strtotime($fecha_cancelado);
        $dia = date('j',$timestamp);
        $mes = date('F',$timestamp);
        $ano = date('Y',$timestamp);

        

        $meses = [
            'January' => 'enero',
            'February' => 'febrero',
            'March' => 'marzo',
            'April' => 'abril',
            'May' => 'mayo',
            'June' => 'junio',
            'July' => 'julio',
            'August' => 'agosto',
            'September' => 'septiembre',
            'October' => 'octubre',
            'November' => 'noviembre',
            'December' => 'diciembre',
        ];

        $mes_espanol = $meses[$mes];

        $fecha_literal = $dia." de ".$mes_espanol." de ".$ano;

        $configuracion = Configuracion::latest()->first();
        $pdf = PDF::loadView('admin.creditos.comprobantedepago',compact('pago','configuracion','fecha_literal','credito','cliente'
    , 'saldoCapitalPendienteFormateado', 'saldoInteresPendienteFormateado'));
        return $pdf->stream();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Credito $credito)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Credito::destroy($id);
        return redirect()->route('admin.creditos.index')
            ->with('mensaje','Se elimino al cliente de la manera correcta')
            ->with('icono','success');
    }
}
