<?php
use App\User;
    $users = User::all();
    $obj =  new ArrayObject();

    foreach($users as $user){
        $user->address = $user->address;
        $user->address->geo =  $user->address->geo;
        $user->company = $user->company;
        $obj->append($user);
    }

echo json_encode((array) $obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
?>