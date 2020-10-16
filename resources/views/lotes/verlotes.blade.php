@extends('layouts.app')

@section('title')
    Cotizador
@endsection
@section('content')

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header align-items-center" style="background-color: #26422e; color:#bcb97d; padding:0 auto!important;">
           
            <img src="{{secure_asset('img/isotipoDorado.png')}}" alt="" style="max-width: 20px;">  
            <h3 class="modal-title text-center w-100" id="tituloModal">Modal title</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:#bcb97d">&times;</span>
          </button>
        </div>
        <div class="modal-body font-weight-bold px-3" id='cuerpoModal'>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" style="background-color: #bcb97b; color:#26422e">Cerrar</button>
        </div>
      </div>
    </div>
  </div>




    <div class="row my-4">
        <div class="col-lg-12 pt-2 text-center">
            <div class="pull-left">
                <h2>Cotizador</h2>
            </div>
            
        </div>
    </div>
    <div class="row mb-6">
        <div class="col-12 text-center">
            <img src="{{secure_asset('img/mapa_fk.png')}}" name="kante" id="map-image" style="width: 1181px; max-width: 100%; height: auto;" alt="" usemap="#kante" class="map"/>
            <map name="kante" id="kante">
                @foreach ($lotes as $lote )
                    @if($lote->status=='D')
                        <area shape="poly" coords="{{$lote->coordenadas}}" onclick="modal({{$lote}})" title="Lote {{$lote->lote}}" data-maphilight='{"fillColor":"00ff00","fillOpacity":0.3}'/>
                    @elseif($lote->status=='O')
                        <area shape="poly" coords="{{$lote->coordenadas}}" onclick="modal({{$lote}})" title="Lote {{$lote->lote}}" data-maphilight='{"fillColor":"ff0000","fillOpacity":0.3}'/>
                    @else
                        <area shape="poly" coords="{{$lote->coordenadas}}" onclick="modal({{$lote}})" title="Lote {{$lote->lote}}" data-maphilight='{"fillColor":"ff8000","fillOpacity":0.3}'/>
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
        var cuerpo='<div class="fulljustify mb-4 px-2 py-2" style="background-color:#e3e2c9">&middot;Frente:<span style="color:#e3e2c9">-</span>'+lote.frente+'mts   &middot;Fondo:<span style="color:#e3e2c9">-</span>'+lote.fondo+'mts</div>'+
        '<div class="fulljustify mb-4 px-2 py-2" style="background-color:#e3e2c9">&middot;Área:<span style="color:#e3e2c9">-</span>'+lote.area+'m&sup2;   &middot;Precio<span style="color:#e3e2c9">-</span>M&sup2;:<span style="color:#e3e2c9">-</span>$'+$.number(lote.m2,2,'.',',')+'</div>'+
        '<div class="fulljustify mb-4 px-2 py-2" style="background-color:#e3e2c9">&middot;Precio<span style="color:#e3e2c9">-</span>Total:<span style="color:#e3e2c9">-</span>$'+$.number(lote.total,2,'.',',')+'   &middot;Enganche:<span style="color:#e3e2c9">-</span>$'+$.number(lote.enganche,2,'.',',')+'</div>'+
        '<div class="fulljustify mb-4 px-2 py-2" style="background-color:#e3e2c9">&middot;Saldo:<span style="color:#e3e2c9">-</span>$'+$.number(lote.saldo,2,'.',',')+' &middot;Mensualidad:<span style="color:#e3e2c9">-</span>$'+$.number(lote.saldo/lote.promocion,2,'.',',')+'<span style="color:#e3e2c9">-</span>('+lote.promocion+'<span style="color:#e3e2c9">-</span>meses)</div>'+
        '<div class="fulljustify mb-4 px-2 py-2" style="background-color:#e3e2c9">'+
        '<center><iframe src="/assets/lotes/pdf/Lote'+lote.lote+'"></iframe></center>'+
        '</div>';
        $('#tituloModal').text('Lote '+lote.lote);
        $('#cuerpoModal').html(cuerpo);
        $('#modal').modal('show');
    }

</script>
@endsection
