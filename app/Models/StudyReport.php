<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyReport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function references() {
        return $this->hasMany('App\Models\AnalitoReference', 'analito_id');
    }

    public function study() {
        return $this->belongsTo('App\Models\Study');
    }
}
