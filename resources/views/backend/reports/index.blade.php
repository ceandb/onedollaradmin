@extends('backend.layouts.master')

@section('main-content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">
                @include('backend.layouts.notification')
            </div>
        </div>
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success float-left">Reporte</h6>
            <br>
            <hr>
            <div class="col-sm-12">
                <div class="form-inline">
                    <label class="mr-3" for="">Filtrar por fechas </label>
                    <div class="form-group mr-3">
                        <input name="date_start" id="date_start" type="date"  class="form-control">
                    </div>
                    <div class="form-group mr-3">
                        <input name="" id="date_end" type="date"  class="form-control">
                    </div>
                    <div class="form-group ">
                        <button class="btn btn-outline-success">Mostrar</button>
                    </div>
                </div>
            </div>
            <hr>
            <div>
                <select name="" class="form-control" id="">
                    <option value="">FILTRAR POR PRODUCTO</option>
                </select>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered" id="banner-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>ID Producto</th>
                            <th>Costo</th>
                            <th>Cantidad vendida</th>
                            <th>Precio venta</th>

                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>ID Producto</th>
                            <th>Costo</th>
                            <th>Cantidad vendida</th>
                            <th>Precio venta</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style>
        div.dataTables_wrapper div.dataTables_paginate{
        }
        .zoom {
            transition: transform .2s; /* Animation */
        }

        .zoom:hover {
            transform: scale(3.2);
        }
    </style>
@endpush

@push('scripts')

    <!-- Page level plugins -->
    <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

    <script>

        $('#banner-dataTable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: 'Imprimir reporte',
                    autoPrint: true
                }
            ],
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[4,5]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
    </script>
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.dltBtn').click(function(e){
                var form=$(this).closest('form');
                var dataID=$(this).data('id');
                // alert(dataID);
                e.preventDefault();
                swal({
                    title: "Deseas eliminar este cupon?",
                    text: "Si solo deseas que no este en vigencia, puedes ponerlo inactivo!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
