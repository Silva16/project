@extends('header')
@section('title')
    Lista de Utilizadores
    @endsection
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th><a href="?sort=id">ID</a></th>
                <th>Foto</th>
                <th><a href="?sort=name">Nome</a></th>
                <th><a href="?sort=institution_id">Instituição</a></th>
                <th><a href="?sort=position">Posição</a></th>
                <th>URL</th>
                <th>E-mail</th>
                <th><a href="?sort=role">Role</a></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>{!! Form::open(['method' => 'GET', 'action' => ['UsersController@index']]) !!}
                <td>{!!Form::text('id')!!}</td>
                <td></td>
                <td>{!!Form::text('name')!!}</td>
                <td>{!!Form::select('institution', $institutions, 0);!!}</td>
                <td>{!!Form::text('position')!!}</td>
                <td></td>
                <td>{!!Form::text('email')!!}</td>
                <td>{!!Form::select('role', $role, 0);!!}</td>
                <td>{!!Form::Submit('Procurar')!!}</td>
                {!! Form::close() !!}
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img src="{{$image[$user->id]}}" height="100"/></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->institution->name}}</td>
                    <td>{{$user->position}}</td>
                    <td><a href="{{$user->profile_url}}">{{$user->profile_url}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$role[$user->role]}}</td>
                    <td><a href="projects?created_by={{$user->id}}">Mostrar Projectos</a></td>
                </tr>
            @endforeach
        </table>

        <p id="demo"></p>

        {!! $users->appends(Request::except('page'))->render() !!}



</div>

@endsection
