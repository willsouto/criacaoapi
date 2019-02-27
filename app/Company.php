<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $hidden = ['id','user_id','updated_at','created_at'];
    protected $fillable = [
        'name',
        'catchPhrase',
        'bs',
    ];
}
