@extends('header')
@section('content')

{!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id], 'files' => true]) !!}

   @include('users.form', ['submitButton' => 'Actualizar Utilizador'])

{!! Form::close() !!}

@endsection