<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'username', 'email','phone','website'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function address(){
        return $this->hasOne('App\Address', 'user_id');
    }

    public function company(){
        return $this->hasOne('App\Address', 'user_id');
    }

    public function post(){
        return $this->hasMany('App\Post', 'user_id');
    }



    public static function saveUsers($jsonUsers){
        $jsonUsers = file_get_contents($jsonUsers);
        $jsonUsers = utf8_encode($jsonUsers);
        $jsonUsers = json_decode($jsonUsers, false);

        foreach($jsonUsers as $user){
            $userSave = User::firstOrCreate(['id' => $user->id]);
            $userSave->id = $user->id;
            $userSave->name = $user->name;
            $userSave->username = $user->username;
            $userSave->email = $user->email;
            $userSave->phone = $user->phone;
            $userSave->website = $user->website;

                $addressSave =  Address::firstOrCreate(['user_id' => $user->id]);
                $addressSave->street = $user->address->street;
                $addressSave->suite = $user->address->suite;
                $addressSave->city = $user->address->city;
                $addressSave->zipcode = $user->address->zipcode;
                $addressSave = $userSave->address()->save($addressSave);

                    $geoSave = Geo::firstOrCreate(['address_id' => $addressSave->id]);
                    $geoSave->lat = $user->address->geo->lat;
                    $geoSave->lng = $user->address->geo->lng;
                    $addressSave->geo()->save($geoSave);


            $userSave->save();
        }
    }

}
