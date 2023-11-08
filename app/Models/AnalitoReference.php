<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalitoReference extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function analito() {
        return $this->belongsTo('App\Models\StudyReport');
    }

    public function calculos() {
        return $this->hasMany('App\Models\AnalitoCalculo', 'analito_id');
    }
}
