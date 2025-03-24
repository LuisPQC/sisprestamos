<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            width: 80mm; /* Ajustar a 58mm si es necesario */
            margin: 0;
            padding: 2mm;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .text-bold {
            font-weight: bold;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 3px 0;
        }
        .mt-1 {
            margin-top: 3px;
        }
        .mb-1 {
            margin-bottom: 3px;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 15px;
            width: 60%;
        }
        @media print {
            body {
                width: 80mm; /* Ajustar a 58mm si es necesario */
                margin: 0;
                padding: 1mm;
                font-size: 11px;
            }
        }
    </style>
</head>
<body>

<!-- Encabezado -->
<div class="text-center text-bold">
    {{$configuracion->nombre}} <br>
    {{$configuracion->descripcion}} <br>
    {{$configuracion->direccion}} <br>
    {{$configuracion->telefono}} 
</div>

<div class="divider"></div>

<!-- Datos del Cliente -->
<div class="text-bold mb-1">
    CLIENTE:<br>
    {{$credito->cliente->apellidos." ".$credito->cliente->nombres}}<br>
    FECHA: {{date('d/m/Y')}}
</div>

<div class="divider"></div>

<!-- Datos del Préstamo -->
<div class="text-bold">
    PRESTAMOS NO. {{str_pad($credito->id, 3, '0', STR_PAD_LEFT)}}<br>
    MONTO PRESTADO<br>
    {{number_format($credito->monto_prestado, 2)}}<br>
    EN FECHA DE: {{date('d/m/Y', strtotime($credito->created_at))}}<br>
    MODALIDAD: {{strtoupper($credito->modalidad)}}<br>
    TASA: {{$credito->tasa_interes}}%
</div>

<div class="divider"></div>

<!-- Detalle del Pago -->
<div class="text-bold">
    POR PAGO DE : {{strtoupper($pago->criterio)}} <br>
    MONTO PAGADO: {{number_format($pago->monto_pagado, 2)}}<br>
</div>

<div class="divider"></div>

<!-- Nuevo Saldo -->
<div class="text-bold mt-1">
SALDO CAPITAL DESPUÉS DEL PAGO<br>
    {{ $saldoCapitalPendienteFormateado}}<br>
    SALDO INTERÉS DESPUÉS DEL PAGO<br>
    {{ $saldoInteresPendienteFormateado}}
</div>

<!-- Firma -->
 <br>
<div class="signature-line text-center">
    FIRMA
</div>


</body>
</html>