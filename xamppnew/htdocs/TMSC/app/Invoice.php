<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //

    public function ServiceRequest() {
        return $this->belongsTo('App\Invoice');
    }

    public function CarrierResource() {
        return $this->belongsTo('App\carrierResource');
    }

}
