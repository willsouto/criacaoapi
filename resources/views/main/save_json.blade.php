@extends('template.shell')

@section('content')


    <h1>Guardar Json</h1>

    @if (Request::isMethod('post'))
        <p class="alert alert-success">Dados salvos</p>
    @endif

    {!! Form::open(['method'=>'POST', 'action'=> 'JsonController@store']) !!}
    {{csrf_field()}}
        <div class="form-group">
            {!! Form::label('title', 'Users:') !!}
            {!! Form::text('users','http://jsonplaceholder.typicode.com/users', ['class'=>'form-control']) !!}
            {!! Form::label('title', 'Posts:') !!}
            {!! Form::text('posts','http://jsonplaceholder.typicode.com/posts', ['class'=>'form-control']) !!}
        </div>

        <p class="alert alert-danger" style="display: none">Preencha ao menos um campo</p>

        {!! Form::button('Salvar', ['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}

    <script>
        $("button").click(function() {
            if($(".form-group input:eq(0)").val()==""&&$(".form-group input:eq(1)").val()=="") {$(".alert-danger").show()}
            else{ $("form").submit(); }
        });
    </script>
@endsection



