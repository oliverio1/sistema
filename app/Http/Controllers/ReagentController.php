<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reagent;
use App\Models\ReagentUses;
use App\Models\ReagentDetails;
use App\Models\Area;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use Carbon\Carbon;

class ReagentController extends Controller
{
    public function index() {
        $reagents = Reagent::all();
        return view('lab.reagents.index', compact('reagents'));
    }

    public function create() {
        $areas = Area::pluck('name','id');
        return view('lab.reagents.create', compact('areas'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'area_id' => 'required'
        ]);
        $cuantos = Reagent::count();
        $cuantosmasuno = $cuantos + 1;
        $folio = str_pad($cuantosmasuno,3,'0',STR_PAD_LEFT);
        $code = 'BLAB-'.$folio;
        if ($request->file('image')!=null){
            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $EqFileName = $request->image->move(public_path() . '/reactivos/images', $filename);
        } else {
            $filename = 'sinimagen.png';
        }
        Reagent::create([
            'name' => $request->name,
            'code' => $code,
            'description' => $request->description,
            'image' => $filename,
            'area_id' => $request->area_id,
            'min' => $request->min,
            'max' => $request->max,
            'stock' => $request->stock,
        ]);
        return redirect(route('reagents.index'))->with('info','Registro exitoso');
    }

    public function show($id) {
        $reagent = Reagent::findOrFail($id);
        if(empty($reagent)) {
            return redirect(route('reagents.index'))->with('info','Registro no encontrado');
        }
        return view('lab.reagents.show', compact('reagent'));
    }

    public function edit($id) {
        $areas = Area::pluck('name','id');
        $reagent = Reagent::findOrFail($id);
        if(empty($reagent)) {
            return redirect(route('reagents.index'))->with('info','Registro no encontrado');
        }
        return view('lab.reagents.edit', compact('reagent','areas'));
    }

    public function update(Request $request, Reagent $reagent) {
        $request->validate([
            'name' => 'required'
        ]);
        if ($request->file('image')!=null){
            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $EqFileName = $request->image->move(public_path() . '/reactivos/images', $filename);
        } else {
            $filename = 'sinimagen.png';
        }
        Reagent::find($reagent->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $filename,
            'area_id' => $request->area_id,
            'min' => $request->min,
            'max' => $request->max,
            'stock' => $request->stock,
        ]);
        return redirect(route('reagents.index'))->with('info','Actualización exitosa');
    }

    public function request() {
        $areas = Area::pluck('name','id');
        $reagents = Reagent::get();
        return view('lab.reagents.request',compact('areas','reagents'));
    }

    public function storeRequest(Request $request) {
        $request->validate([
            'area_id' => 'required'
        ]);
        $purchase = Purchase::create([
            'user_id' => \Auth::user()->id,
            'area_id' => $request->area_id,
            'status' => 'Pendiente'
        ]);
        foreach($request->reagent_id as $key => $reagent) {
            PurchaseDetails::create([
                'purchase_id' => $purchase->id,
                'reagent_id' => $request->reagent_id[$key],
                'cant' => $request->cant[$key],
                'area_id' => $request->area_id,
                'status' => 'Pendiente'
            ]);
        }
        return redirect(route('reagents.index'))->with('info','Solicitud exitosa');
    }

    public function inventory() {
        $inventories= Reagent
            ::join('reagent_details as pd','reagents.id','=','pd.reagent_id')
            ->select('reagents.id as reagent_id','reagents.name','reagents.code','reagents.stock','pd.cantidad','pd.used','pd.finished','pd.lote','pd.caducidad','reagents.stock')
            ->where('reagents.stock','>',0)
            ->orWhere('pd.used','>',0)
            ->get();
        return view('lab.reagents.inventory',compact('inventories'));
    }

    public function use($id) {
        $cantidad = ReagentDetails::where('id',$id)->pluck('cantidad')->first();
        $cuantos = ReagentUses::where('reagent_detail_id',$id)->count();
        if($cuantos < $cantidad) {
            ReagentUses::create([
                'reagent_detail_id' => $id,
                'use_date' => Carbon::now(),
                'use_user_id' => \Auth::user()->id
            ]);
            ReagentDetails::where('id',$id)->increment('used', 1);
            Reagent::where('id',$id)->decrement('stock', 1);
            return redirect()->back()->with('info','Se registró el uso exitosamente');
        } else {
            return redirect()->back()->with('info','Ya no hay reactivo en stock');
        }
    }

    public function fin($id) {
        $cuantos = ReagentUses::where('reagent_detail_id',$id)->where('fin_user_id','=',null)->count();
        if($cuantos > 0) {
            ReagentUses::where('reagent_detail_id',$id)->where('fin_user_id','=',null)->first()->update([
                'fin_date' => Carbon::now(),
                'fin_user_id' => \Auth::user()->id
            ]);
            ReagentDetails::where('id',$id)->increment('finished', 1);
            ReagentDetails::where('id',$id)->decrement('used', 1);
            return redirect()->back()->with('info','Registro de uso exitoso');
        } else {
            return redirect()->back()->with('info','Ya no hay reactivo en stock');
        }
    }
}
