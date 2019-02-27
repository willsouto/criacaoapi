<?php
use App\User;
$user = User::findOrFail($id);

    $user->address = $user->address;
    $user->address->geo =  $user->address->geo;
    $user->company = $user->company;


echo json_encode($user, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
?>