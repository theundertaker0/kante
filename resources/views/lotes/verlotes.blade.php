@extends('layouts.app')

@section('title')
    Cotizador Finca Kanté
@endsection
@section('content')

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id='cuerpoModal'>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>




    <div class="row my-4">
        <div class="col-lg-12 pt-2 text-center">
            <div class="pull-left">
                <h2>Mapa de Lotes Finca Kanté</h2>
            </div>
            
        </div>
    </div>
    <div class="row mb-6">
        <div class="col-12 text-center">
            <img src="{{secure_asset('img/mapa_fk.png')}}" name="kante" id="map-image" style="width: 1181px; max-width: 100%; height: auto;" alt="" usemap="#kante" class="map"/>
            <map name="kante" id="kante">
                @foreach ($lotes as $lote )
                    @if($lote->status=='D')
                        <area shape="poly" coords="{{$lote->coordenadas}}" onclick="modal({{$lote}})" title="Lote {{$lote->lote}}" data-maphilight='{"fillColor":"00ff00","fillOpacity":0.5}'/>
                    @else
                        <area shape="poly" coords="{{$lote->coordenadas}}" onclick="modal({{$lote}})" title="Lote {{$lote->lote}}" data-maphilight='{"fillColor":"ff0000","fillOpacity":0.5}'/>
                    @endif
                    
                @endforeach
            </map>
    </div>
    </div>
@endsection

@section('js')
<script src="{{secure_asset('js/imageMapResizer.min.js')}}"></script>
<script src="{{secure_asset('js/jquery.numbers.min.js')}}"></script>
<script src="{{secure_asset('js/jquery.maphilight.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('map').imageMapResize();
    });

    $('.map').maphilight();

    function modal(lote){
        var cuerpo='<ul class="list-group">'+
    '<li class="list-group-item">Frente: '+lote.frente+' Mts. -  Fondo: '+lote.fondo+' Mts. -  Área: '+lote.area+' M2</li>'+
    '<li class="list-group-item">Precio M2: $'+$.number(lote.m2,2,'.',',')+' -  Precio Total: $'+$.number(lote.total,2,'.',',')+'</li>'+
    '<li class="list-group-item">Enganche: $'+$.number(lote.enganche,2,'.',',')+' - Saldo: $'+$.number(lote.saldo,2,'.',',')+'</li>'+
  '</ul>';
        $('#tituloModal').text('Lote '+lote.lote);
        $('#cuerpoModal').html(cuerpo);
        $('#modal').modal('show');
    }

</script>
@endsection
