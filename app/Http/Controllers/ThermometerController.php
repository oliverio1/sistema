<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thermometer;
use App\Models\Temperature;
use App\Models\Provider;
use App\Models\User;
use Carbon\Carbon;
use DB;
use PDF;

class ThermometerController extends Controller
{
    public function index() {
        $thermometers = Thermometer::all();
        return view('lab.thermometers.index', compact('thermometers'));
    }


    public function create() {
        $providers = Provider::all()->pluck('name','id');
        return view('lab.thermometers.create', compact('providers'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'serie' => 'required'
        ]);

        $ultimo = Thermometer::count();
        $folio = str_pad($ultimo + 1,3,'0',STR_PAD_LEFT);
        $code = 'BLAB-' . $folio;

        if($request->hasFile('expedient')!=null) {
            $filename = time() . '.' . $request->expedient->getClientOriginalExtension();
            $EqFileName = $request->expedient->move(public_path() . '/termometros/files', $filename);
        } else {
            $filename = 'sinexpediente.pdf';
        }
        Thermometer::create([
            'code' => $code,
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'serie' => $request->serie,
            'provider_id' => $request->provider_id,
            'calibration' => $request->calibration,
            'file' => $filename,
            'status' => 1
        ]);
        return redirect(route('thermometers.index'))->with('success','Registro exitoso');
    }

    public function show($id) {
        $thermometer = Thermometer::findOrFail($id);
        if(empty($thermometer)) {
            return redirect(route('thermometers.index'))->with('danger','Registro no encontrado');
        }
        return view('lab.thermometers.show', compact('thermometer'));
    }

    public function edit($id) {
        $thermometer = Thermometer::findOrFail($id);
        $providers = Provider::all()->pluck('name','id');
        if(empty($thermometer)) {
            return redirect(route('thermometers.index'))->with('danger','Registro no encontrado');
        }
        return view('lab.thermometers.edit', compact('thermometer','providers'));
    }

