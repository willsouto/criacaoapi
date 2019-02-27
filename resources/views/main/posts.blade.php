<?php
use App\Post;
$posts = Post::all()->where('user_id', intval($id));
?>


@extends('template.shell')

@section('content')
    <style>
        .form-group.user-container {
            border: 2px solid #efefef;
            border-radius: 3px;
            padding: 20px;
            margin: 40px 0 70px 0;
        }
    </style>


    <h1>Posts do user de id {{$id}}:</h1>
    @foreach($posts as $post)

        <div class="form-group user-container">

            @foreach((new Post())->getFillable() as $property)
                    @if($property =='body')
                    <div class="form-group row">
                        {{ Form::label($property, ucwords($property), ['class'=>'col-sm-2 col-form-label']) }}
                        <div class="col-sm-10">
                            {{ Form::textarea('', $post->$property, ['readonly', 'class'=>'form-control','rows' => 4]) }}
                        </div>
                    </div>
                    @else
                    <div class="form-group row">
                        {{ Form::label($property, ucwords($property), ['class'=>'col-sm-2 col-form-label']) }}
                        <div class="col-sm-10">
                            {{ Form::text('', $post->$property, ['readonly', 'class'=>'form-control']) }}
                        </div>
                    </div>
                    @endif
            @endforeach
        </div>
        {!! Form::close() !!}

    @endforeach
@endsection








