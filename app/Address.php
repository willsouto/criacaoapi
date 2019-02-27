<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $hidden = ['id','user_id','updated_at','created_at'];

    protected $fillable = [
        'street',
        'suite',
        'city',
        'zipcode',
    ];
    public function geo(){
        return $this->hasOne('App\Geo', 'address_id');
    }
}
