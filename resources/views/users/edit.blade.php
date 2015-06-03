@extends('app')
@section('content')

{!! Form::model($user, ['method' => 'PATCH', 'action' => ['UsersController@update', $user->id]]) !!}

   @include('users.form', ['submitButton' => 'Actualizar Utilizador'])

{!! Form::close() !!}

@endsection