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

    protected $hidden = ['updated_at','created_at'];

    protected $fillable = [
        'id', 'name', 'username', 'email','phone','website'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */


    public function address(){
        return $this->hasOne('App\Address', 'user_id');
    }

    public function company(){
        return $this->hasOne('App\Company', 'user_id');
    }

    public function post(){
        return $this->hasMany('App\Post', 'user_id');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($user) {
            $user->address->geo()->delete();
            $user->address()->delete();
            $user->company()->delete();
            $user->post()->delete();
        });
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

                $companySave =  Company::firstOrCreate(['user_id' => $user->id]);
                $companySave->name = $user->company->name;
                $companySave->catchPhrase = $user->company->catchPhrase;
                $companySave->bs = $user->company->bs;
                $userSave->company()->save($companySave);


            $userSave->save();
        }
    }


    public static function saveUser($request){

            $userSave = User::firstOrCreate(['id' => $request->get('id')]);
            $userSave->name = $request->get('name');
            $userSave->username = $request->get('username');
            $userSave->email = $request->get('email');
            $userSave->phone = $request->get('phone');
            $userSave->website = $request->get('website');
            $userSave->save();

            $addressSave = Address::firstOrCreate(['user_id' => $userSave->id]);
            $addressSave->street = $request->get('address_street');
            $addressSave->suite = $request->get('address_suite');
            $addressSave->city = $request->get('address_city');
            $addressSave->zipcode = $request->get('address_zipcode');
            $userSave->address()->save($addressSave);

            $geoSave = Geo::firstOrCreate(['address_id' => $addressSave->id]);
            $geoSave->lat = $request->get('geo_lat');
            $geoSave->lng = $request->get('geo_lng');
            $addressSave->geo()->save($geoSave);

            $companySave =  Company::firstOrCreate(['user_id' => $userSave->id]);
            $companySave->user_id = $userSave->id;
            $companySave->name = $request->get('company_name');
            $companySave->catchPhrase = $request->get('company_catchPhrase');
            $companySave->bs = $request->get('company_bs');
            $userSave->company()->save($companySave);

    }

}
