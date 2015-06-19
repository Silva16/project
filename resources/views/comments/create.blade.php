@extends('header')
@section('title')
    Criar comentário
@endsection
@section('content')

    {!! Form::open(['method' => 'POST', 'action' => ['CommentsController@store', $id]]) !!}

         <div class="container">
             {!! Form::label('comment', 'Comentário:') !!}
             {!! Form::textarea('comment', null, array('class' => 'form-control')) !!}
             <div style="margin-top: 20px" class="form-group">
                 {!! Form::submit("Adicionar comentário", array('class' => 'btn btn-lg')) !!}
             </div>
         </div>

    {!! Form::close() !!}

@endsection