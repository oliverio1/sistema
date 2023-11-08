<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Study;
use App\Models\Provider;
use App\Models\Maintenance;
use Carbon\Carbon;
use PDF;

class EquipmentController extends Controller
{
    public function index() {
        $equipments = Equipment::all();
        return view('lab.equipments.index',compact('equipments'));
    }

    public function create() {
        $providers = Provider::all()->pluck('name','id');
        return view('lab.equipments.create', compact('providers'));
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'serie' => 'required',
            'prevent1' => 'required',
            'prevent2' => 'required'
        ]);

        $ultimo = Equipment::count();
        $folio = str_pad($ultimo + 1,3,'0',STR_PAD_LEFT);
        $code = 'BLAB-' . $folio;

        if($request->hasFile('expedient')!=null) {
            $filename = time() . '.' . $request->expedient->getClientOriginalExtension();
            $EqFileName = $request->expedient->move(public_path() . '/equipos/files', $filename);
        } else {
            $filename = 'sinexpediente.pdf';
        }
        Equipment::create([
            'code' => $code,
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'serie' => $request->serie,
            'provider_id' => $request->provider_id,
            'prevent1' => $request->prevent1,
            'prevent2' => $request->prevent2,
            'file' => $filename,
            'status' => 1
        ]);
        return redirect(route('equipments.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $equipment = Equipment::findOrFail($id);
        if(empty($equipment)) {
            return redirect(route('equipments.index'))->with('info','Registro no encontrado');
        }
        return view('lab.equipments.show', compact('equipment'));
    }

    public function edit($id) {
        $equipment = Equipment::findOrFail($id);
        $providers = Provider::all()->pluck('name','id');
        if(empty($equipment)) {
            return redirect(route('equipments.index'))->with('info','Registro no encontrado');
        }
        return view('lab.equipments.edit', compact('equipment','providers'));
    }

    public function update(Request $request, Equipment $equipment) {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'serie' => 'required',
            'prevent1' => 'required',
            'prevent2' => 'required'
        ]);

        if($request->file('expedient')!=null) {
            $filename = time() . '.' . $request->expedient->getClientOriginalExtension();
            $EqFileName = $request->expedient->move(public_path() . '/equipos/files', $filename);
        } else {
            $filename = 'sinexpediente.pdf';
        }
        Equipment::where('id',$equipment->id)->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'model' => $request->model,
            'serie' => $request->serie,
            'provider_id' => $request->provider_id,
            'prevent1' => $request->prevent1,
            'prevent2' => $request->prevent2,
            'file' => $filename,
            'status' => 1
        ]);
        return redirect(route('equipments.index'))->with('info','Actualización exitosa');
    }
    
    public function destroy(Equipment $equipment) {
        $equipment->delete();
        return redirect(route('equipments.index'))->with('info','Registro eliminado');
    }

    public function label($id) {
        $equipment = Equipment::findOrFail($id);
        $customPaper = array(0,0,113,113);
        $pdf = PDF::setOptions(['isHtml5ParsedEnabled' => true, 'isRemoteEnabled' => true])->loadView('lab.equipments.label', compact('equipment'));
        return $pdf->stream();
    }

    public function registermaintenance($id) {
        $equipment = Equipment::findOrFail($id);
        return view('lab.equipments.registermaintenance', compact('equipment'));
    }

    public function registermaintenancestore(Request $request, $id) {
        $equipment = Equipment::findOrFail($id);
        $equipment->daily = $request->daily;
        $equipment->weekly = $request->weekly;
        $equipment->monthly = $request->monthly;
        $equipment->quarterly = $request->quarterly;
        $equipment->biannual = $request->biannual;
        $equipment->annual = $request->annual;
        $equipment->save();
        return redirect(route('equipments.index'))->with('info','Mantenimientos registrados');
    }

    public function maintenance($id) {
        $equipment = Equipment::findOrFail($id);
        $daily = Maintenance::where('equipment_maintenance_id',$id)->where('type','diario')->whereMonth('maintenance_date',now()->format('m'))->get();
        $weekly = Maintenance::where('equipment_maintenance_id',$id)->where('type','semanal')->whereMonth('maintenance_date',now()->format('m'))->get();
        $monthly = Maintenance::where('equipment_maintenance_id',$id)->where('type','mensual')->whereYear('maintenance_date',now()->format('Y'))->get();
        $quarterly = Maintenance::where('equipment_maintenance_id',$id)->where('type','trimestral')->whereYear('maintenance_date',now()->format('Y'))->get();
        $biannual = Maintenance::where('equipment_maintenance_id',$id)->where('type','semestral')->whereYear('maintenance_date',now()->format('Y'))->get();
        $annual = Maintenance::where('equipment_maintenance_id',$id)->where('type','anual')->whereYear('maintenance_date',now()->format('Y'))->get();
        return view('lab.equipments.maintenance', compact('equipment','daily','weekly','monthly','quarterly','biannual','annual'));
    }

    public function maintenancestore(Request $request) {
        if($request->maintenance_type == 'diario') {
            $diario = Maintenance::where('equipment_maintenance_id', $request->equipment_id)->where('type','diario')->where('maintenance_date',now()->format('Y-m-d'))->count();
            if($diario != 0) {
                return redirect()->back()->with('info','El mantenimiento ya fue registrado');
            } else {
                Maintenance::create([
                    'equipment_maintenance_id' => $request->equipment_id,
                    'type' => $request->maintenance_type,
                    'made_by' => auth()->user()->id,
                    'maintenance_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                return redirect()->back()->with('info','Mantenimiento registrado exitosamente');
            }
        } else if($request->maintenance_type == 'semanal') {
            Carbon::setWeekStartsAt(Carbon::MONDAY);
            Carbon::setWeekEndsAt(Carbon::SUNDAY);
            $weekly = Maintenance::where('equipment_maintenance_id',$request->equipment_id)->whereBetween('maintenance_date',[Carbon::now()->startOfWeek()->format('Y-m-d'), Carbon::now()->endOfWeek()->format('Y-m-d')])->where('type','semanal')->count();
            if($weekly != 0) {
                return redirect()->back()->with('info','El mantenimiento ya fue registrado');
            } else {
                Maintenance::create([
                    'equipment_maintenance_id' => $request->equipment_id,
                    'type' => $request->maintenance_type,
                    'made_by' => auth()->user()->id,
                    'maintenance_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                return redirect()->back()->with('info','Mantenimiento registrado exitosamente');
            }
        } else if($request->maintenance_type == 'mensual') {
            $month = now()->format('m');
            $monthly = Maintenance::where('equipment_maintenance_id',$request->equipment_id)->where('type','mensual')->whereMonth('maintenance_date','=',$month)->count();
            if($monthly != 0) {
                return redirect()->back()->with('info','El mantenimiento ya fue registrado');
            } else {
                Maintenance::create([
                    'equipment_maintenance_id' => $request->equipment_id,
                    'type' => $request->maintenance_type,
                    'made_by' => auth()->user()->id,
                    'maintenance_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                return redirect()->back()->with('info','Mantenimiento registrado exitosamente');
            }
        } else if($request->maintenance_type == 'trimestral') {
            $year = now()->format('Y');
            $quarterly = Maintenance::where('equipment_maintenance_id',$request->equipment_id)->where('type','trimestral')->whereYear('maintenance_date','=',$year)->count();
            if($quarterly > 3) {
                return redirect()->back()->with('info','El mantenimiento ya fue registrado');
            } else {
                Maintenance::create([
                    'equipment_maintenance_id' => $request->equipment_id,
                    'type' => $request->maintenance_type,
                    'made_by' => auth()->user()->id,
                    'maintenance_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                return redirect()->back()->with('info','Mantenimiento registrado exitosamente');
            }
        } else if($request->maintenance_type == 'semestral') {
            $year = now()->format('Y');
            $biannual = Maintenance::where('equipment_maintenance_id',$request->equipment_id)->where('type','semestral')->whereYear('maintenance_date','=',$year)->count();
            if($biannual > 1) {
                return redirect()->back()->with('info','El mantenimiento ya fue registrado');
            } else {
                Maintenance::create([
                    'equipment_maintenance_id' => $request->equipment_id,
                    'type' => $request->maintenance_type,
                    'made_by' => auth()->user()->id,
                    'maintenance_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                return redirect()->back()->with('info','Mantenimiento registrado exitosamente');
            }
        } else if($request->maintenance_type == 'anual') {
            $year = now()->format('Y');
            $annual = Maintenance::where('equipment_maintenance_id',$request->equipment_id)->where('type','anual')->whereYear('maintenance_date','=',$year)->count();
            if($annual > 0) {
                return redirect()->back()->with('info','El mantenimiento ya fue registrado');
            } else {
                Maintenance::create([
                    'equipment_maintenance_id' => $request->equipment_id,
                    'type' => $request->maintenance_type,
                    'made_by' => auth()->user()->id,
                    'maintenance_date' => now()->format('Y-m-d'),
                    'supervised_by' => 1,
                    'supervised_date' => now()->format('Y-m-d')
                ]);
                return redirect()->back()->with('info','Mantenimiento registrado exitosamente');
            }
        }
    }

    public function maintenancereport(Request $request) {
        $equipment = Equipment::findOrFail($request->equipment_id);
        $month = $request->month;
        $timestamp = strtotime($month);
        $mes = date('m', $timestamp);
        $year = date('Y', $timestamp);
        $daily = Maintenance::where('equipment_maintenance_id',$equipment->id)->whereMonth('maintenance_date',$mes)->where('type','diario')->orderBy('maintenance_date')->get();
        $cuantos = Maintenance::where('equipment_maintenance_id',$equipment->id)->whereMonth('maintenance_date',$mes)->where('type','diario')->orderBy('maintenance_date')->count();
        $weekly = Maintenance::where('equipment_maintenance_id',$equipment->id)->whereMonth('maintenance_date',$mes)->where('type','semanal')->orderBy('maintenance_date')->get();
        $monthly = Maintenance::where('equipment_maintenance_id',$equipment->id)->where('type','mensual')->orderBy('maintenance_date')->get();
        $quarterly = Maintenance::where('equipment_maintenance_id',$equipment->id)->where('type','trimestral')->orderBy('maintenance_date')->get();
        $biannual = Maintenance::where('equipment_maintenance_id',$equipment->id)->where('type','semestral')->orderBy('maintenance_date')->get();
        $annual = Maintenance::where('equipment_maintenance_id',$equipment->id)->where('type','anual')->orderBy('maintenance_date')->get();

        if($daily == null && $weekly == null && $monthly == null && $quarterly == null && $biannual == null && $annual == null) {
            return redirect()->back()->with('success','No hay mantenimientos registrados para el mes seleccionado');
        }
        if($cuantos == 0) {
            return view('lab.equipments.maintenancereport', compact('equipment','cuantos','daily','weekly','monthly','quarterly','biannual','annual','mes','year'));
        }
        foreach($daily as $diario) {
            $days[] = ltrim(Carbon::parse($diario->maintenance_date)->format('d'),'0');
        }
        foreach($daily as $iniciales) {
            $realizo[] = $iniciales->realizo;
        }
        foreach($daily as $inicio) {
            $superviso[] = $inicio->superviso;
        }
        $realizo = array_combine($days,$realizo);
        $superviso = array_combine($days,$superviso);
        // return view('equipments.maintenancereport', compact('equipment','cuantos','days','realizo','superviso','daily','weekly','monthly','quarterly','biannual','annual','mes','year'));
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('lab.equipments.maintenancereport', compact('equipment','cuantos','days','realizo','superviso','daily','weekly','monthly','quarterly','biannual','annual','mes','year'));
        return $pdf->stream();
    }
    
    public function deactivate(Request $request, $id) {
        $equipment = Equipment::findOrFail($id);
        $equipment->status = '0';
        $equipment->save();
        return redirect()->route('equipments.index')->with('info', 'Equipo desactivado');
    }

    public function activate(Request $request, $id) {
        $equipment = Equipment::findOrFail($id);
        $equipment->status = '1';
        $equipment->save();
        return redirect()->route('equipments.index')->with('info', 'Equipo activado');
    }
}
