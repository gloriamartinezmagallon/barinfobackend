@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-8">
                    @lang('app.admin.datos.campos.title')
                </div>
                 <div class="col-sm-4 text-right">
                   <a class="btn btn-success pull-right" href="{{route('admin.datos.campos.create')}}"><span class="fa fa-plus"></span></a>
                </div>

            
        </div>

        <div class="panel-body">

            <table class="table table-stripped">
                <thead>
                    <tr>
                        <th>@lang('app.admin.datos.campos.nombre')</th>
                        <th class="text-center">@lang('app.admin.datos.campos.marca')</th>
                        <th class="text-center">@lang('app.admin.datos.campos.tamanio')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campos as $c)
                    <tr>
                        <td><a href="{{route('admin.datos.campos.edit',$c->id)}}">{{$c->nombre}}</a></td>
                        <td class="text-center">@if ($c->indicarmarca == 1) <span class="fa fa-check text-success"></span>@endif</td>
                        <td class="text-center">@if ($c->indicartamanio == 1) <span class="fa fa-check text-success"></span>@endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $campos->links() }}
        </div>
    </div>
</div>
@endsection
