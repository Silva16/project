@extends('header')
@section('content')

{!! Form::open(['method' => 'POST', 'action' => ['UsersController@store']]) !!}

   @include('users.form', ['submitButton' => 'Adicionar Utilizador'])

{!! Form::close() !!}

@endsection
@extends('footer')