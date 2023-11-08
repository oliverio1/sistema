<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\IncidentDetails;
use App\Models\Area;
use App\Models\Contact;
use App\Models\User;
use App\Models\Client;
use App\Mail\IncidentMailable;
use Illuminate\Support\Facades\Mail;
use PDF;

class IncidentController extends Controller
{
    public function index() {
        $incidents = Incident::all();
        return view('lab.incidents.index', compact('incidents'));
    }

    public function contact() {
        $contacts = Contact::all();
        return view('lab.incidents.contact', compact('contacts'));
    }

    public function create() {
        $users = User::where('type',1)->get();
        $clients = Client::get()->pluck('name','id');
        return view('lab.incidents.create', compact('users','clients'));
    }

    public function store(Request $request) {
        $request->validate([
            'client_id' => 'required',
            'name' => 'required',
            'source' => 'required',
            'description' => 'required',
            'assigned' => 'required',
        ]);
        Incident::create([
            'client_id' => $request->client_id,
            'name' => $request->name,
            'source' => $request->source,
            'assigned' => $request->assigned,
            'description' => $request->description,
            'user_id' => \Auth::user()->id,
            'status' => 'Pendiente'
        ]);
        return redirect(route('incidents.index'))->with('info','Registro exitoso');
    }

    public function storepublic(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $incident = Incident::create([
            'client_id' => 500,
            'name' => $request->name,
            'email' => $request->email,
            'source' => 'Externa',
            'assigned' => 0,
            'description' => $request->description,
            'user_id' => 0,
            'status' => 'Pendiente'
        ]);
        $info = Incident::where('incidents.id',$incident->id)->first();
        $correo = new IncidentMailable($info);
        Mail::to($request->email)->send($correo);
        return redirect(route('incidents.gracias', [$incident->id]));
    }

    public function gracias($id) {
        $incident = Incident::findOrFail($id);
        return view('gracias', compact('incident'));
    }

    public function show($id) {
        $incident = Incident::findOrFail($id);
        $users = User::where('type',1)->get();
        $details = IncidentDetails::where('incident_id',$id)->get();
        if(empty($incident)) {
            return redirect(route('incidents.index'))->with('success','Registro no encontrado');
        }
        return view('lab.incidents.show', compact('incident','details','users'));
    }
    
    public function edit($id) {
        $incident = Incident::findOrFail($id);
        $users = User::where('type',1)->get();
        $clients = Client::get()->pluck('name','id');
        if(empty($incident)) {
            return redirect(route('incidents.index'))->with('success','Registro no encontrado');
        }
        return view('lab.incidents.edit', compact('incident','users','clients'));
    }

    public function update(Request $request, Incident $incident) {
        for($i=0;$i<count($request->action);$i++) {
            IncidentDetails::create([
                'incident_id' => $incident->id,
                'realizo' => \Auth::user()->name,
                'action' => $request->action[$i],
            ]);
        }
        Incident::where('id',$incident->id)->update([
            'status' => $request->status
        ]);
        return redirect(route('incidents.index'))->with('success','Actualización exitosa');
    }

    public function report($id) {
        $incident = Incident::findOrFail($id);
        $details = IncidentDetails::where('incident_id',$id)->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => TRUE, 'isRemoteEnabled' => TRUE])->loadView('lab.incidents.report', compact('incident','details'));
        return $pdf->stream();
    }

    public function reports() {
        $incidents = Incident::all();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('lab.incidents.reports', compact('incidents'));
        return $pdf->stream();
    }
    
    public function actions($id) {
        $incident = Incident::findOrFail($id);
        $details = IncidentDetails::where('incident_id',$id)->get();
        if(empty($incident)) {
            return redirect(route('incidents.index'))->with('success','Registro no encontrado');
        }
        return view('lab.incidents.actions', compact('incident','details'));
    }

    public function storeactions(Request $request, $id) {
        $incident = Incident::findOrFail($id);
        for($i=0; $i<count($request->action); $i++) {
            $detalle = new IncidentDetails();
            $detalle->incident_id = $id;
            $detalle->action = $request->action[$i];
            $detalle->user_id = $request->responsable[$i];
            $detalle->status = 1;
            $detalle->save();
        }
        Incident::where('id', $incident->id)->update([
            'status' => 'En revisión'
        ]);
        return redirect(route('incidents.index'))->with('success','Actualización exitosa');
    }

    public function solveaction($id) {
        $details = IncidentDetails::findOrFail($id);
        return view('lab.incidents.solveaction',compact('details'));
    }

    public function finishaction(Request $request, $id) {
        $request->validate([
            'solution' => 'required',
        ]);
        if ($request->hasFile('file')){
            $Validation = $request->validate([
                'file' => 'required|file|mimes:pdf|max:30000'
            ]);
            $file = $Validation['file'];
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $EqFileName = $file->move(public_path().'/calidad/incidentes', $filename);
        } else {
            $filename = '';
        }
        $detail = IncidentDetails::find($id)->update([
            'solution' => $request->solution,
            'evidence' => $filename,
            'status' => 2
        ]);
        $incident_id = IncidentDetails::where('id',$id)->pluck('incident_id')->first();
        return redirect()->route('incidents.actions',$incident_id);
    }

    public function storecontact(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);
        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'message'=>$request->message,
        ]);
    }
}
