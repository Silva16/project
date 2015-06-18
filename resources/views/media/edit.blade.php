@extends('header')
@section('content')

{!! Form::model($media, ['method' => 'PATCH', 'action' => ['MediaController@update', $media->id], 'files' => true]) !!}

   @include('media.form', ['submitButton' => 'Actualizar Mídia'])

{!! Form::close() !!}

@endsection