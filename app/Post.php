<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $hidden = ['updated_at','created_at'];


    protected $fillable =[
      'id',
      'title',
      'body'
    ];


    public static function savePosts($jsonPosts){
        $jsonPosts = file_get_contents($jsonPosts);
        $jsonPosts = utf8_encode($jsonPosts);
        $jsonPosts = json_decode($jsonPosts, false);

        foreach($jsonPosts as $post){
            $postSave = Post::firstOrCreate(['id' => $post->id]);
            $postSave->user_id = $post->userId;
            $postSave->id = $post->id;
            $postSave->title = $post->title;
            $postSave->body = $post->body;
            $postSave->save();
        }
    }
}
