<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function index() {
        $areas = Area::all();
        return view('lab.areas.index', compact('areas'));
    }

    public function create() {
        return view('lab.areas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:areas'
        ]);
        Area::create([
            'name' => $request->name,
        ]);
        return redirect(route('areas.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $area = Area::findOrFail($id);
        if(empty($area)) {
            return redirect(route('areas.index'))->with('info','Registro no encontrado');
        }
        return view('lab.areas.show', compact('area'));
    }

    public function edit($id) {
        $area = Area::findOrFail($id);
        if(empty($area)) {
            return redirect(route('areas.index'))->with('info','Registro no encontrado');
        }
        return view('lab.areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area) {
        $request->validate([
            'name' => 'required|unique:areas,name,'.$area->id
        ]);
        Area::find($area->id)->update([
            'name' => $request->name,
        ]);
        return redirect(route('areas.index'))->with('info','Actualización exitosa');
    }

    public function destroy(Area $area) {
        $area->delete();
        return redirect()->route('areas.index')->with('info', 'Registro eliminado');
    }
}
