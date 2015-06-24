@extends('header')
@section('content')

    {!! Form::open(['method' => 'POST', 'action' => ['UsersController@store'], 'files' => true]) !!}

    @include('users.form', ['submitButton' => 'Adicionar Utilizador'])

    {!! Form::close() !!}

@endsection