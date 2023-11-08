<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specimen;

class SpecimenController extends Controller
{
    public function index() {
        $specimens = Specimen::all();
        return view('lab.specimens.index', compact('specimens'));
    }

    public function create() {
        return view('lab.specimens.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:specimens'
        ]);
        Specimen::create([
            'name' => $request->name,
        ]);
        return redirect(route('specimens.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $specimen = Specimen::findOrFail($id);
        if(empty($specimen)) {
            return redirect(route('specimens.index'))->with('info','Registro no encontrado');
        }
        return view('lab.specimens.show', compact('specimen'));
    }

    public function edit($id) {
        $specimen = Specimen::findOrFail($id);
        if(empty($specimen)) {
            return redirect(route('specimens.index'))->with('info','Registro no encontrado');
        }
        return view('lab.specimens.edit', compact('specimen'));
    }

    public function update(Request $request, Specimen $specimen) {
        $request->validate([
            'name' => 'required|unique:specimens,name,'.$specimen->id
        ]);
        Specimen::find($specimen->id)->update([
            'name' => $request->name,
        ]);
        return redirect(route('specimens.index'))->with('info','Actualización exitosa');
    }

    public function destroy(Specimen $specimen) {
        $specimen->delete();
        return redirect()->route('specimens.index')->with('info', 'Registro eliminado');
    }
}
