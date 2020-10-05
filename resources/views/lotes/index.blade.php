@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">    
    @toastr_css
@endsection

@section('content')
<!-- Modal paara realizar cambios en la tabla-->
<!-- Small modal -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="row">
            <div class="col-12">
                <form id="formEdit" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group m-1">
                        <input type="hidden" id="tipoCambio" name="tipoCambio" />
                        <input type="number" id="valorCambiar" name="valorCambiar" class="form-control" />
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="background-color:#26422e">Aceptar</button>
                    </div>
                    
                </form>  
            </div>
        </div>
          
    </div>
  </div>
</div>







    <div class="row my-4">
        <div class="col-lg-12 pt-2 text-center">
            <div class="pull-left">
                <h2>Administrador de Lotes</h2>
            </div>
            
        </div>
    </div>
    <div class="row mb-6">
        <div class="col-12 text-center">
            <table class="table table-bordered table-sm table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th class="text-center">Lote</th>
                        <th class="text-center">Frente</th>
                        <th class="text-center">Fondo</th>
                        <th class="text-center">Área</th>
                        <th class="text-center">M2</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Enganche</th>
                        <th class="text-center">Saldo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lotes as $lote)
                        <tr>
                            <td>{{$lote->lote}}</td>
                            <td>{{number_format($lote->frente,2)}}</td>
                            <td>{{number_format($lote->fondo,2)}}</td>
                            <td>{{number_format($lote->area,2)}}</td>
                            <td class="editable" data-tipo="m2" data-id="{{$lote->id}}">${{number_format($lote->m2,2)}}</td>
                            <td>${{number_format($lote->total,2)}}</td>
                            <td class="" data-id="{{$lote->id}}">${{number_format($lote->enganche,2)}}</td>
                            <td>${{number_format($lote->saldo,2)}}</td>
                            <td>
                                @if($lote->status=='D')
                            <input type="checkbox" checked data-toggle="toggle" data-on="Disponible" data-off="Ocupado" data-onstyle='success fPrincipal' data-offstyle='danger' data-id="{{$lote->id}}">
                                @else
                                    <input type="checkbox" data-toggle="toggle" data-on="Disponible" data-off="Ocupado" data-onstyle='success' data-offstyle='danger' data-id="{{$lote->id}}">
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>    
            </table>
        </div>
    </div>
@endsection

@section('js')
@toastr_js
@toastr_render
@routes
<script type="text/javascript">
    $(document).ready(function(){
        $('#dataTable').DataTable({
                "columnDefs": [
                    { "orderable": false, "targets": [8] }
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });

            $('#dataTable tbody td.editable').click(function(){
                console.log(this);
                var x=this.dataset.id;
                
                $('#formEdit').attr("action",route('lotes.update',{lote:x}));
                $('#tipoCambio').val(this.dataset.tipo);
                $('#valorCambiar').val(this.textContent.replace(/[$,\s]/g,''));
                $('#modal').modal('show');
            });

            $('#dataTable :input').change(function(){
                axios.get('lotes/setstatus/'+this.dataset.id)
                .then(response=>{
                   console.log(response.data);
                })
                .catch(e=>{
                    console.log(e);
                })
            });
    });

</script>
@endsection
