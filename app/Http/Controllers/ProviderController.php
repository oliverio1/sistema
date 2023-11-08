<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function index() {
        $providers = Provider::all();
        return view('admin.providers.index',compact('providers'));
    }

    public function create() {
        return view('admin.providers.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:providers',
            'social' => 'required',
            'service' => 'required',
            'contact' => 'required',
            'position' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if ($request->hasFile('file')){
            $Validation = $request->validate([
                'file' => 'required|file|mimes:pdf|max:10000'
            ]);
            $file = $Validation['file'];
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $EqFileName = $file->move(public_path().'/proveedores/files', $filename);
        } else {
            $filename = 'sinexpediente.pdf';
        }
        Provider::create([
            'name' => $request->name,
            'social' => $request->social,
            'service' => $request->service,
            'contact' => $request->contact,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact2' => $request->contact2,
            'position2' => $request->position2,
            'email2' => $request->email2,
            'phone2' => $request->phone2,
            'bank_count' => $request->bank_count,
            'bank' => $request->bank,
            'clabe' => $request->clabe,
            'address' => $request->address,
            'user_id' => \Auth::user()->id,
            'status' => 1,
            'observation' => $request->observation,
            'provider_file' => $filename,
        ]);
        return redirect(route('providers.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $provider = Provider::findOrFail($id);
        if(empty($provider)) {
            return redirect(route('providers.index'))->with('info','Registro no encontrado');
        }
        return view('admin.providers.show', compact('provider'));
    }

    public function edit($id) {
        $provider = Provider::findOrFail($id);
        if(empty($provider)) {
            return redirect(route('providers.index'))->with('info','Registro no encontrado');
        }
        return view('admin.providers.edit', compact('provider'));
    }

    public function update(Request $request, Provider $provider) {
        $request->validate([
            'name' => 'required|unique:providers,name,'.$provider->id,
            'social' => 'required',
            'service' => 'required',
            'contact' => 'required',
            'position' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if ($request->hasFile('file')){
            $Validation = $request->validate([
                'file' => 'required|file|mimes:pdf|max:10000'
            ]);
            $anterior = $provider->provider_file ?? '';
            if($anterior !== '') {
                File::delete(public_path().'/proveedores/files/'.$anterior);
            }
            $file = $Validation['file'];
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $EqFileName = $file->move(public_path().'/proveedores/files', $filename);
        } else {
            $filename = 'sinexpediente.pdf';
        }
        Provider::find($provider->id)->update([
            'name' => $request->name,
            'social' => $request->social,
            'service' => $request->service,
            'contact' => $request->contact,
            'position' => $request->position,
            'email' => $request->email,
            'phone' => $request->phone,
            'contact2' => $request->contact2,
            'position2' => $request->position2,
            'email2' => $request->email2,
            'phone2' => $request->phone2,
            'bank_count' => $request->bank_count,
            'bank' => $request->bank,
            'clabe' => $request->clabe,
            'address' => $request->address,
            'user_id' => \Auth::user()->id,
            'status' => 'Activo',
            'observation' => $request->observation,
            'provider_file' => $filename,
        ]);
        return redirect(route('providers.index'))->with('info','Actualización exitosa');
    }
    
    public function deactivate(Request $request, $id) {
        $provider = Provider::findOrFail($id);
        $provider->status = '0';
        $provider->save();
        return redirect()->route('providers.index')->with('info', 'Proveedor desactivado');
    }

    public function activate(Request $request, $id) {
        $provider = Provider::findOrFail($id);
        $provider->status = '1';
        $provider->save();
        return redirect()->route('providers.index')->with('info', 'Proveedor activado');
    }
}
