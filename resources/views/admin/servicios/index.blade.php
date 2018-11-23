@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-8">
                    @lang('app.admin.datos.servicios.title')
                </div>
                 <div class="col-sm-4 text-right">
                   <a class="btn btn-success pull-right" href="{{route('admin.datos.servicios.create')}}"><span class="fa fa-plus"></span></a>
                </div>

            
        </div>

        <div class="panel-body">

            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>@lang('app.admin.datos.servicios.nombre')</th>
                        <th class="text-center">@lang('app.admin.datos.servicios.ubicacion')</th>
                        <th class="text-center">@lang('app.admin.datos.servicios.calidad')</th>
                        <th class="text-center">@lang('app.admin.datos.servicios.precio')</th>
                        <th class="text-center">@lang('app.admin.datos.servicios.numero')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servicios as $c)
                    <tr>
                        <td><a href="{{route('admin.datos.servicios.edit',$c->id)}}">{{$c->nombre}}</a></td>
                        <td class="text-center">@if ($c->indicarubicacion == 1) <span class="fa fa-check text-success"></span>@endif</td>
                        <td class="text-center">@if ($c->indicarcalidad == 1) <span class="fa fa-check text-success"></span>@endif</td>
                        <td class="text-center">@if ($c->indicarprecio == 1) <span class="fa fa-check text-success"></span>@endif</td>
                        <td class="text-center">@if ($c->indicarnumero == 1) <span class="fa fa-check text-success"></span>@endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $servicios->links() }}
        </div>
    </div>
</div>
@endsection
