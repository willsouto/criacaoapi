<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function geo(){
        return $this->hasOne('App\Geo', 'address_id');
    }
}
