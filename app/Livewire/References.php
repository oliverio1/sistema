<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\AnalitoReference;
use App\Models\StudyReport;
use App\Models\AnalitoCalculo;

class References extends Component
{
    public $referencia_id;
    public $analito_id;
    public $study_id;
    public $calculo;
    public $calculo_id;
    public $decimales;
    public $analito_calculo;
    public $sex, $age_in, $age_fin, $min, $max, $text;

    protected $rules = [
        'sex' => 'required', 
        'age_in' => 'required', 
        'age_fin' => 'required', 
        'min' => 'required', 
        'max' => 'required', 
        'text' => 'required'
    ];

    public function render()
    {
        $analitos = StudyReport::where('study_id',$this->study_id)->where('analito','!=','NA')->get();
        // $referencias = AnalitoReference::where('analito_id',$this->analito_id)
        //     ->get();
        $referencias = AnalitoReference::where('analito_id',$this->analito_id)
            ->join('study_reports','study_reports.id','analito_references.analito_id')
            ->select('analito_references.id','analito_references.sex','analito_references.age_in','analito_references.age_fin','analito_references.min','analito_references.text',
                'study_reports.analito','study_reports.orden','study_reports.id as analito_id')
            ->get();
        $calculos = AnalitoCalculo::where('study_id',$this->study_id)->get();
        return view('livewire.references', compact('analitos','referencias','calculos'));
    }

    public function mount($study_id) {
        $this->study_id = $study_id;
    }

    public function agregar($analito_id) {
        $this->analito_id = $analito_id;
        $this->sex = '';
        $this->age_in = '';
        $this->age_fin = '';
        $this->min = '';
        $this->max = '';
        $this->text = '';

    }

    public function eliminar($referencia_id) {
        $this->referencia_id = $referencia_id;
        AnalitoReference::destroy($this->referencia_id);
    }
    
    public function eliminarCalculo($calculo_id) {
        $this->calculo_id = $calculo_id;
        AnalitoCalculo::destroy($this->calculo_id);
    }

    public function guardar() {
        $this->validate();
        AnalitoReference::create([
            'analito_id' => $this->analito_id,
            'sex' => $this->sex,
            'age_in' => $this->age_in,
            'age_fin' => $this->age_fin,
            'min' => $this->min,
            'max' => $this->max,
            'text' => $this->text
        ]); 
        $this->sex = '';
        $this->age_in = '';
        $this->age_fin = '';
        $this->min = '';
        $this->max = '';
        $this->text = '';
    }

    public function agregarCalculo() {
        $this->study_id = $this->study_id;
        $this->analito_calculo = $this->analito_calculo;
        $this->calculo = $this->calculo;
        $this->decimales = $this->decimales;
        $this->formula = explode(" ", $this->calculo);
        for($i=0;$i<count($this->formula);$i++) {
            $this->formula[$i] = ($this->formula[$i]);
        }
        $join = implode("", $this->formula);
        AnalitoCalculo::create([
            'study_id' => $this->study_id,
            'analito' => $this->analito_calculo,
            'formula' => $join,
            'decimales' => $this->decimales
        ]);
        $this->analito_calculo = '';
        $this->calculo = '';
        $this->decimales = '';
    }
}