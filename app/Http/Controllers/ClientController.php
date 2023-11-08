<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Study;
use App\Models\User;
use App\Models\ClientStudy;
use App\Mail\ClientMailable;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Hash;

class ClientController extends Controller
{
    public function index() {
        $clients = Client::all();
        return view('admin.clients.index',compact('clients'));
    }

    public function create() {
        return view('admin.clients.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:clients',
            'social' => 'required',
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
            $EqFileName = $file->move(public_path().'/clientes/files', $filename);
        } else {
            $filename = 'sinexpediente.pdf';
        }
        $random = Str::random(10);
        $client_role = Role::where('name','Cliente')->pluck('id');
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($random),
            'type' => 2,
            'status' => 1
        ]);
        $user->roles()->sync($client_role);
        $client = Client::create([
            'name' => $request->name,
            'social' => $request->social,
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
            'assigned_user_id' => $user->id,
            'status' => 'Activo',
            'observation' => $request->observation,
            'client_file' => $filename,
            'seller' => $request->seller,
            'status' => 1,
        ]);
        $studies = Study::all();
        foreach($studies as $study) {
            ClientStudy::create([
                'client_id' => $client->id,
                'study_id' => $study->id,
                'price' => $study->price
            ]);
        }
        $correo = new ClientMailable($client,$random);
        Mail::to($request->email)->send($correo);
        return redirect(route('clients.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $client = Client::findOrFail($id);
        if(empty($client)) {
            return redirect(route('clients.index'))->with('info','Registro no encontrado');
        }
        return view('admin.clients.show', compact('client'));
    }

    public function edit($id) {
        $client = Client::findOrFail($id);
        if(empty($client)) {
            return redirect(route('clients.index'))->with('info','Registro no encontrado');
        }
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client) {
        $request->validate([
            'name' => 'required|unique:clients',
            'social' => 'required',
            'contact' => 'required',
            'position' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
        if ($request->hasFile('file')){
            $Validation = $request->validate([
                'file' => 'required|file|mimes:pdf|max:10000'
            ]);
            $anterior = $client->client_file ?? '';
            if($anterior !== '') {
                File::delete(public_path().'/clientes/files/'.$anterior);
            }
            $file = $Validation['file'];
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $EqFileName = $file->move(public_path().'/clientes/files', $filename);
        } else {
            $filename = 'sinexpediente.pdf';
        }
        Client::find($client->id)->update([
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
            'client_file' => $filename,
            'seller' => $request->seller
        ]);
        return redirect(route('clients.index'))->with('info','Actualización exitosa');
    }

    public function prices($id) {
        $client = Client::findOrFail($id);
        $prices = ClientStudy::where('client_id',$id)
            ->join('studies','client_study.study_id','=','studies.id')
            ->select('client_study.price','studies.name','studies.price as list','client_study.id')
            ->get();
        if(empty($client)) {
            return redirect(route('clients.index'))->with('danger','Registro no encontrado');
        }
        return view('admin.clients.prices',compact('client','prices'));
    }

    public function updatePrice(Request $request) {
        if($request->ajax()) {
            ClientStudy::find($request->pk)->update([
                $request->price => $request->value
            ]);
            return response()->json(['success' => true]);
        }
    }
    
    public function deactivate(Request $request, $id) {
        $client = Client::findOrFail($id);
        $client->status = '0';
        $client->save();
        return redirect()->route('clients.index')->with('info', 'Cliente desactivado');
    }

    public function activate(Request $request, $id) {
        $client = Client::findOrFail($id);
        $client->status = '1';
        $client->save();
        return redirect()->route('clients.index')->with('info', 'Cliente activado');
    }
}
