@extends('layouts.app')

@section('title')
    Cotizador
@endsection
@section('content')

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header align-items-center" style="background-color: #26422e; color:#bcb97d; padding:0 auto!important;">
           
            <img src="{{secure_asset('img/logoDoradoSoloLetras.png')}}" alt="" style="max-height: 40px;">  
            <h3 class="modal-title text-right w-100 pr-2" id="tituloModal">Modal title</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" style="color:#bcb97d">&times;</span>
          </button>
        </div>
        <div class="modal-body font-weight-bold px-3" id='cuerpoModal'>
          <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-6 mb-2" id="cuerpoModalIzq"></div>
                <div class="col-12 col-lg-6" id="cuerpoModalDer"></div>
            </div>
          </div>
            
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>




    <div class="row my-4">
        <div class="col-lg-12 pt-1 text-center">
            <div class="pull-left">
                <h2>Cotizador</h2>
            </div>
            
        </div>
    </div>
    <div class="row mb-4 text-center">
        <div class="col-12 text-center mb-2">
            <img src="{{secure_asset('img/Cotizador-FK.PNG')}}" name="kante" id="map-image"  alt="" usemap="#kante" class="map img-fluid"/>
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
        var cuerpoIzq="";
        var cuerpoDer="";
        if(lote.lote=='47'){
            cuerpoDer='<div class="text-center mb-2 px-2 py-2" style="background-color:#e3e2c9"><b>Casa Club</b></div>';
        }else{
        cuerpoDer='<div class="mb-2 px-2 py-2" style="background-color:#e3e2c9">&middot;Frente: '+lote.frente+'mts</div>'+
        '<div class="mb-2 px-2 py-2" style="background-color:#e3e2c9">&middot;Fondo: '+lote.fondo+'mts</div>'+
        '<div class="mb-2 px-2 py-2" style="background-color:#e3e2c9">&middot;Área: '+lote.area+'m&sup2;</div>'+
        '<div class="mb-2 px-2 py-2" style="background-color:#e3e2c9">&middot;Precio<span style="color:#e3e2c9">-</span>M&sup2;:<span style="color:#e3e2c9">-</span>$'+$.number(lote.m2,2,'.',',')+'</div>'+
        '<div class="mb-2 px-2 py-2" style="background-color:#e3e2c9">&middot;Precio Total: '+$.number(lote.total,2,'.',',')+'</div>'+
        '<div class="mb-2 px-2 py-2" style="background-color:#e3e2c9">&middot;Enganche:<span style="color:#e3e2c9">-</span>$'+$.number(lote.enganche,2,'.',',')+'</div>'+
        '<div class="mb-2 px-2 py-2" style="background-color:#e3e2c9">&middot;Saldo: $'+$.number(lote.saldo,2,'.',',')+'</div>'+
        '<div class="mb-2 px-2 py-2" style="background-color:#e3e2c9">&middot;Mensualidad:<span style="color:#e3e2c9">-</span>$'+$.number(lote.saldo/lote.promocion,2,'.',',')+'<span style="color:#e3e2c9">-</span>('+lote.promocion+'<span style="color:#e3e2c9">-</span>meses)</div>'+
        '<button type="button" class="btn btn-danger btn-block" data-dismiss="modal" style="background-color: #26422e; color:#FFF">Cotizar</button>'+
        '</div>';
        cuerpoIzq='<center><iframe src="/assets/lotes/pdfs/Lote'+lote.lote+'.pdf" style="height:422px"></iframe></center>';
        }
        $('#tituloModal').text('Lote '+lote.lote);
        $('#cuerpoModalDer').html(cuerpoDer);
        $('#cuerpoModalIzq').html(cuerpoIzq)
        $('#modal').modal('show');
    }

</script>
@endsection
