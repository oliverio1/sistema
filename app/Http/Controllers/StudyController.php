<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Study;
use App\Models\StudyReport;
use App\Models\Provider;
use App\Models\Area;
use App\Models\Specimen;
use App\Models\Container;
use App\Models\Indication;
use App\Models\Profile;
use PDF;

class StudyController extends Controller
{
    public function index() {
        $studies = Study::with('specimens')->with('indications')->with('containers')->get();
        return view('lab.studies.index', compact('studies'));
    }

    public function create() {
        $providers = Provider::get()->pluck('name','id');
        $areas = Area::get()->pluck('name','id');
        $specimens = Specimen::get()->pluck('name','id');
        $containers = Container::get()->pluck('name','id');
        $indications = Indication::get()->pluck('name','id');
        return view('lab.studies.create', compact('providers','areas','specimens','containers','indications'));
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'area_id' => 'required',
            'label' => 'required',
            'delivery' => 'required',
            'maquila' => 'required',
            'lab_code' => 'required',
            'price' => 'required',
        ]);
        $ultimo = Study::latest('id')->first();
        if($ultimo == null) {
            $folio = str_pad(1,3,'0',STR_PAD_LEFT);
        } else {
            $folio = str_pad($ultimo->id + 1,3,'0',STR_PAD_LEFT);
        }
        $code = $folio;
        if($request->type == 1) {
            $study = Study::create([
                'code' => $code,
                'name' => $request->name,
                'area_id' => $request->area_id, 
                'label' => $request->label,
                'delivery' => $request->delivery,
                'maquila' => $request->maquila,
                'lab_code' => $request->lab_code,
                'provider_id' => $request->provider_id,
                'price' => $request->price,
                'status' => 1,
                'type' => 1,
            ]);
            Profile::create([
                'profile_id' => $study->id,
                'study_id' => $study->id,
                'order' => 1
            ]);
            $study->specimens()->sync($request->specimens);
            $study->containers()->sync($request->containers);
            $study->indications()->sync($request->indications);
        } elseif($request->type == 3) {
            $study = Study::create([
                'code' => $code,
                'name' => $request->name,
                'area_id' => 5, 
                'label' => $request->label,
                'delivery' => $request->delivery,
                'maquila' => 1,
                'lab_code' => 0,
                'provider_id' => $request->provider_id,
                'price' => 0,
                'status' => 1,
                'type' => 3,
            ]);
            Profile::create([
                'profile_id' => $study->id,
                'study_id' => $study->id,
                'order' => 1
            ]);
            $study->specimens()->sync($request->specimens);
            $study->containers()->sync($request->containers);
            $study->indications()->sync($request->indications);
        } else {
            $study = Study::create([
                'code' => $code,
                'name' => $request->name,
                'area_id' => 5, 
                'label' => $request->label,
                'delivery' => $request->delivery,
                'maquila' => 1,
                'lab_code' => $request->lab_code,
                'provider_id' => $request->provider_id,
                'price' => $request->price,
                'status' => 1,
                'type' => 4,
            ]);
            Profile::create([
                'profile_id' => $study->id,
                'study_id' => $study->id,
                'order' => 1
            ]);
            $study->specimens()->sync($request->specimens);
            $study->containers()->sync($request->containers);
            $study->indications()->sync($request->indications);
        }
        return redirect(route('studies.index'))->with('success','Registro exitoso');
    }

    public function show($id) {
        $study = Study::findOrFail($id);
        if(empty($study)) {
            return redirect(route('studies.index'))->with('danger','Registro no encontrado');
        } else {
            if($study->type == 1) {
                return view('lab.studies.show', compact('study'));
            } elseif($study->type == 2) {
                $analitos = Profile::where('study_id',$id)
                    ->join('studies','studies.id','profiles.study_id')
                    ->select('profiles.order','studies.name','studies.area_id','studies.label','studies.price')
                    ->get();
                return view('lab.studies.showProfile', compact('study','analitos'));
            } elseif($study->type == 3) {
                return view('lab.studies.showAnalito', compact('study'));
            } else {
                return view('lab.studies.showAlergeno', compact('study'));
            }
        }
    }

    public function edit($id) {
        $providers = Provider::get()->pluck('name','id');
        $areas = Area::get()->pluck('name','id');
        $specimens = Specimen::get()->pluck('name','id');
        $containers = Container::get()->pluck('name','id');
        $indications = Indication::get()->pluck('name','id');
        $study = Study::findOrFail($id);
        $studies = Study::get();
        if(empty($study)) {
            return redirect(route('studies.index'))->eith('danger','Registro no encontrado');
        }
        return view('lab.studies.edit', compact('providers','study','areas','specimens','containers','indications','studies'));
    }

    public function update(Request $request, Study $study) {
        $request->validate([
            'name' => 'required',
            'label' => 'required',
            'delivery' => 'required',
            'maquila' => 'required',
            'lab_code' => 'required',
            'provider_id' => 'required',
            'price' => 'required',
            'area_id' => 'required',
        ]);
        if($request->type == 1) {
            Study::find($study->id)->update([
                'name' => $request->name,
                'area_id' => $request->area_id, 
                'label' => $request->label,
                'delivery' => $request->delivery,
                'maquila' => $request->maquila,
                'lab_code' => $request->lab_code,
                'provider_id' => $request->provider_id,
                'price' => $request->price,
                'status' => 1,
                'type' => 1,
            ]);
            $study->specimens()->sync($request->specimens);
            $study->containers()->sync($request->containers);
            $study->indications()->sync($request->indications);
        } elseif($request->type == 3) {
            Study::find($study->id)->update([
                'name' => $request->name,
                'area_id' => $request->area_id, 
                'label' => $request->label,
                'delivery' => $request->delivery,
                'maquila' => $request->maquila,
                'lab_code' => $request->lab_code,
                'provider_id' => $request->provider_id,
                'price' => $request->price,
                'status' => 1,
                'type' => 3,
            ]);
            $study->specimens()->sync($request->specimens);
            $study->containers()->sync($request->containers);
            $study->indications()->sync($request->indications);
        } else {
            Study::find($study->id)->update([
                'name' => $request->name,
                'area_id' => $request->area_id, 
                'label' => $request->label,
                'delivery' => $request->delivery,
                'maquila' => $request->maquila,
                'lab_code' => $request->lab_code,
                'provider_id' => $request->provider_id,
                'price' => $request->price,
                'status' => 1,
                'type' => 4,
            ]);
            $study->specimens()->sync($request->specimens);
            $study->containers()->sync($request->containers);
            $study->indications()->sync($request->indications);
        }
        return redirect(route('studies.index'))->with('success','Actualización exitosa');
    }

    public function estudios() {
        $studies = Study::where('type','=',1)->with('specimens')->with('indications')->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('lab.studies.estudiosgris', compact('studies'));
        return $pdf->stream();
    }

    public function alergenos() {
        $studies = Study::where('type','=',6)->select('code','name')->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('lab.studies.alergenosgris', compact('studies'));
        return $pdf->stream();
    }

    public function perfiles() {
        $profiles = Study::where('type','=',2)->get()->pluck('id')->toArray();
        $detalle = [];
        $indicaciones = [];
        $contenedores = [];
        $especimenes = [];
        $newIndicaciones = [];
        foreach($profiles as $key => $p) {
            $estudios = Profile::where('profile_id','=',$p)
                ->join('studies','profiles.study_id','=','studies.id')
                ->select('studies.id as study_id','studies.name as study_name','profiles.profile_id','studies.price')
                ->get();
            $indications = Profile::where('profile_id','=',$p)
                ->join('indication_study','profiles.study_id','=','indication_study.study_id')
                ->join('indications','indication_study.indication_id','=','indications.id')
                ->select('indications.name as indication','profiles.profile_id')
                ->get();
            $containers = Profile::where('profile_id','=',$p)
                ->join('container_study','profiles.study_id','=','container_study.study_id')
                ->join('containers','container_study.container_id','=','containers.id')
                ->select('containers.name as container','profiles.profile_id')
                ->get();
            $specimens = Profile::where('profile_id','=',$p)
                ->join('specimen_study','profiles.study_id','=','specimen_study.study_id')
                ->join('specimens','specimen_study.specimen_id','=','specimens.id')
                ->select('specimens.name as specimen','profiles.profile_id')
                ->get();
            array_push($detalle,$estudios);
            array_push($indicaciones,$indications);
            array_push($contenedores,$containers);
            array_push($especimenes,$specimens);
        }
        $perfiles = Study::whereIn('id',$profiles)->select('code','name','id as profile_id','price','delivery')->get();
        $contenedoresporperfil = [];
        $especimenesporperfil = [];
        foreach ($indicaciones as $subArray) {
            $uniqueIndications = [];

            foreach ($subArray as $element) {
                $indication = $element["indication"];
                $uniqueIndications[$indication] = $element;
            }

            $indicacionesporperfil[] = array_values($uniqueIndications);
        }
        foreach ($contenedores as $subArray) {
            $uniqueContainer = [];

            foreach ($subArray as $element) {
                $container = $element["container"];
                $uniqueContainer[$container] = $element;
            }

            $contenedoresporperfil[] = array_values($uniqueContainer);
        }
        foreach ($especimenes as $subArray) {
            $uniqueSpecimens = [];

            foreach ($subArray as $element) {
                $specimen = $element["specimen"];
                $uniqueSpecimens[$specimen] = $element;
            }

            $especimenesporperfil[] = array_values($uniqueSpecimens);
        }
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('lab.studies.perfilesgris', compact('detalle','perfiles','indicacionesporperfil','contenedoresporperfil','especimenesporperfil'));
        return $pdf->stream();
    }

    public function report($id) {
        $study = Study::findOrFail($id);
        if(empty($study)) {
            return redirect(route('studies.index'))->with('danger','Registro no encontrado');
        } else {
            return view('lab.studies.report', compact('study'));
        }
    }

    public function storereport(Request $request) {
        $id = $request->study_id;
        StudyReport::where('study_id',$id)->delete();
        for($i = 0; $i < count($request->orden); $i++) {
            StudyReport::create([
                'study_id' => $id,
                'orden' => $request->orden[$i],
                'analito' => $request->analito[$i],
                'text' => $request->text[$i],
                'units' => $request->units[$i],
            ]);
        }
        return redirect(route('studies.references', compact('id')));
    }

    public function references($id) {
        $study = Study::findOrFail($id);
        $analitos = StudyReport::where('study_id',$id)->where('analito','!=','NA')->get();
        return view('lab.studies.references', compact('study','analitos'));
    }

    public function deactivate(Request $request, $id) {
        $study = Study::findOrFail($id);
        $study->status = '0';
        $study->save();
        return redirect()->route('studies.index')->with('info', 'Estudio desactivado');
    }

    public function activate(Request $request, $id) {
        $study = Study::findOrFail($id);
        $study->status = '1';
        $study->save();
        return redirect()->route('studies.index')->with('info', 'Estudio activado');
    }
}
