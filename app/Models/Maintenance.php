<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function realizo() {
        return $this->belongsTo('App\Models\User', 'made_by');
    }

    public function superviso() {
        return $this->belongsTo('App\Models\User', 'supervised_by');
    }
}
