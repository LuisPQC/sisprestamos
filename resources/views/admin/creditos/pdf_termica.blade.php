<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
            size: 80mm auto;
        }
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            width: 80mm;
            margin: 10;
            padding: 0;
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
            margin: 10px 20;
        }
        .mt-1 {
            margin-top: 3px;
        }
        .mb-1 {
            margin-bottom: 3px;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 10px; /* Reducido de 15px */
            width: 60%;
        }
        @media print {
            body {
                width: 80mm;
                margin: 0;
                padding: 0;
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
------------------------------------------------------------------------------------

<!-- Datos del Cliente -->
<div class="text-bold mb-1">
    CLIENTE:<br>
    {{$credito->cliente->apellidos." ".$credito->cliente->nombres}}<br>
    FECHA: {{date('d/m/Y')}}
</div>

------------------------------------------------------------------------------------

<!-- Datos del Préstamo -->
<div class="text-bold">
    PRESTAMOS NO. {{str_pad($credito->id, 3, '0', STR_PAD_LEFT)}}<br>
    MONTO PRESTADO<br>
    {{number_format($credito->monto_prestado, 2)}}<br>
    EN FECHA DE: {{date('d/m/Y', strtotime($credito->created_at))}}<br>
    MODALIDAD: {{strtoupper($credito->modalidad)}}<br>
    TASA: {{$credito->tasa_interes}}%
</div>

------------------------------------------------------------------------------------

<!-- Detalle del Pago -->
<div class="text-bold">
    POR PAGO DE : {{strtoupper($pago->criterio)}} <br>
    MONTO PAGADO: {{number_format($pago->monto_pagado, 2)}}<br>
</div>

------------------------------------------------------------------------------------


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