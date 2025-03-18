@extends('adminlte::page')

@section('content_header')
<h1><b>Creditos/Registro de un nuevo credito</b></h1>
<hr>
@stop

@section('content')
<form action="{{url('admin/creditos/create')}}" method="post">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos del cliente</h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Busqueda del cliente</label><b> (*)</b>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <select name="cliente_id" id="" class="form-control select2">
                                    <option value="">Buscar cliente...</option>
                                    @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nro_documento." - ".$cliente->apellidos." ".$cliente->nombres}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    @error('cliente_id')
                    <small style="color: red">{{$message}}</small>
                    @enderror


                    <hr>

                    <div class="" id="contenido_cliente" style="display: none;">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Documento</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nro_documento" name="nro_documento" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Nombres del cliente</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nombres" name="nombres" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Apellidos del cliente</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Fecha de nacimiento</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Género</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user-check"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="genero" name="genero" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Celular</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="celular" name="celular" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Referencia Celular</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="ref_celular" name="ref_celular" placeholder="Escriba aquí..." disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Datos del credito</h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="">Monto del credito</label>
                                <input type="text" id="monto_prestado" name="monto_prestado" class="form-control" required>
                                @error('monto_prestado')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="tasa_interes">Tasa de interés</label>
                                <div class="input-group">
                                    <input type="text" id="tasa_interes" name="tasa_interes" class="form-control">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                @error('tasa_interes')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Modalidad</label>
                                <select name="modalidad" id="modalidad" class="form-control">
                                    <option value="Semanal">Semanal</option>
                                    <option value="Quincenal">Quincenal</option>
                                    <option value="Diario">Diario</option>
                                    <option value="Mensual" selected>Mensual</option>
                                </select>
                                @error('modalidad')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Fecha de prestamo</label>
                                <input type="date" id="fecha_prestamo" name="fecha_inicio" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                @error('fecha_inicio')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <hr>

                    <button type="submit" class="btn btn-primary">Registrar credito</button>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</form>
@stop

@section('css')
<style>
    .select2-container .select2-selection--single {
        height: 40px !important;
        /* Ajusta la altura total del select */
    }
</style>
@stop

@section('js')
<script>
    $('.select2').select2({});

    $('.select2').on('change', function() {
        var id = $(this).val();
        //alert(cliente_id);
        if (id) {
            $.ajax({
                url: "{{url('/admin/prestamos/cliente/')}}" + '/' + id,
                type: 'GET',
                success: function(cliente) {
                    $('#contenido_cliente').css('display', 'block');
                    $('#nro_documento').val(cliente.nro_documento);
                    $('#nombres').val(cliente.nombres);
                    $('#apellidos').val(cliente.apellidos);
                    $('#fecha_nacimiento').val(cliente.fecha_nacimiento);
                    $('#genero').val(cliente.genero);
                    $('#email').val(cliente.email);
                    $('#celular').val(cliente.celular);
                    $('#ref_celular').val(cliente.ref_celular);
                },
                error: function() {
                    alert('No se pudo obetener la información del cliente');
                }
            });
        }
    });

    function calcularPrestamo() {
        const montoPrestado = parseFloat(document.getElementById('monto_prestado').value);
        const tasaInteres = parseFloat(document.getElementById('tasa_interes').value) / 100;
        const modalidad = document.getElementById('modalidad').value;
        const nroCuotas = parseInt(document.getElementById('nro_cuotas').value);

        if (isNaN(montoPrestado) || isNaN(tasaInteres) || isNaN(nroCuotas) || montoPrestado <= 0 || tasaInteres < 0 || nroCuotas <= 0) {
            alert("Por favor ingrese valores válidos.");
            return;
        }

        let tasaInteresAjustada = 0;
        let diasDelMes = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();

        switch (modalidad) {
            case "Diario":
                tasaInteresAjustada = (montoPrestado * tasaInteres) / diasDelMes;
                break;
            case "Semanal":
                tasaInteresAjustada = (montoPrestado * tasaInteres) / 4;
                break;
            case "Quincenal":
                tasaInteresAjustada = (montoPrestado * tasaInteres) / 2;
                break;
            case "Mensual":
                tasaInteresAjustada = montoPrestado * tasaInteres;
                break;
            case "Anual":
                tasaInteresAjustada = (montoPrestado * tasaInteres) * 12;
                break;
            default:
                alert("Modalidad no válida.");
                return;
        }

        const interesTotal = tasaInteresAjustada * nroCuotas;
        const totalCancelar = montoPrestado + interesTotal;
        const cuota = totalCancelar / nroCuotas;

        document.getElementById('monto_cuota').value = cuota.toFixed(2);
        document.getElementById('monto_cuota2').value = cuota.toFixed(2);
        document.getElementById('monto_interes').value = interesTotal.toFixed(2);
        document.getElementById('monto_final').value = totalCancelar.toFixed(2);
        document.getElementById('monto_final2').value = totalCancelar.toFixed(2);
    }

    // Función para actualizar los intereses diariamente
    function actualizarInteresDiario() {
        let diasDelMes = new Date(new Date().getFullYear(), new Date().getMonth() + 1, 0).getDate();
        let montoPrestado = parseFloat(document.getElementById('monto_prestado').value);
        let tasaInteres = parseFloat(document.getElementById('tasa_interes').value) / 100;

        if (!isNaN(montoPrestado) && !isNaN(tasaInteres)) {
            let interesDiario = (montoPrestado * tasaInteres) / diasDelMes;
            document.getElementById('monto_interes_diario').value = interesDiario.toFixed(2);
        }
    }

    // Actualizar el interés diariamente
    setInterval(actualizarInteresDiario, 86400000); // Se actualiza cada 24 horas


    // Mostrar los resultados en el HTML
    /* alert(`Resultado del préstamo:
             Monto Prestado: $${montoPrestado}
             Tasa de Interés Ajustada: ${(tasaInteresAjustada * 100).toFixed(2)}%
             Modalidad: ${modalidad}
             Número de Cuotas: ${nroCuotas}
             Interés Total: $${interesTotal.toFixed(2)}
             Cuota por Pagar: $${cuota.toFixed(2)}
             Total a Cancelar: $${totalCancelar.toFixed(2)}`); */
</script>
@stop