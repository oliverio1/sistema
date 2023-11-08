<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function reagent() {
        return $this->belongsTo('App\Models\Reagent');
    }

    public function provider() {
        return $this->belongsTo('App\Models\Provider');
    }
}
