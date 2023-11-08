<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indication;

class IndicationController extends Controller
{
    public function index() {
        $indications = Indication::all();
        return view('lab.indications.index', compact('indications'));
    }

    public function create() {
        return view('lab.indications.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:indications'
        ]);
        Indication::create([
            'name' => $request->name,
        ]);
        return redirect(route('indications.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $indication = Indication::findOrFail($id);
        if(empty($indication)) {
            return redirect(route('indications.index'))->with('info','Registro no encontrado');
        }
        return view('lab.indications.show', compact('indication'));
    }

    public function edit($id) {
        $indication = Indication::findOrFail($id);
        if(empty($indication)) {
            return redirect(route('indications.index'))->with('info','Registro no encontrado');
        }
        return view('lab.indications.edit', compact('indication'));
    }

    public function update(Request $request, Indication $indication) {
        $request->validate([
            'name' => 'required|unique:indications,name,'.$indication->id
        ]);
        Indication::find($indication->id)->update([
            'name' => $request->name,
        ]);
        return redirect(route('indications.index'))->with('info','Actualización exitosa');
    }

    public function destroy(Indication $indication) {
        $indication->delete();
        return redirect()->route('indications.index')->with('info', 'Registro eliminado');
    }
}
