<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function studies() {
        return $this->belongsToMany('App\Models\Study')->withPivot('id');
    }

    public function client() {
        return $this->belongsTo('App\Models\Client');
    }

    public function medic() {
        return $this->belongsTo('App\Models\Medic');
    }

    public function details() {
        return $this->hasMany('App\Models\OrderDetails');
    }
}
