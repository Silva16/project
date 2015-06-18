@extends('header')
@section('content')

{!! Form::model($project, ['method' => 'PATCH', 'action' => ['ProjectsController@update', $project->id], 'files' => true]) !!}

   @include('projects.form', ['submitButton' => 'Actualizar Projecto'])

{!! Form::close() !!}

@endsection