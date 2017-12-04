@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('app.admin.sincro.title')</div>

                <div class="panel-body">

                    @if($resultsincro)
                    <div class="alert alert-success">
                      <strong>¡Sincronizado!</strong> Creados {{$creados}}, modificados {{$modificados}}
                    </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('admin.sincro') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('app.admin.sincro.btn')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
