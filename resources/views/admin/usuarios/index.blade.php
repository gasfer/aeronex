@extends('adminlte::page')

@section('title', 'GAMC')

    
@section('content_header')
    <h1>USUARIOS</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Tabla De Usuarios</h1>          
        </div>

        <div class="card-body">
            <table class="table table-striped" id="usuarios">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Correo</th>
                        <th>Incorporacion</th>    
                    </tr>
                </thead>
                
               
            </table>
        </div>
    </div>

    
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
@stop

@section('js')
    
   <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
   <script src=" https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
   <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>
   <script>
        $('#usuarios').DataTable(
            { 
                "responsive"  :   true,
                "autoWidth"   :   true, 
                "ajax"      : "{{route('datatable.user')}}",
                "columns"   : 
                    [                
                        {data: 'id'         },
                        {data: 'name'       },
                        {data: 'email'      },
                        {data: 'created_at' }                          
                    ],
                "language": 
                {
                    "lengthMenu"    : "Mostrar "
                                        +
                                            `
                                                <select class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value = '10'>10</option>
                                                    <option value = '25'>25</option>
                                                    <option value = '50'>50</option>
                                                    <option value = '100'>100</option>
                                                    <option value = '-1'>Todos</option>
                                                </select>
                                            `
                                        +
                                      " Registros Por Pagina",
                                      
                    "zeroRecords"   : "No se encontro nada - Disculpa",
                    "info"          : "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty"     : "No hay registros disponibles",
                    "infoFiltered"  : "(Filtrado de _MAX_ Registros totales)",
                    "search"        : "Buscar",
                    
                    "paginate"      : 
                        { 
                            "next"      :   "Siguiente",
                            "previous"  :   "Anterior"
                        }
                } 
            });
    </script>
@stop
