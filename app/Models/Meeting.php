<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function convocated() {
        return $this->belongsToMany('App\Models\User');
    }
}
