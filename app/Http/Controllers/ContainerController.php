<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Container;

class ContainerController extends Controller
{
    public function index() {
        $containers = Container::all();
        return view('lab.containers.index', compact('containers'));
    }

    public function create() {
        return view('lab.containers.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:containers'
        ]);
        Container::create([
            'name' => $request->name,
        ]);
        return redirect(route('containers.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $container = Container::findOrFail($id);
        if(empty($container)) {
            return redirect(route('containers.index'))->with('info','Registro no encontrado');
        }
        return view('lab.containers.show', compact('container'));
    }

    public function edit($id) {
        $container = Container::findOrFail($id);
        if(empty($container)) {
            return redirect(route('containers.index'))->with('info','Registro no encontrado');
        }
        return view('lab.containers.edit', compact('container'));
    }

    public function update(Request $request, Container $container) {
        $request->validate([
            'name' => 'required|unique:containers,name,'.$container->id
        ]);
        Container::find($container->id)->update([
            'name' => $request->name,
        ]);
        return redirect(route('containers.index'))->with('info','Actualización exitosa');
    }

    public function destroy(Container $container) {
        $container->delete();
        return redirect()->route('containers.index')->with('info', 'Registro eliminado');
    }
}
