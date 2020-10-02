@extends('layouts.app')

@section('content')
    <div class="row my-4">
        <div class="col-lg-12 pt-2 text-center">
            <div class="pull-left">
                <h2>Mapa de Lotes Finca Kanté</h2>
            </div>
            
        </div>
    </div>
    <div class="row mb-6">
        <div class="col-12 text-center">
            <img src="{{asset('img/mapa_fk.png')}}" name="kante" id="map-image" style="width: 1181px; max-width: 100%; height: auto;" alt="" usemap="#kante"/>
            <map name="kante" id="kante">
                @foreach ($lotes as $lote )
                    <area shape="poly" coords="{{$lote->coordenadas}}" href="#" title="Lote {{$lote->lote}}"/>
                @endforeach
            </map>
    </div>
    </div>
@endsection

@section('js')
<script src="{{asset('js/imageMapResizer.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('map').imageMapResize();
    });

</script>
@endsection
