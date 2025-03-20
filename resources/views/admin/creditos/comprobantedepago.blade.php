<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de pago</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px; /* Tamaño de fuente más pequeño */
            width: 80mm; /* Ancho del comprobante */
            margin: 0 auto; /* Centrar el contenido */
            padding: 5px; /* Espaciado interno */
        }
        .table {
            width: 100%;
            margin-bottom: 5px; /* Espaciado reducido */
            border-collapse: collapse;
        }
        .tables {
            width: 100%;
            margin-bottom: 5px; /* Espaciado reducido */
        }
        .table th, .table td {
            padding: 2px; /* Espaciado reducido */
            border: 1px solid #000;
        }
        .table th {
            background-color: #f0f0f0; /* Color de fondo para encabezados */
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .logo {
            width: 50px;
            height: auto;
        }
        hr {
            border: 0.5px solid #000;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<table class="tables">
    <tr style="text-align: center">
        <td>
            <img src="{{public_path('storage/'.$configuracion->logo)}}" class="logo" alt="logo"> <br>
            {{$configuracion->nombre}} <br>
            {{$configuracion->descripcion}} <br>
            {{$configuracion->direccion}} <br>
              </td>
        <td width="60px"></td>
        <td style="text-align: center">
            <b>Nro de pago: </b>{{$pago->id}} <br>
            <h3>ORIGINAL</h3>
        </td>
    </tr>
</table>

<p class="text-center"><strong><u>COMPROBANTE DE PAGO</u></strong></p>

<strong>Datos del cliente:</strong>
<hr>

<table class="table">
    <tr>
        <td><strong>Fecha:</strong> {{ $fecha_literal }}</td>
        <td><strong>Nro de documento:</strong> {{ $cliente->nro_documento }}</td>
    </tr>
    <tr>
        <td colspan="2"><strong>Señor(es):</strong> {{ $cliente->apellidos." ".$cliente->nombres }}</td>
    </tr>
</table>

<hr>
<strong>Datos del pago:</strong>
<hr>

<table class="table">
    <tr>
        <th>Nro</th>
        <th>Detalle</th>
        <th>Monto pagado</th>
    </tr>
    <tr>
        <td class="text-center">1</td>
        <td>
            <strong>Por pago de:</strong> {{ $pago->criterio }} <br>
            {{ $pago->referencia_pago }}
        </td>
        <td class="text-center">{{ $configuracion->moneda }}. {{ $pago->monto_pagado }}</td>
    </tr>
</table>

<br>

<table class="tables">
    <tr>
        <td class="text-center">
            <strong>__________________________</strong> <br>
            {{ $configuracion->nombre }} <br>
            Usuario: {{ Auth::user()->name }}
        </td>
        <td class="text-center">
            <strong>__________________________</strong> <br>
            Cliente <br>
            {{ $cliente->apellidos." ".$cliente->nombres }}
        </td>
    </tr>
</table>
<br>
<hr>
<br>
<table class="tables">
    <tr style="text-align: center">
        <td>
            <img src="{{public_path('storage/'.$configuracion->logo)}}" class="logo" alt="logo"> <br>
            {{$configuracion->nombre}} <br>
            {{$configuracion->descripcion}} <br>
            {{$configuracion->direccion}} <br>
              </td>
        <td width="60px"></td>
        <td style="text-align: center">
            <b>Nro de pago: </b>{{$pago->id}} <br>
            <h3>COPIA</h3>
        </td>
    </tr>
</table>

<p class="text-center"><strong><u>COMPROBANTE DE PAGO</u></strong></p>

<strong>Datos del cliente:</strong>
<hr>

<table class="table">
    <tr>
        <td><strong>Fecha:</strong> {{ $fecha_literal }}</td>
        <td><strong>Nro de documento:</strong> {{ $cliente->nro_documento }}</td>
    </tr>
    <tr>
        <td colspan="2"><strong>Señor(es):</strong> {{ $cliente->apellidos." ".$cliente->nombres }}</td>
    </tr>
</table>

<hr>
<strong>Datos del pago:</strong>
<hr>

<table class="table">
    <tr>
        <th>Nro</th>
        <th>Detalle</th>
        <th>Monto pagado</th>
    </tr>
    <tr>
        <td class="text-center">1</td>
        <td>
            <strong>Por pago de:</strong> {{ $pago->criterio }} <br>
            {{ $pago->referencia_pago }}
        </td>
        <td class="text-center">{{ $configuracion->moneda }}. {{ $pago->monto_pagado }}</td>
    </tr>
</table>

<br>

<table class="tables">
    <tr>
        <td class="text-center">
            <strong>__________________________</strong> <br>
            {{ $configuracion->nombre }} <br>
            Usuario: {{ Auth::user()->name }}
        </td>
        <td class="text-center">
            <strong>__________________________</strong> <br>
            Cliente <br>
            {{ $cliente->apellidos." ".$cliente->nombres }}
        </td>
    </tr>
</table>
</body>
</html>