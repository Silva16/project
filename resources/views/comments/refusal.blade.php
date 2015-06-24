@extends('header')
@section('content')

    {!! Form::open(['method' => 'PATCH', 'action' => ['CommentsController@refuseMessage', $comment->id]]) !!}
    <div class="container">
        {!! Form::label('message', 'Mensagem de rejeição:') !!}
        {!! Form::textarea('message', null, array('class' => 'form-control')) !!}
        <div style="margin-top: 20px" class="form-group">
            {!! Form::submit("Adicionar mensagem") !!}
        </div>
    </div>

    {!! Form::close() !!}

@endsection