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
            width: 80mm; /* o 58mm según necesidad */
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
            margin: 5px 0;
        }
        .mt-2 {
            margin-top: 5px;
        }
        .mb-2 {
            margin-bottom: 5px;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 20px;
            width: 60%;
        }
        @media print {
            body {
                width: 80mm; /* o 58mm según necesidad */
                margin: 0;
                padding: 2mm;
            }
        }
    </style>
</head>
<body>

<div class="text-center text-bold">
    {{$configuracion->nombre}}<br>
    {{$configuracion->descripcion}} <br>
    {{$configuracion->direccion}} <br>
    {{$configuracion->telefono}}
</div>

<div class="divider"></div>

<div class="text-bold mb-2">
    CLIENTE:<br>
    {{$prestamo->cliente->apellidos." ".$prestamo->cliente->nombres}}<br>
    FECHA: {{date('d/m/Y')}}
</div>

<div class="text-bold">
    PRESTAMOS No. {{str_pad($prestamo->id, 3, '0', STR_PAD_LEFT)}}<br>
    MONTO PRESTADO<br>
    {{number_format($prestamo->monto_prestado, 2)}}<br>
    EN FECHA DE: {{date('d/m/Y', strtotime($prestamo->created_at))}}<br>
    MODALIDAD: {{strtoupper($prestamo->modalidad)}}<br>
    TASA: {{$prestamo->tasa_interes}}%
</div>

<div class="divider"></div>

<div class="text-bold">
    REFERENCIA: <br>
    {{$pago->referencia_pago}} DE {{$prestamo->nro_cuotas}} <br>
    MONTO PAGADO: {{number_format($pago->monto_pagado, 2)}}
</div>

<br>

<div class="divider"></div>
<div class="signature-line text-center">
    FIRMA
</div>

</body>
</html>