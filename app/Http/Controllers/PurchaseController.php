<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Provider;
use App\Models\Area;
use App\Models\Reagent;
use App\Models\ReagentDetails;
use PDF;
use Carbon\Carbon;


class PurchaseController extends Controller
{
    public function index() {
        $purchases = Purchase::all();
        return view('admin.purchases.index', compact('purchases'));
    }

    public function show($id) {
        $purchase = Purchase::findOrFail($id);
        $details = PurchaseDetails::where('purchase_id',$purchase->id)->get();
        if(empty($purchase)) {
            return redirect(route('purchases.index'))->with('info','Registro no encontrado');
        }
        return view('admin.purchases.show', compact('purchase','details'));
    }

    public function bought($id) {
        $providers = Provider::get();
        $purchase = Purchase::findOrFail($id);
        $details = PurchaseDetails::where('purchase_id',$id)->get();
        return view('admin.purchases.bought', compact('providers','purchase','details'));
    }

    public function receipt($id) {
        $providers = Provider::get();
        $purchase = Purchase::findOrFail($id);
        $details = PurchaseDetails::where('purchase_id',$id)->get();
        return view('admin.purchases.receipt', compact('providers','purchase','details'));
    }

    public function storeBought(Request $request) {
        $purchase = Purchase::where('id',$request->purchase_id)->update([
            'attended_id' => \Auth::user()->id,
            'status' => 'Atendida'
        ]);
        foreach($request->reagent_id as $key => $value) {
            PurchaseDetails::where('id',$request->detail_id[$key])->update([
                'purchased_cant' => $request->cant[$key],
                'provider_id' => $request->provider_id[$key],
                'attended' => Carbon::now(),
                'status' => $request->cant[$key] > 0 ? 'Pedido' : 'Cancelado'
            ]);
        }
        return redirect(route('purchases.index',[$request->purchase_id]));
    }

    public function storeReceipt(Request $request) {
        $purchase = Purchase::where('id',$request->purchase_id)->update([
            'status' => 'Concluida'
        ]);
        foreach($request->reagent_id as $key => $value) {
            PurchaseDetails::where('id',$request->detail_id[$key])->update([
                'status' => 'Recibido'
            ]);
        }
        foreach($request->reagent_id as $key => $value) {
            Reagent::where('id',$request->reagent_id[$key])->increment('stock', (int) $request->cant[$key]);
            ReagentDetails::create([
                'reagent_id' => $request->reagent_id[$key],
                'cantidad' => $request->cant[$key],
                'used' => 0,
                'finished' => 0,
                'lote' => $request->lote[$key],
                'caducidad' => $request->caducidad[$key],
                'volumen' => $request->volumen[$key],
                'recibio' => auth()->user()->id
            ]);
        }
        return redirect(route('purchases.index'))->with('info','Recepción de material registrado');
    }

    public function report($id) {
        $purchase = Purchase::findOrFail($id);
        $details = PurchaseDetails::where('purchase_id',$id)->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => TRUE, 'isRemoteEnabled' => TRUE])->loadView('admin.purchases.printRequest', compact('purchase','details'));
        return $pdf->stream();
    }
}
