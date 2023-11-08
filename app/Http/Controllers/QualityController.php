<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quality;

class QualityController extends Controller
{
    public function index() {
        $qualities = Quality::all();
        return view('qual.qualities.index',compact('qualities'));
    }

    public function create() {
        return view('qual.qualities.create');
    }

    public function store(Request $request) {
        $request->validate([
            'numeral' => 'required',
            'type' => 'required',
            'name' => 'required',
            'document' => 'required',
        ]);
        $filename = time() . '.' . $request->document->getClientOriginalExtension();
        $EqFileName = $request->document->move(public_path() . '/calidad/documents', $filename);
        $ultimo = Quality::where('type',$request->type)->latest('id')->first();
        if($ultimo == null) {
            $folio = str_pad(1,3,'0',STR_PAD_LEFT);
        } else {
            $folio = str_pad($ultimo->id + 1,3,'0',STR_PAD_LEFT);
        }
        $name = $request->type . '-' . $folio . ' ' . $request->name;
        Quality::create([
            'numeral' => $request->numeral,
            'type' => $request->type,
            'name' => $request->name,
            'document' => $filename,
            'release_date' => $request->release_date,
            'revision_date' => $request->revision_date,
            'status' => 1
        ]);
        return redirect(route('qualities.index'))->with('success','Registro exitoso');
    }

    public function show($id) {
        $quality = Quality::findOrFail($id);
        if(empty($quality)) {
            return redirect(route('qualities.index'))->with('danger','Registro no encontrado');
        }
        return view('qual.qualities.show', compact('quality'));
    }

    public function edit($id) {
        $quality = Quality::findOrFail($id);
        if(empty($quality)) {
            return redirect(route('qualities.index'))->with('danger','Registro no encontrado');
        }
        return view('qual.qualities.edit', compact('quality'));
    }

    public function update(Request $request, Quality $quality) {
        $request->validate([
            'numeral' => 'required',
            'type' => 'required',
            'name' => 'required',
            'document' => 'required',
        ]);
        $filename = time() . '.' . $request->document->getClientOriginalExtension();
        $EqFileName = $request->document->move(public_path() . '/calidad/documents', $filename);
        Quality::where('id',$quality->id)->update([
            'numeral' => $request->numeral,
            'type' => $request->type,
            'name' => $request->name,
            'document' => $filename,
            'release_date' => $request->release_date,
            'revision_date' => $request->revision_date,
            'status' => 1
        ]);
        return redirect(route('qualities.index'))->with('success','Actualización exitosa');
    }
}
