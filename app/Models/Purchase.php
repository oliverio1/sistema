<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function area() {
        return $this->belongsTo('App\Models\Area');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function attended() {
        return $this->belongsTo('App\Models\User');
    }
}
