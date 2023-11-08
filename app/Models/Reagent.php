<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reagent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function area() {
        return $this->belongsTo('App\Models\Area');
    }
}
