<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Provider;
use App\Models\Area;
use App\Models\Study;

class ProfileController extends Controller
{
    public function create() {
        $providers = Provider::get()->pluck('name','id');
        $areas = Area::get()->pluck('name','id');
        $studies = Study::where('type','!=','2')->get();
        return view('lab.studies.profile', compact('providers','areas','studies'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'label' => 'required',
            'delivery' => 'required',
            'maquila' => 'required',
            'lab_code' => 'required',
        ]);
        $ultimo = Study::latest('id')->first();
        if($ultimo == null) {
            $folio = str_pad(1,3,'0',STR_PAD_LEFT);
        } else {
            $folio = str_pad($ultimo->id + 1,3,'0',STR_PAD_LEFT);
        }
        $code = $folio;
        $study = Study::create([
            'code' => $code,
            'name' => $request->name,
            'area_id' => 500,
            'label' => $request->label,
            'delivery' => $request->delivery,
            'maquila' => $request->maquila,
            'lab_code' => $request->lab_code,
            'provider_id' => $request->provider_id,
            'price' => $request->price,
            'status' => 1,
            'type' => 2,
        ]);
        foreach($request->study_id as $key => $est)
            Profile::create([
                'profile_id' => $study->id,
                'study_id' => $est,
                'order' => $request->order[$key]
            ]);
        return redirect(route('studies.index'))->with('success','Registro exitoso');
    }

    public function edit($id) {
        $providers = Provider::get()->pluck('name','id');
        $estudios = Profile::where('profile_id',$id)
            ->join('studies','studies.id','profiles.study_id')
            ->select('studies.name','profiles.order')
            ->orderBy('profiles.order')
            ->get();
        $areas = Area::get()->pluck('name','id');
        $study = Study::findOrFail($id);
        $studies = Study::where('area_id','!=','500')->get();
        if(empty($study)) {
            return redirect(route('studies.index'))->eith('danger','Registro no encontrado');
        }
        return view('lab.studies.editProfile', compact('providers','study','areas','studies','estudios'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'label' => 'required',
            'delivery' => 'required',
            'maquila' => 'required',
            'lab_code' => 'required',
            'provider_id' => 'required',
            'price' => 'required'
        ]);
        Study::find($id)->update([
            'name' => $request->name,
            'label' => $request->label,
            'delivery' => $request->delivery,
            'maquila' => $request->maquila,
            'lab_code' => $request->lab_code,
            'provider_id' => $request->provider_id,
            'price' => $request->price,
            'status' => 1,
            'type' => 2,
        ]);
        if($request->study_id == null) {
            return redirect(route('studies.index'))->with('info', 'Actualización exitosa');
        } else {
            Profile::where('profile_id',$id)->delete();
            foreach($request->study_id as $key => $est)
            Profile::create([
                'profile_id' => $id,
                'study_id' => $est,
                'order' => $request->order[$key]
            ]);
            return redirect(route('studies.index'))->with('info','Actualización exitosa');    
        }
    }

    public function show($id) {
        $study = Study::findOrFail($id);
        $studies = Profile::where('profile_id',$id)
            ->join('studies','profiles.study_id','=','studies.id')
            ->get();
        if(empty($study)) {
            return redirect(route('studies.index'))->with('danger','Registro no encontrado');
        } else {
            return view('lab.studies.showProfile', compact('study','studies'));
        }
    }

    public function deactivate(Request $request, $id) {
        $study = Study::findOrFail($id);
        $study->status = '0';
        $study->save();
        return redirect()->route('studies.index')->with('info', 'Perfil desactivado');
    }

    public function activate(Request $request, $id) {
        $study = Study::findOrFail($id);
        $study->status = '1';
        $study->save();
        return redirect()->route('studies.index')->with('info', 'Perfil activado');
    }
}
