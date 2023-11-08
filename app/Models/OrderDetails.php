<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function details() {
        return $this->belongsTo('App\Models\Order');
    }

    public function results() {
        return $this->hasMany('App\Models\OrderResults', 'order_id');
    }
}
