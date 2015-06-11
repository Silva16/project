@extends('header')
@section('content')

{!! Form::open(['method' => 'POST', 'action' => ['MediaController@store', $id], 'files' => true]) !!}

   @include('media.form', ['submitButton' => 'Adicionar Media'])

{!! Form::close() !!}

@endsection
@extends('footer')