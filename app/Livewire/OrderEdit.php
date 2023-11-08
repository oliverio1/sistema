<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;
use App\Models\ClientStudy; 
use App\Models\Medic;
use App\Models\Studies;
use App\Models\Order;
use App\Models\OrderDetails;
use Carbon\Carbon;

class OrderEdit extends Component
{
    public $client, $study;
    public $clave, $name, $pater, $mater, $sex, $birthdate, $age, $phone, $mail, $medic, $observation;
    public $orden;
    public $order;
    public $order_id;
    public $medics, $clients, $studies = [];
    public $selectedStudies = [];
    public $order_detail_id;

    public function mount() {
        $this->order = Order::where('id',$this->order_id)->first();
        $this->clave = $this->order->clave;
        $this->name = $this->order->name;
        $this->pater = $this->order->pater;
        $this->mater = $this->order->mater;
        $this->sex = $this->order->sex;
        $this->birthdate = $this->order->birthdate;
        $this->age = $this->order->age;
        $this->phone = $this->order->phone;
        $this->mail = $this->order->mail;
        $this->medic = $this->order->medic;
        $this->observation = $this->order->observation;
        $this->clients = Client::all();
        $this->medics = Medic::pluck('name','id');
        $this->studies = ClientStudy::where('client_id',$this->order->client_id)
            ->join('studies','studies.id','client_study.study_id')
            ->select('studies.name','studies.code','client_study.price','studies.id as study_id','client_study.id as clientstudy_id')
            ->get();
    }

    public function updatedClient($value) {
        $this->studies = ClientStudy::where('client_id',$value)
            ->join('studies','studies.id','client_study.study_id')
            ->select('studies.name','studies.code','client_study.price','studies.id as study_id','client_study.id as clientstudy_id')
            ->get();
    }

    public function render()
    {
        return view('livewire.order-edit');
    }
}
