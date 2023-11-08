<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medic;

class MedicController extends Controller
{
    public function index() {
        $medics = Medic::all();
        return view('admin.medics.index', compact('medics'));
    }

    public function create() {
        return view('admin.medics.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'mail' => 'required',
        ]);
        Medic::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'mail' => $request->mail,
            'address' => $request->address,
            'status' => 1,
            'user_id' => \Auth::user()->id
        ]);
        return redirect(route('medics.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $medic = Medic::findOrFail($id);
        if(empty($medic)) {
            return redirect(route('medics.index'))->with('info','Registro no encontrado');
        }
        return view('admin.medics.show', compact('medic'));
    }

    public function edit($id) {
        $medic = Medic::findOrFail($id);
        if(empty($medic)) {
            return redirect(route('medics.index'))->with('info','Registro no encontrado');
        }
        return view('admin.medics.edit', compact('medic'));
    }

    public function update(Request $request, Medic $medic) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'mail' => 'required',
        ]);
        Medic::find($medic->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'mail' => $request->mail,
            'address' => $request->address
        ]);
        return redirect(route('medics.index'))->with('info','Actualización exitosa');
    }
    
    public function deactivate(Request $request, $id) {
        $medic = Medic::findOrFail($id);
        $medic->status = '0';
        $medic->save();
        return redirect()->route('medics.index')->with('info', 'Médico desactivado');
    }

    public function activate(Request $request, $id) {
        $medic = Medic::findOrFail($id);
        $medic->status = '1';
        $medic->save();
        return redirect()->route('medics.index')->with('info', 'Médico activado');
    }
}
