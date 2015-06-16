@extends('header')
@section('title')
    Criar conta de utilizador
@endsection
@section('content')

    {!! Form::open(['method' => 'POST', 'action' => ['ProjectsController@store'], 'files' => true]) !!}

    @include('projects.form', ['submitButton' => 'Adicionar Projecto'])
    {{--{!! Form::open(array('route' => 'store_project', 'method' => 'POST' )) !!}--}}

    {!! Form::close() !!}

@endsection