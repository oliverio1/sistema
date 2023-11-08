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

class OrderStore extends Component
{
    public $client, $study;
    public $clave, $name, $pater, $mater, $sex, $birthdate, $age, $phone, $mail, $medic, $observation;
    public $orden;
    public $medics, $clients, $studies = [];
    public function mount() {
        $this->clients = Client::all();
        $this->medics = Medic::pluck('name','id');
        $this->studies = collect();
    }

    public function updatedClient($value) {
        $this->studies = ClientStudy::where('client_id',$value)
            ->join('studies','studies.id','client_study.study_id')
            ->select('studies.name','studies.code','client_study.price','studies.id as study_id','client_study.id as clientstudy_id')
            ->get();
    }

    public function render() {
        return view('livewire.order-store');
    }
}
