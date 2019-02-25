@extends('template.shell')

@section('content')


    <h1>Guardar Json</h1>
    @if (Request::isMethod('post'))

{{--                {{$post}}--}}


    @endif

    {!! Form::open(['method'=>'POST', 'action'=> 'JsonController@store']) !!}

    <div class="form-group">
        {!! Form::label('title', 'Users:') !!}
        {!! Form::text('users','', ['class'=>'form-control']) !!}
        {!! Form::label('title', 'Posts:') !!}
        {!! Form::text('posts','', ['class'=>'form-control']) !!}
    </div>
    {{csrf_field()}}



    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}


    {!! Form::close() !!}


@endsection



