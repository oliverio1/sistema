<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function area() {
        return $this->belongsTo('App\Models\Area');
    }

    public function indications() {
        return $this->belongsToMany('App\Models\Indication');
    }

    public function containers() {
        return $this->belongsToMany('App\Models\Container');
    }

    public function specimens() {
        return $this->belongsToMany('App\Models\Specimen');
    }

    public function provider() {
        return $this->belongsTo('App\Models\Provider');
    }
    
    public function studies() {
        return $this->belongsToMany('App\Models\Profile','profile_id');
    }

    public function clients() {
        return $this->belongsToMany('App\Models\Client');
    }
    
    public function reports() {
        return $this->hasMany('App\Models\StudyReport');
    }
}
