<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientOrder extends Model
{

    public function ServiceRequest() {
        return $this->belongsTo('App\User');
    }
}
