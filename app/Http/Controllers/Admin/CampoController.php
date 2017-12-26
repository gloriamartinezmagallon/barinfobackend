<?php

namespace App\Http\Controllers\Admin;

use App\Campo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampoController extends Controller
{
    public function index()
    {
        return view('admin.campos.index', ['campos' => Campo::paginate(20)]);
    }

    public function create()
    {
        $campo = new Campo();
        return view('admin.campos.form', ['campo' => $campo]);
    }

    public function edit($id)
    {
        $campo = Campo::find($id);
        return view('admin.campos.form', ['campo' => $campo]);
    }

    public function store(Request $request)
    {
        $campo                 = new Campo();
        $campo->nombre         = $request->input('nombre');
        $campo->indicarmarca   = $request->input('indicarmarca');
        $campo->indicartamanio = $request->input('indicartamanio');
        $campo->save();

        return redirect(route('admin.datos.campos'));
    }

    public function update($id, Request $request)
    {
        $campo                 = Campo::find($id);
        $campo->nombre         = $request->input('nombre');
        $campo->indicarmarca   = $request->input('indicarmarca');
        $campo->indicartamanio = $request->input('indicartamanio');
        $campo->save();

        return redirect(route('admin.datos.campos'));
    }
}
