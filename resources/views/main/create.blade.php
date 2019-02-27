<?php
use App\User;
use App\Address;
use App\Geo;
use App\Company;
$users = User::all();
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

    <h1>Cadastrar usuario:</h1>
    <?php if(!empty($user))
        echo '<p class="alert alert-success">'.$user.'</p>';
    ?>


    {!! Form::open(['method'=>'GET', 'action'=> 'UsersController@create']) !!}
    <div class="form-group user-container">

        @foreach((new User())->getFillable() as $property)
            @if($property == 'id')
            @else
                <div class="form-group row">
                    {{ Form::label($property, ucwords($property), ['class'=>'col-sm-2 col-form-label']) }}
                    <div class="col-sm-10">
                        {{ Form::text($property,'', ['class'=>'form-control']) }}
                    </div>
                </div>
            @endif
        @endforeach
        <p class="alert alert-light">Address:</p>
        {{--            Address--}}
        @foreach((new Address())->getFillable() as $property)
            <div class="form-group row">

                {{ Form::label($property, ucwords($property), ['class'=>'col-sm-2 col-form-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('address_'.$property,'', ['class'=>'form-control']) }}
                </div>  </div>
        @endforeach
        {{--            Geo--}}
        <p>Geo:</p>
        @foreach((new Geo())->getFillable() as $property)
            <div class="form-group row">

                {{ Form::label($property, ucwords($property), ['class'=>'col-sm-2 col-form-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('geo_'.$property,'', ['class'=>'form-control']) }}
                </div></div>
        @endforeach
        {{--            Company--}}
        <p class="alert alert-light">Company:</p>
        @foreach((new Company())->getFillable() as $property)
            <div class="form-group row">

                {{ Form::label($property, ucwords($property), ['class'=>'col-sm-2 col-form-label']) }}
                <div class="col-sm-10">
                    {{ Form::text('company_'.$property,'', ['class'=>'form-control']) }}
                </div>  </div>
        @endforeach

        {{csrf_field()}}

        <p class="border-top my-4"></p>

        {!! Form::submit('Salvar', ['class'=>'btn btn-primary', 'name' => 'save']) !!}


    </div>
    {!! Form::close() !!}





@endsection




