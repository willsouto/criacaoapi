<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Geo extends Model
{
    protected $hidden = ['id','address_id','updated_at','created_at'];
    protected $fillable =[
        'lat',
        'lng'
    ];
}
