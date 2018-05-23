<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carrierResource extends Model
{
    //

    public function CarrierResource() {
        return $this->belongsTo('App\User');
    }

    public function Invoice() {
        return $this->hasMany('App\Invoice');
    }
}
