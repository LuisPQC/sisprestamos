@extends('adminlte::page')

@section('content_header')
    <h1><b>Listado de configuraciones </b></h1>
    <hr>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Configuraciones registrados</h3>

                    <div class="card-tools">
                        <a href="{{url('/admin/configuraciones/create')}}" class="btn btn-primary"> Crear nuevo</a>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped table-sm" >
                        <thead>
                            <tr>
                                <th style="text-align: center">Nro</th>
                                <th style="text-align: center">Nombre</th>
                                <th style="text-align: center">Descripción</th>
                                <th style="text-align: center">Teléfono</th>
                                <th style="text-align: center">Email</th>
                                <th style="text-align: center">Moneda</th>
                                <th style="text-align: center">Logo</th>
                                <th style="text-align: center">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                        $contador = 1;
                        @endphp
                        @foreach($configuraciones as $configuracione)
                            <tr>
                                <td style="text-align: center">{{$contador++}}</td>
                                <td>{{$configuracione->nombre}}</td>
                                <td>{{$configuracione->descripcion}}</td>
                                <td style="text-align: center">{{$configuracione->telefono}}</td>
                                <td>{{$configuracione->email}}</td>
                                <td style="text-align: center">{{$configuracione->moneda}}</td>
                                <td style="text-align: center">
                                    <img src="{{asset('storage/'.$configuracione->logo)}}" width="100px" alt="imagen">
                                </td>
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{url('/admin/configuraciones',$configuracione->id)}}" style="border-radius: 4px 0px 0px 4px" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{url('/admin/configuraciones/'.$configuracione->id.'/edit')}}" style="border-radius: 0px 0px 0px 0px" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{url('/admin/configuraciones',$configuracione->id)}}" method="post"
                                              onclick="preguntar{{$configuracione->id}}(event)" id="miFormulario{{$configuracione->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 0px 4px 4px 0px"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <script>
                                            function preguntar{{$configuracione->id}}(event) {
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: '¿Desea eliminar esta registro?',
                                                    text: '',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d',
                                                    denyButtonColor: '#270a0a',
                                                    denyButtonText: 'Cancelar',
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        var form = $('#miFormulario{{$configuracione->id}}');
                                                        form.submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                    
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Asegura que la tabla no se desborde */
        .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        }

        /* Fondo transparente y sin borde en el contenedor */
        #example1_wrapper .dt-buttons {
            background-color: transparent;
            box-shadow: none;
            border: none;
            display: flex;
            justify-content: center; /* Centrar los botones */
            gap: 10px; /* Espaciado entre botones */
            margin-bottom: 15px; /* Separar botones de la tabla */
        }

        /* Estilo personalizado para los botones */
        #example1_wrapper .btn {
            color: #fff; /* Color del texto en blanco */
            border-radius: 4px; /* Bordes redondeados */
            padding: 5px 15px; /* Espaciado interno */
            font-size: 14px; /* Tamaño de fuente */
        }

        /* Colores por tipo de botón */
        .btn-danger { background-color: #dc3545; border: none; }
        .btn-success { background-color: #28a745; border: none; }
        .btn-info { background-color: #17a2b8; border: none; }
        .btn-warning { background-color: #ffc107; color: #212529; border: none; }
        .btn-default { background-color: #6e7176; color: #212529; border: none; }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            $("#example1").DataTable({
                "pageLength": 5,
                "language": {
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Configuraciones",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Configuraciones",
                    "infoFiltered": "(Filtrado de _MAX_ total Configuraciones)",
                    "lengthMenu": "Mostrar _MENU_ Configuraciones",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscador:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                buttons: [
                    { text: '<i class="fas fa-copy"></i> COPIAR', extend: 'copy', className: 'btn btn-default' },
                    { text: '<i class="fas fa-file-pdf"></i> PDF', extend: 'pdf', className: 'btn btn-danger' },
                    { text: '<i class="fas fa-file-csv"></i> CSV', extend: 'csv', className: 'btn btn-info' },
                    { text: '<i class="fas fa-file-excel"></i> EXCEL', extend: 'excel', className: 'btn btn-success' },
                    { text: '<i class="fas fa-print"></i> IMPRIMIR', extend: 'print', className: 'btn btn-warning' }
                ]
            }).buttons().container().appendTo('#example1_wrapper .row:eq(0)');
        });
    </script>
@stop
