<?php
use App\User;
$user = User::findOrFail($id);
$posts = $user->post;
echo json_encode($posts, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
?>