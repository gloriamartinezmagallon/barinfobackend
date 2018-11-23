@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            @if ($servicio->id > 0)
                {{$servicio->nombre}}                    
            @else
                @lang('app.admin.datos.servicios.crear.title')
            @endif
        </div>

        <div class="panel-body">
            @if ($servicio->id > 0)
            {!! Form::open(['class'=>'form','method'=>'post','url' => route('admin.datos.servicios.edit',$servicio->id)]) !!}             
            @else
            {!! Form::open(['class'=>'form','method'=>'post','url' => route('admin.datos.servicios.create')]) !!}  
            @endif
            
                <div class="form-group">
                    {!! Form::label('nombre', Lang::get('app.admin.datos.servicios.nombre'), ['class'=>'control-label']) !!}
                    {!! Form::text('nombre', $servicio->nombre, ['class'=>'form-control','required'=>'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('indicarubicacion', Lang::get('app.admin.datos.servicios.ubicacion'), ['class'=>'control-label']) !!}
                    {!! Form::select('indicarubicacion', [0=>Lang::get('app.general.no'),1=>Lang::get('app.general.si')], $servicio->indicarubicacion, ['class'=>'form-control','required'=>'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('indicarcalidad', Lang::get('app.admin.datos.servicios.calidad'), ['class'=>'control-label']) !!}
                    {!! Form::select('indicarcalidad', [0=>Lang::get('app.general.no'),1=>Lang::get('app.general.si')], $servicio->indicarcalidad, ['class'=>'form-control','required'=>'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('indicarprecio', Lang::get('app.admin.datos.servicios.precio'), ['class'=>'control-label']) !!}
                    {!! Form::select('indicarprecio', [0=>Lang::get('app.general.no'),1=>Lang::get('app.general.si')], $servicio->indicarprecio, ['class'=>'form-control','required'=>'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('indicarnumero', Lang::get('app.admin.datos.servicios.numero'), ['class'=>'control-label']) !!}
                    {!! Form::select('indicarnumero', [0=>Lang::get('app.general.no'),1=>Lang::get('app.general.si')], $servicio->indicarnumero, ['class'=>'form-control','required'=>'required']) !!}
                </div>

                {!! Form::submit(Lang::get('app.general.guardar'),['class'=>'btn btn-success']); !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
