@extends('layouts.app')

@section('content')

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            @if ($campo->id > 0)
                {{$campo->nombre}}                    
            @else
                @lang('app.admin.datos.campos.crear.title')
            @endif
        </div>

        <div class="panel-body">
            @if ($campo->id > 0)
            {!! Form::open(['class'=>'form','method'=>'post','url' => route('admin.datos.campos.edit',$campo->id)]) !!}             
            @else
            {!! Form::open(['class'=>'form','method'=>'post','url' => route('admin.datos.campos.create')]) !!}  
            @endif
            
                <div class="form-group">
                    {!! Form::label('nombre', Lang::get('app.admin.datos.campos.nombre'), ['class'=>'control-label']) !!}
                    {!! Form::text('nombre', $campo->nombre, ['class'=>'form-control','required'=>'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('indicarmarca', Lang::get('app.admin.datos.campos.marca'), ['class'=>'control-label']) !!}
                    {!! Form::select('indicarmarca', [0=>Lang::get('app.general.no'),1=>Lang::get('app.general.si')], $campo->indicarmarca, ['class'=>'form-control','required'=>'required']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('indicartamanio', Lang::get('app.admin.datos.campos.tamanio'), ['class'=>'control-label']) !!}
                    {!! Form::select('indicartamanio', [0=>Lang::get('app.general.no'),1=>Lang::get('app.general.si')], $campo->indicartamanio, ['class'=>'form-control','required'=>'required']) !!}
                </div>

                {!! Form::submit(Lang::get('app.general.guardar'),['class'=>'btn btn-success']); !!}

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