    public function update(Request $request, Thermometer $thermometer) {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'serie' => 'required'
        ]);

        if($request->file('expedient')!=null) {
            $filename = time() . '.' . $request->expedient->getClientOriginalExtension();
            $EqFileName = $request->expedient->move(public_path() . '/equipos/files', $filename);
        } else {
            $filename = 'sinexpediente.pdf';
        }
        Thermometer::where('id',$thermometer->id)->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'serie' => $request->serie,
            'provider_id' => $request->provider_id,
            'calibration' => $request->calibration,
            'file' => $filename,
            'status' => 1
        ]);
        return redirect(route('thermometers.index'))->with('success','Actualización exitosa');
    }

    public function label($id) {
        $thermometer = Thermometer::findOrFail($id);
        $customPaper = array(0,0,113,113);

        $pdf = PDF::setOptions(['isHtml5ParsedEnabled' => true, 'isRemoteEnabled' => true])->loadView('lab.thermometers.label', compact('thermometer'));
        return $pdf->stream();
    }

    public function registertemperature($id) {
        $thermometer = Thermometer::findOrFail($id);
        return view('lab.thermometers.registertemperature', compact('thermometer'));
    }

    public function registertemperaturestore(Request $request, $id) {
        $temperature = Thermometer::findOrFail($id);
        $temperature->min_temp = $request->min_temp;
        $temperature->max_temp = $request->max_temp;
        $temperature->save();
        return redirect(route('thermometers.index'))->with('success','Mantenimientos registrados');
    }

    public function temperature($id) {
        $thermometer = Thermometer::findOrFail($id);
        return view('lab.thermometers.temperature', compact('thermometer'));
    }

    public function temperaturestore(Request $request) {
        if($request->type == 'first') {
            $first = Temperature::where('termometro_temperature_id', $request->termometro_id)->where('type','first')->where('temperature_date',now()->format('Y-m-d'))->count();
            if($first != 0) {
                return redirect()->back()->with('warning','Esta temperatura ya fue registrada');
            } else {
                Temperature::create([
                    'termometro_temperature_id' => $request->termometro_id,
                    'type' => $request->type,
                    'temperature' => $request->temperature,
                    'made_by' => auth()->user()->id,
                    'temperature_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                return redirect()->back()->with('success','Temperatura registrada');
            }
        } else if($request->type == 'second') {
            $second = Temperature::where('termometro_temperature_id', $request->termometro_id)->where('type','second')->where('temperature_date',now()->format('Y-m-d'))->count();
            if($second != 0) {
                return redirect()->back()->with('warning','Esta temperatura ya fue registrada');
            } else {
                Temperature::create([
                    'termometro_temperature_id' => $request->termometro_id,
                    'type' => $request->type,
                    'temperature' => $request->temperature,
                    'made_by' => auth()->user()->id,
                    'temperature_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                return redirect()->back()->with('success','Temperatura registrada');
            }
        } else {
            $third = Temperature::where('termometro_temperature_id', $request->termometro_id)->where('type','third')->where('temperature_date',now()->format('Y-m-d'))->count();
            if($third != 0) {
                return redirect()->back()->with('warning','Esta temperatura ya fue registrada');
            } else {
                Temperature::create([
                    'termometro_temperature_id' => $request->termometro_id,
                    'type' => $request->type,
                    'temperature' => $request->temperature,
                    'made_by' => auth()->user()->id,
                    'temperature_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                $notification = array(
                    'message' => 'Temperatura registrada',
                    'alert-type' => 'success'
                );
                return redirect()->back()->with('success','Temperatura registrada');
            }
        }
    }

    public function temperaturereport(Request $request) {
        $thermometer = Thermometer::findOrFail($request->termometro_id);
        $month = $request->month;
        $timestamp = strtotime($month);
        $mes = date('m', $timestamp);
        $year = date('Y', $timestamp);
        $first = Temperature::where('termometro_temperature_id',$thermometer->id)->whereMonth('temperature_date',$mes)->where('type','first')->orderBy('temperature_date')->get();
        $second = Temperature::where('termometro_temperature_id',$thermometer->id)->whereMonth('temperature_date',$mes)->where('type','second')->orderBy('temperature_date')->get();
        $third = Temperature::where('termometro_temperature_id',$thermometer->id)->whereMonth('temperature_date',$mes)->where('type','third')->orderBy('temperature_date')->get();
        $cuantos = Temperature::where('termometro_temperature_id',$thermometer->id)->whereMonth('temperature_date',$mes)->where('type','first')->orderBy('temperature_date')->count();
        if($first == null && $second == null && $third == null) {
            return redirect()->back()->with('success','No hay temperaturas registradas para el mes seleccionado');
        }
        if($cuantos == 0) {
            return view('lab.thermometers.temperaturereport', compact('thermometer','cuantos','first','second','third','year','mes'));
        }
        foreach($first as $primero) {
            $days[] = ltrim(Carbon::parse($primero->temperature_date)->format('d'),'0');
        }
        foreach($first as $primero) {
            $temperature1[] = $primero->temperature;
        }
        foreach($second as $seg) {
            $temperature2[] = $seg->temperature;
        }
        foreach($third as $ter) {
            $temperature3[] = $ter->temperature;
        }
        foreach($first as $iniciales) {
            $realizo[] = $iniciales->realizo;
        }
        foreach($first as $iniciales) {
            $superviso[] = $iniciales->superviso;
        }
        $temperature1 = array_combine($days,$temperature1);
        $temperature2 = array_combine($days,$temperature2);
        $temperature3 = array_combine($days,$temperature3);
        $realizo = array_combine($days,$realizo);
        $superviso = array_combine($days,$superviso);
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('lab.thermometers.temperaturereport', compact('thermometer','cuantos','days','realizo','superviso','temperature1','temperature2','temperature3','first','second','third','mes','year'));
        return $pdf->stream();
    }

    public function graphics($id) {
        $thermometer = Thermometer::findOrFail($id);
        $mes = date('m');
        $year = date('Y');
        $first = Temperature::where('termometro_temperature_id',$thermometer->id)->whereMonth('temperature_date',$mes)->where('type','first')->orderBy('temperature_date')->get();
        $second = Temperature::where('termometro_temperature_id',$thermometer->id)->whereMonth('temperature_date',$mes)->where('type','second')->orderBy('temperature_date')->get();
        $third = Temperature::where('termometro_temperature_id',$thermometer->id)->whereMonth('temperature_date',$mes)->where('type','third')->orderBy('temperature_date')->get();
        $cuantos = Temperature::where('termometro_temperature_id',$thermometer->id)->whereMonth('temperature_date',$mes)->where('type','first')->orderBy('temperature_date')->count();
        $min_temp = Thermometer::where('id',$id)->select('min_temp')->first();
        $min = $min_temp->min_temp;
        $max_temp = Thermometer::where('id',$id)->select('max_temp')->first();
        $max = $max_temp->max_temp;
        if($first == null && $second == null && $third == null) {
            return redirect()->back()->with('success','No hay temperaturas registradas para el mes seleccionado');
        }
        if($cuantos == 0) {
            return view('lab.thermometers.temperaturereport', compact('thermometer','cuantos','first','second','third'));
        }
        foreach($first as $primero) {
            $days[] = ltrim(Carbon::parse($primero->temperature_date)->format('d'),'0');
        }
        foreach($first as $primero) {
            $temperature1[] = $primero->temperature;
        }
        foreach($second as $seg) {
            $temperature2[] = $seg->temperature-2;
        }
        foreach($third as $ter) {
            $temperature3[] = $ter->temperature+2;
        }
        foreach($first as $iniciales) {
            $realizo[] = $iniciales->realizo;
        }
        foreach($first as $inicio) {
            $superviso[] = $inicio->superviso;
        }
        $realizo = array_combine($days,$realizo);
        $superviso = array_combine($days,$superviso);
        return view('lab.thermometers.graphics', compact('thermometer','days','mes','year','temperature1','temperature2','temperature3','realizo','superviso','min','max'));
    }

    public function deactivate(Request $request, $id) {
        $thermometer = Thermometer::findOrFail($id);
        $thermometer->status = '0';
        $thermometer->save();
        return redirect()->route('thermometers.index')->with('info', 'Termómetro desactivado');
    }

    public function activate(Request $request, $id) {
        $thermometer = Thermometer::findOrFail($id);
        $thermometer->status = '1';
        $thermometer->save();
        return redirect()->route('thermometers.index')->with('info', 'Termómetro activado');
    }
}
