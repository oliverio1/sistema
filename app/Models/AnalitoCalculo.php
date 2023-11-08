<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalitoCalculo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function analito() {
        return $this->belongsTo('App\Models\AnalitoReference');
    }
}
