<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\UserDetails;
use App\Models\OrderDetails;
use App\Models\OrderResult;
use App\Models\Client;
use App\Models\Medic;
use App\Models\Study;
use App\Models\StudyReport;
use App\Models\AnalitoCalculo;
use App\Models\Profile;
use Carbon\Carbon;
use PDF;
use DB;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::get();
        $clients = Client::get();
        return view('lab.orders.index', compact('orders','clients')); 
    }

    public function create() {
        return view('lab.orders.create');
    }

    public function sampling() {
        return view('lab.orders.sampling');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'birthdate' => 'required',
            'client_id' => 'required'
        ]);
        $cuantos = Order::whereDate('created_at',Carbon::today())->count();
        $cuantosmasuno = $cuantos + 1;
        $now = Carbon::now()->format('dmy');
        $folio = str_pad($cuantosmasuno,3,'0',STR_PAD_LEFT);
        $code = $now.$folio;
        $order = Order::create([
            'type' => 'Normal',
            'folio' => $code,
            'clave' => $request->clave,
            'name' => $request->name,
            'pater' => $request->pater,
            'mater' => $request->mater,
            'sex' => $request->sex,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'mail' => $request->mail,
            'medic_id' => $request->medic_id,
            'client_id' => $request->client_id,
            'observation' => $request->observation,
            'user_id' => \Auth::user()->id,
            'status' => 'Registro'
        ]);
        foreach($request->study_id as $study) {
            OrderDetails::create([
                'order_id' => $order->id,
                'study_id' => $study,
                'status' => 'Registro'
            ]);
        }
        return redirect()->route('orders.index')->with('info', 'Registro guardado con éxito');
        // return redirect()->route('orders.index', ['imprimir' => $registro->id])->with('success', 'Registro guardado exitosamente');
    }

    public function printOrder($id) {
        $order = Order::where('id',$id)->first();
        $studies = OrderDetails::where('order_id',$id)
            ->join('client_study','client_study.study_id','order_details.study_id')
            ->join('studies','studies.id','order_details.study_id','studies.id')
            ->select('studies.name','client_study.price','studies.id')
            ->get();
        $total = 0;
        foreach($studies as $study) {
            $total += $study->price;
        }
        $estudios = [];
        foreach($studies as $study) {
            array_push($estudios,['study_id' => $study->id,'name' => $study->name]);
        }
        $indications = [];
        foreach($estudios as $estudio) {
            $indication = DB::table('indication_study')
            ->where('indication_study.study_id',$estudio['study_id'])
            ->join('indications','indications.id','indication_study.indication_id')
            ->select('indications.name')->get()->toArray();
            foreach($indication as $i) {
                array_push($indications,['study' => $estudio['name'], 'indication' => $i->name]);
            }
        }
        $agrupados = array_reduce($indications, function($result, $item) {
            $result[$item['study']][] = $item['indication'];
            return $result;
        }, array());

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => TRUE, 'isRemoteEnabled' => TRUE])->loadView('lab.orders.printOrder', compact('order','studies','agrupados','total'));
        return $pdf->stream();
    }

    public function printLabels($id) {
        $studies = DB::table('order_details')
            ->where('order_details.order_id',$id)
            ->join('studies','studies.id','order_details.study_id')
            ->join('container_study','container_study.study_id','order_details.study_id')
            ->join('containers','containers.id','container_study.container_id')
            ->join('orders','orders.id','order_details.order_id')
            ->select('studies.label as study','orders.folio','orders.name','orders.pater','orders.mater','orders.sex','orders.age','containers.name as containers')->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => TRUE, 'isRemoteEnabled' => TRUE])->loadView('lab.orders.printLabels', compact('studies'));
        return $pdf->stream();
    }

    public function printLabel($order_id,$study_id,$order_study_id  ) {
        $newArray = array();
        $order_study_id = $order_study_id;
        $study = Study::where('id',$study_id)->first();
        $order = Order::where('id',$order_id)->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => TRUE, 'isRemoteEnabled' => TRUE])->loadView('lab.orders.printLabel', compact('newArray','order_study_id','study','order'));
        return $pdf->stream();
    }

    public function storeSampling(Request $request) {
        $request->validate([
            'name' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'client_id' => 'required'
        ]);
        $cuantos = Order::whereDate('created_at',Carbon::today())->count();
        $cuantosmasuno = $cuantos + 1;
        $now = Carbon::now()->format('dmy');
        $folio = str_pad($cuantosmasuno,3,'0',STR_PAD_LEFT);
        $code = $now.$folio;
        $order = Order::create([
            'type' => 'Rapido',
            'folio' => $code,
            'clave' => $request->clave,
            'name' => $request->name,
            'pater' => '',
            'mater' => '',
            'birthdate' => '',
            'sex' => $request->sex,
            'age' => $request->age,
            'client_id' => $request->client_id,
            'observation' => $request->observation,
            'user_id' => \Auth::user()->id,
            'status' => 'Registro'
        ]);
        foreach($request->study_id as $study) {
            OrderDetails::create([
                'order_id' => $order->id,
                'study_id' => $study,
                'status' => 'Registro'
            ]);
        }
        return redirect()->back()->with('info','Registro exitoso');
    }

    public function updateSampling(Request $request, Order $order) {
        $request->validate([
            'name' => 'required',
            'sex' => 'required',
            'age' => 'required',
        ]);
        Order::find($order->id)->update([
            'type' => 'Rapido',
            'name' => $request->name,
            'pater' => '',
            'mater' => '',
            'birthdate' => '',
            'sex' => $request->sex,
            'age' => $request->age,
            'observation' => $request->observation,
            'user_id' => \Auth::user()->id,
        ]);
        foreach($request->study_id as $study) {
            OrderDetails::create([
                'order_id' => $order->id,
                'study_id' => $study,
                'status' => 'Registro'
            ]);
        }
        return redirect()->back()->with('info','Actualización exitosa');
    }

    public function update(Request $request, Order $order) {
        $request->validate([
            'name' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'birthdate' => 'required',
        ]);
        Order::find($request->order_id)->update([
            'type' => 'Normal',
            'clave' => $request->clave,
            'name' => $request->name,
            'pater' => $request->pater,
            'mater' => $request->mater,
            'sex' => $request->sex,
            'age' => $request->age,
            'birthdate' => $request->birthdate,
            'phone' => $request->phone,
            'mail' => $request->mail,
            'medic_id' => $request->medic_id,
            'observation' => $request->observation,
            'user_id' => \Auth::user()->id,
        ]);
        foreach($request->study_id as $study) {
            OrderDetails::create([
                'order_id' => $request->order_id,
                'study_id' => $study,
                'status' => 'Registro'
            ]);
        }
        return redirect()->back()->with('info','Actualización exitosa');
    }

    public function updateClient(Request $request, Order $order) {
        $request->validate([
            'client_id' => 'required'
        ]);
        Order::find($order->id)->update([
            'client_id' => $request->client_id,
        ]);
        return redirect()->back()->with('info','Actualización exitosa');
    }

    public function show($id) {
        $order = Order::findOrFail($id);
        $details= DB::table('order_details')
            ->where('order_details.order_id',$order->id)
            ->join('studies','order_details.study_id','=','studies.id')
            ->select('order_details.id','order_details.study_id','order_details.status','order_details.created_at','studies.name','studies.delivery','studies.code')->get();
        if(empty($order)) {
            return redirect(route('orders.index'))->with('info','Registro no encontrado');
        }
        return view('lab.orders.show', compact('order','details'));
    }

    public function edit($id) {
        $order = Order::findOrFail($id);
        $selectedStudies = OrderDetails::where('order_id',$id)
            ->join('studies','studies.id','order_details.study_id')
            ->select('studies.name','studies.code','studies.id as study_id','order_details.id as order_detail_id')
            ->get();
        if(empty($order)) {
            return redirect(route('orders.index'))->with('info','Registro no encontrado');
        }
        return view('lab.orders.edit', compact('order','selectedStudies'));
    }

    public function editSampling($id) {
        $order = Order::findOrFail($id);
        $selectedStudies = OrderDetails::where('order_id',$id)
            ->join('studies','studies.id','order_details.study_id')
            ->select('studies.name','studies.code','studies.id as study_id','order_details.id as order_detail_id')
            ->get();
        if(empty($order)) {
            return redirect(route('orders.index'))->with('info','Registro no encontrado');
        }
        return view('lab.orders.editSampling', compact('order','selectedStudies'));
    }

    public function deleteStudy($id) {
        OrderDetails::find($id)->delete();
        return response()->json(['success'=>'Exitoso']);
    }

    public function report($order_id,$study_id,$order_study_id) {
        $order_study_id = $order_study_id;
        $study = Study::where('id',$study_id)->first();
        $order = Order::where('id',$order_id)->first();
        $cuantos = StudyReport::where('study_id',$study_id)->count();
        $analitos = StudyReport::where('study_id',$study_id)->where('analito','!=','NA')->select('analito')->get();
        $reports = DB::table('study_reports')
            ->where('study_reports.study_id', '=', $study_id)
            ->leftJoin('analito_references', 'study_reports.id', '=', 'analito_references.analito_id')
            ->select('study_reports.id as sr_id','study_reports.study_id','study_reports.orden','study_reports.analito','study_reports.text','study_reports.units',
            'analito_references.id as ar_id','analito_references.analito_id','analito_references.sex','analito_references.age_in','analito_references.age_fin','analito_references.text as referencia',
            'analito_references.min','analito_references.max')
            ->orderBy('study_reports.orden')
            ->get();
        $formulas = AnalitoCalculo::where('study_id','=',$study_id)->select('analito','formula','decimales')->get();
        foreach($reports as $key => $report) {
            if($report->analito_id == null) {
            } else {
                if($order->age < $report->age_fin && $order->age > $report->age_in) {
                } else {
                    unset($reports[$key]);
                }
            }
            if($report->analito_id == null) {
            } else {
                if($report->sex == $order->sexo) { 
                } else {
                    if($report->sex == 'Ambos') {
                    } else {
                        unset($reports[$key]);
                    }
                }
            }
        }
        return view('lab.orders.report', compact('study','order','reports','order_study_id','cuantos','formulas'));
    }

    public function storeresults(Request $request) {
        foreach($request->results as $result) {
            OrderResult::create($result);
        }
        OrderDetails::find($request->ordenestudio)->update([
            'observaciones' => $request->observaciones,
            'status' => 'Capturado'
        ]);
        $estudios = OrderDetails::where('order_id',$request->orden_id)->pluck('status')->toArray();
        $uniqueVaules = array_unique($estudios);
        $cuantos = count($uniqueVaules);
        if($cuantos == 1 && $uniqueVaules[0] === 'Capturado') {
            Order::find($request->orden_id)->update([
                'status' => 'Finalizado'
            ]);
        } else {
            Order::find($request->orden_id)->update([
                'status' => 'En proceso'
            ]);
        }
        $order = Order::findOrFail($request->orden_id);
        $details= DB::table('order_details')
            ->where('order_details.order_id',$order->id)
            ->join('studies','order_details.study_id','=','studies.id')
            ->select('order_details.id','order_details.study_id','order_details.status','order_details.created_at','studies.name','studies.delivery','studies.code')->get();
        return view('lab.orders.show', compact('order','details'));
    }

    public function showResult($order_id,$study_id,$order_study_id) {
        $study = Study::where('id',$study_id)->first();
        $order = Order::where('id',$order_id)->first();
        $results = OrderResult::where('order_id',$order_id)->where('study_id',$study_id)->orderBy('orden')->get();
        return view('lab.orders.showResult', compact('study','order','results'));
    }

    public function printReport($order_id,$study_id,$order_study_id) {
        $responsable = UserDetails::where('position','Responsable sanitario')
            ->join('users','users.id','user_details.user_id')->first();
        $firmarespon = 'usuarios/signatures/'.$responsable->signature;
        $signaturers = "data:image/png;base64,".base64_encode(file_get_contents($firmarespon));
        $user = OrderResult::where('order_id',$order_id)
            ->join('users','users.id','order_results.user_id')
            ->join('user_details','user_details.user_id','users.id')
            ->first();
        $firmaliberacion = 'usuarios/signatures/'.$user->signature;
        $signaturelr = "data:image/png;base64,".base64_encode(file_get_contents($firmaliberacion));
        $study = Study::where('id',$study_id)->first();
        $order = Order::where('id',$order_id)->first();
        $results = OrderResult::where('order_id',$order_id)->where('study_id',$study_id)->orderBy('orden')->get();
        $observaciones = OrderDetails::where('order_id',$order_id)->where('study_id',$study_id)->select('observaciones')->first();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => TRUE, 'isRemoteEnabled' => TRUE])->loadView('lab.orders.printReport', compact('order','responsable','signaturers','study','user','signaturelr','results','observaciones'));
        return $pdf->stream();
    }

    public function printReports($order_id) {
        $order = Order::where('id',$order_id)->first();
        $studies = OrderDetails::where('order_id',$order_id)->join('studies','studies.id','order_details.study_id')->select('studies.id','studies.name')->get();
        $results = OrderResult::where('order_id',$order_id)->get();
        $responsable = UserDetails::where('position','Responsable sanitario')
            ->join('users','users.id','user_details.user_id')->first();
        $firmarespon = 'usuarios/signatures/'.$responsable->signature;
        $signaturers = "data:image/png;base64,".base64_encode(file_get_contents($firmarespon));
        $user = OrderResult::where('order_id',$order_id)
            ->join('users','users.id','order_results.user_id')
            ->join('user_details','user_details.user_id','users.id')
            ->first();
        $firmaliberacion = 'usuarios/signatures/'.$user->signature;
        $signaturelr = "data:image/png;base64,".base64_encode(file_get_contents($firmaliberacion));
        $observaciones = OrderDetails::where('order_details.order_id',$order_id)->select('order_details.observaciones','order_details.study_id','studies.name')->join('studies','studies.id','order_details.study_id')->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => TRUE, 'isRemoteEnabled' => TRUE])->loadView('lab.orders.printReports', compact('order','responsable','signaturers','user','studies','results','observaciones','signaturelr'));
        return $pdf->stream();
    }
}
