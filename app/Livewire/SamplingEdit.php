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

class SamplingEdit extends Component
{
    public $client, $study;
    public $name, $sex, $age, $observation;
    public $orden;
    public $order_id;
    public $order;
    public $medics, $clients, $studies = [];
    public $selectedStudies = [];
    public $order_detail_id;

    public function mount() {
        $this->order = Order::where('id',$this->order_id)->first();
        $this->selectedStudies = OrderDetails::where('order_id',$this->order_id)
            ->join('studies','studies.id','order_details.study_id')
            ->select('studies.name','studies.code','studies.id as study_id','order_details.id as order_detail_id')
            ->get()->toArray();
        $this->name = $this->order->name;
        $this->sex = $this->order->sex;
        $this->age = $this->order->age;
        $this->observation = $this->order->observation;
        $this->clients = Client::all();
        $this->medics = Medic::pluck('name','id');
        $this->studies = ClientStudy::where('client_id',$this->order->client_id)
            ->join('studies','studies.id','client_study.study_id')
            ->select('studies.name','studies.code','client_study.price','studies.id as study_id','client_study.id as clientstudy_id')
            ->get();
    }

    public function render()
    {
        if($this->order_detail_id) {
            $this->order_detail_id = OrderDetails::first();
        }
        return view('livewire.sampling-edit');
    }
}
