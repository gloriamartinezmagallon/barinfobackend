@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('app.home.buscador')</div>

                <div class="panel-body">
                    {!! Form::open(['class'=>'form','method'=>'post','url' => route('home.buscar')]) !!}

                        <div class="form-group">
                            {!! Form::label('conOpiniones', Lang::get('app.home.bar.conOpiniones'), ['class'=>'control-label']) !!}
                            {!! Form::select('conOpiniones', [1=>'Si',0=>'No'],$buscador->conOpiniones, ['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('NombreLocalidad', Lang::get('app.home.bar.NombreLocalidad'), ['class'=>'control-label']) !!}
                            {!! Form::select('NombreLocalidad', $buscador->getLocalidades(),null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Tipo', Lang::get('app.home.bar.Tipo'), ['class'=>'control-label']) !!}
                            {!! Form::select('Tipo', $buscador->getTipos(),null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('Especialidad', Lang::get('app.home.bar.Especialidad'), ['class'=>'control-label']) !!}
                            {!! Form::select('Especialidad', $buscador->getEspecialidades(),null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('DescripZona', Lang::get('app.home.bar.DescripZona'), ['class'=>'control-label']) !!}
                            {!! Form::select('DescripZona', $buscador->getZonas(),null, ['class'=>'form-control']) !!}
                        </div>
                        <hr/>

                        @foreach($buscador->getCampos() as $campo)

                        <div class="form-group">
                            {!! Form::label('Campo['.$campo['id'].']', $campo['nombre'], ['class'=>'control-label']) !!}
                            {!! Form::hidden('Campo['.$campo['id'].'][id]', $campo['id']) !!}
                            {!! Form::select('Campo['.$campo['id'].'][tiene]', [''=>'',1=>Lang::get('app.buscador.hay')],null, ['class'=>'form-control']) !!}

                            @if($campo['indicarmarca'])
                             {!! Form::select('Campo['.$campo['id'].'][marca]', $campo['marcas'],null, ['class'=>'form-control']) !!}
                            @else
                              {!! Form::hidden('Campo['.$campo['id'].'][marca]', '') !!}
                            @endif

                            @if($campo['indicartamanio'])
                             {!! Form::select('Campo['.$campo['id'].'][tamanio]', $campo['tamanios'],null, ['class'=>'form-control']) !!}
                            @else
                              {!! Form::hidden('Campo['.$campo['id'].'][tamanio]', '') !!}
                            @endif
                        </div>

                        @endforeach

                              {!! Form::hidden('Latitud', 0,['id'=>'Latitud']) !!}

                              {!! Form::hidden('Longitud', 0,['id'=>'Longitud']) !!}
                        {!! Form::submit(Lang::get('app.general.buscar'),['class'=>'btn btn-primary']) !!}
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div id="map"></div>
            <div class="row row-eq-height">
                @foreach($bares as $b)
                <div class="infobar col-lg-3 col-md-4 col-sm-2" id="infobar{{$b->id}}">
                    <img src="{{$b->ImgFicheroGN}}">
                    <p class="nombre">{{$b->Nombre}}</p>                    
                    <p class="tipo">{{$b->Tipo}}, {{$b->Especialidad}}</p>
                    <p class="localidad">{{$b->NombreLocalidad}}, {{$b->DescripZona}}</p>
                    @if(isset($b->distance))

                    <p class="distance">{{$b->distance}}</p>
                    @endif
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection

@section('style')
<style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
@endsection

@section('scripts')
<script>

    var bares = {!! json_encode($bares) !!};
    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: {lat: 42.816921, lng: -1.642859}
        });

        var bounds = new google.maps.LatLngBounds();


        // Add some markers to the map.
        // Note: The code uses the JavaScript Array.prototype.map() method to
        // create an array of markers based on a given "locations" array.
        // The map() method here has nothing to do with the Google Maps API.
        var markers = bares.map(function(bar, i) {
          if (bar.Latitud != 0 && bar.Longitud != 0)
            bounds.extend( {lat: bar.Latitud,lng: bar.Longitud});

          var marker = new google.maps.Marker({
            position: {lat: bar.Latitud,lng: bar.Longitud},
            title: bar.Nombre
          });

          var infowindow = new google.maps.InfoWindow({
            content: '<div class="infobar_marker"><p><strong>'+bar.Nombre+'</strong><br/>'+bar.Tipo+'</p><a href="#">Mostrar información</a></div>'
          });

          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });

          return marker;
        });

        

        var options = {
            imagePath: '{{url('/')}}/images/m'
        };
        if (markers.length > 0){
            var markerCluster = new MarkerClusterer(map, markers, options);

            map.fitBounds(bounds);
        }

        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            console.log(pos);

            $("#Latitud").val(position.coords.latitude);
            $("#Longitud").val(position.coords.longitude);
            @if(!$busqueda)        
            map.setCenter(pos);
            map.setZoom(14);
            @endif
          }, function() {
            
          });
        }
        
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_WEB_API_KEY')}}&callback=initMap"></script>
<script src="{{url('/')}}/js/markerclusterer.js"></script>
@endsection
