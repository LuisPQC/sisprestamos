@extends('adminlte::page')

@section('content_header')
<h1><b>Créditos/Datos del crédito</b></h1>
<hr>
@stop

@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos del cliente</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <i class="fas fa-id-card"></i> {{$credito->cliente->nro_documento}} <br><br>
                            <i class="fas fa-user"></i> {{$credito->cliente->apellidos." ".$credito->cliente->nombres}} <br><br>
                            <i class="fas fa-calendar"></i> {{$credito->cliente->fecha_nacimiento}} <br><br>
                            <i class="fas fa-user-check"></i> {{$credito->cliente->genero}} <br><br>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <i class="fas fa-envelope"></i> {{$credito->cliente->email}} <br><br>
                            <i class="fas fa-phone"></i> {{$credito->cliente->celular}} <br><br>
                            <i class="fas fa-phone"></i> {{$credito->cliente->ref_celular}} <br><br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-outline card-info">
            <!-- /.card-header -->
            <div class="card-header">
            <h3 class="card-title">Datos del capital</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <td><b>Nro</b></td>
                                    <td><b>Fecha de pago</b></td>
                                    <td><b>Monto</b></td>
                                    <td><b>Accion</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagos_capital as $pago)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$pago->fecha_pago}}</td>
                                    <td>{{$pago->monto_pagado}}</td>
                                    <td><a href="{{url('/admin/creditos/comprobantedepago',$pago->id)}}" class="btn btn-warning btn-sm" title="Imprimir Comprobante">
                                        <i class="fas fa-print"></i></a></td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2"><b>Total pagado en capital</b></td>
                                    <td><b>{{ $totalPagadoCapital }}</b></td>   
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos del crédito</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <b>Monto Inicial del préstamo</b> <br>
                        <i class="fas fa-money-bill-wave"></i> <b style="color:green;font-size:20pt">{{$credito->monto_prestado}}</b> <br><br>
                    </div>
                    <div class="col-md-6">
                        <b>Monto Saldo del préstamo</b> <br>
                        <i class="fas fa-money-bill-wave"></i> <b style="color:green;font-size:20pt">{{$saldoCapitalPendienteFormateado}}</b> <br><br>
                    </div>
                </div>
                <p>
                    <b>Tasa de interés</b> <br>
                    <i class="fas fa-percentage"></i> {{$credito->tasa_interes}} <br><br>
                    <b>Modalidad</b> <br>
                    <i class="fas fa-calendar-alt"></i> {{$credito->modalidad}} <br><br>
                    <hr>
                    <b>Interés generado</b> <br>
                    <i class="fas fa-calendar"></i> <b style="color:red;font-size:12pt">Del {{$fechaInicioFormato}} al {{$fechaActualFormato}}</b> <br><br>
                    <i class="fas fa-money-bill-wave"></i> <b style="color:green;font-size:20pt">{{$saldoInteresPendienteFormateado}}</b>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Datos de los intereses</h3>
                <!-- /.card-tools -->
                <div class="card-tools">
                    <!-- Button trigger modal -->
                    @if(!($credito->estado == "Pagado"))
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
                        Pagar
                    </button>
                    @endif
                    
                
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #007bff;color:white">
                                    <h5 class="modal-title" id="exampleModalLabel">Realizar pago</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('/admin/creditos/pagos')}}" method="post">
                                        @csrf
                                        <input type="text" name="credito_id" value="{{$credito->id}}" hidden>
                                        <div class="form-group">
                                            @if($saldoInteresPendienteFormateado == "0.00")
                                            <label for="monto_pagado">Monto capital pagado</label>
                                            <input type="text" class="form-control" name="monto_pagado" id="monto_pagado_capital" required>
                                            @else
                                                <label for="monto_pagado">Monto pagado</label>
                                                <input type="text" class="form-control" name="monto_pagado" id="monto_pagado" required>
                                            @endif
                                            
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="">Fecha de prestamo</label>
                                            <input type="date" id="fecha_prestamo" name="fecha_pago" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" readonly>
                                            @error('fecha_inicio')
                                            <small style="color: red">{{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="criterio">Criterio</label>
                                            <select name="criterio" id="criterio" class="form-control">
                                                @if($saldoInteresPendienteFormateado == "0.00")
                                                    <option value="capital">Capital</option>
                                                @else
                                                    <option value="interes">Interes</option>
                                                @endif
                                            </select>
                                        </div>

                                        <hr>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Registrar</button>

                                    </form>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th style="text-align: center">Nro</th>
                                    <th style="text-align: center">Fecha de pago</th>
                                    <th style="text-align: center">Monto</th>
                                    <th style="text-align: center">Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagos_interes as $pago)
                                <tr>
                                    <td style="text-align: center">{{$loop->iteration}}</td>
                                    <td style="text-align: center">{{$pago->fecha_pago}}</td>
                                    <td style="text-align: center">{{$pago->monto_pagado}}</td>
                                    <td style="text-align: center"><a href="{{url('/admin/creditos/comprobantedepago',$pago->id)}}" class="btn btn-warning btn-sm" title="Imprimir Comprobante">
                                        <i class="fas fa-print"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tr>
                                <td colspan="2" style="text-align: center"><b>Total pagado en interes</b></td>
                                <td style="text-align: center"><b>{{ $totalPagadoInteres }}</b></td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>

        </div>
        <!-- /.card -->
    </div>
    
</div>
@stop

@section('js')
<script>
$(document).ready(function () {
    $('#monto_pagado').keyup(function () {
        var monto = parseFloat($(this).val()) || 0;
        var saldoInteres = parseFloat('{{ $saldoInteresPendienteFormateado }}'.replace(/[^0-9.]/g, '')) || 0;
        if (monto > saldoInteres) {
            alert('El monto ingresado es mayor al saldo pendiente');
            $(this).val('');
        }
    });

    $('#monto_pagado_capital').keyup(function () {
        var monto2 = parseFloat($(this).val()) || 0;
        var saldoCapital = parseFloat('{{ $saldoCapitalPendienteFormateado }}'.replace(/[^0-9.]/g, '')) || 0;
        if (monto2 > saldoCapital) {
            alert('El monto ingresado es mayor al saldo capital pendiente');
            $(this).val('');
        }
    });
});
</script>
@stop
