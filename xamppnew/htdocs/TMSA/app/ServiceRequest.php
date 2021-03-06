<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    //
    public function ServiceRequest() {
        return $this->belongsTo('App\User');
    }

    public function Invoice() {
        return $this->hasMany('App\Invoice');
    }
}
