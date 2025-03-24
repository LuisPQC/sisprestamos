<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Préstamo</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
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
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 2px 0;
        }
        .table th, .table td {
            padding: 2px;
            border: 1px solid #000;
        }
        .table th {
            background-color: #f0f0f0;
        }
        .logo {
            width: 50px;
            height: auto;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin-top: 10px;
            width: 60%;
        }
        @media print {
            body {
                width: 80mm; /* Ajustar a 58mm si es necesario */
                margin: 0;
                padding: 1mm;
                font-size: 8px;
            }
            .logo {
                width: 40px;
            }
        }
    </style>
</head>
<body>

<table border="0" width="100%">
    <tr>
        <td class="text-center text-bold">
            {{$configuracion->nombre}} <br>
            {{$configuracion->direccion}} <br>
            Tel: {{$configuracion->telefono}}
        </td>
        <td width="20%" class="text-center">
            <img src="{{public_path('storage/'.$configuracion->logo)}}" class="logo" alt="">
        </td>
    </tr>
</table>

<div class="divider"></div>

<p class="text-center text-bold mt-1">PRESTAMO NRO {{str_pad($prestamo->id, 3, '0', STR_PAD_LEFT)}}</p>

<div class="text-bold mb-1">
    CLIENTE: {{$prestamo->cliente->apellidos." ".$prestamo->cliente->nombres}}<br>
    DOCUMENTO: {{$prestamo->cliente->nro_documento}}<br>
    CELULAR: {{$prestamo->cliente->celular}}
</div>

<div class="divider"></div>

<table class="table">
    <tr>
        <td class="text-bold">Monto prestado:</td>
        <td>{{$configuracion->moneda}} {{number_format($prestamo->monto_prestado, 2)}}</td>
    </tr>
    <tr>
        <td class="text-bold">Tasa de interés:</td>
        <td>{{$prestamo->tasa_interes}}%</td>
    </tr>
    <tr>
        <td class="text-bold">Modalidad:</td>
        <td>{{$prestamo->modalidad}}</td>
    </tr>
    <tr>
        <td class="text-bold">Nro de cuotas:</td>
        <td>{{$prestamo->nro_cuotas}}</td>
    </tr>
    <tr>
        <td class="text-bold">Monto total:</td>
        <td>{{$configuracion->moneda}} {{number_format($prestamo->monto_total, 2)}}</td>
    </tr>
    <tr>
        <td class="text-bold">Estado:</td>
        <td>{{$prestamo->estado}}</td>
    </tr>
</table>

<div class="divider"></div>

<p class="text-bold">DETALLE DE CUOTAS:</p>

<table class="table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @php $contador = 1; @endphp
        @foreach($pagos as $pago)
        <tr>
            <td class="text-center">{{$contador++}}</td>
            <td class="text-center">{{date('d/m/Y', strtotime($pago->fecha_pago))}}</td>
            <td class="text-center">{{$configuracion->moneda}} {{number_format($pago->monto_pagado, 2)}}</td>
            <td class="text-center">{{$pago->estado}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="text-center mt-1">
    <br>
    <div class="signature-line" style="text-align: center;">FIRMA</div>
</div>

</body>
</html>