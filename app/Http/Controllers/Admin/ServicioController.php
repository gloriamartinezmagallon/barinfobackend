<?php

namespace App\Http\Controllers\Admin;

use App\Servicio;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index()
    {
        return view('admin.servicios.index', ['servicios' => Servicio::paginate(20)]);
    }

    public function create()
    {
        $servicio = new Servicio();
        return view('admin.servicios.form', ['servicio' => $servicio]);
    }

    public function edit($id)
    {
        $servicio = Servicio::find($id);
        return view('admin.servicios.form', ['servicio' => $servicio]);
    }

    public function store(Request $request)
    {
        $servicio                 = new Servicio();
        $servicio->nombre         = $request->input('nombre');
        $servicio->indicarubicacion   = $request->input('indicarubicacion');
        $servicio->indicarcalidad = $request->input('indicarcalidad');
        $servicio->indicarnumero = $request->input('indicarnumero');
        $servicio->indicarprecio = $request->input('indicarprecio');
        $servicio->save();

        return redirect(route('admin.datos.servicios'));
    }

    public function update($id, Request $request)
    {
        $servicio                 = Servicio::find($id);
        $servicio->nombre         = $request->input('nombre');
        $servicio->indicarubicacion   = $request->input('indicarubicacion');
        $servicio->indicarcalidad = $request->input('indicarcalidad');
        $servicio->indicarnumero = $request->input('indicarnumero');
        $servicio->indicarprecio = $request->input('indicarprecio');
        $servicio->save();

        return redirect(route('admin.datos.servicios'));
    }
}
