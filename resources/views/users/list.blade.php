@extends('header')
@section('content')


{!! Form::open(['method' => 'GET', 'action' => ['UsersController@create']]) !!}
{!! Form::submit('Adicionar') !!}
{!! Form::close() !!}


<div class="container">
<table class="table-bordered">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Email Alternativo</th>
            <th>Instituição</th>
            <th>Posição</th>
            <th>Foto</th>
            <th>Perfil</th>
            <th>Função</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->alt_email}}</td>
            <td>{{$user->institution->name}}</td>
            <td>{{$user->position}}</td>
            <td>{{$user->photo_url}}</td>
            <td>{{$user->profile_url}}</td>
            <td>{{$user->role}}</td>
            <td>
                {!! Form::open(['method' => 'GET', 'action' => ['UsersController@edit', $user->id]]) !!}
                {!! Form::submit('Editar') !!}
                {!! Form::close() !!}
            </td>
            {{--<td>
                {!! Form::open(array('route' => 'destroy_user', 'method' => 'POST' )) !!}
                {!! Form::submit('Apagar') !!}
                {!! Form::close() !!}
            </td>--}}
        </tr>
    @endforeach
</table>
</div>

@endsection
@extends('footer')