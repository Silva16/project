@extends('header')
@section('title')
    Lista de Utilizadores
    @endsection
@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Instituição</th>
                <th>Posição</th>
                <th>URL</th>
                <th>E-mail</th>
                <th>Role</th>
                <th>Projectos</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><img src={{$image[$user->id]}} height="100"></td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->institution->name}}</td>
                    <td>{{$user->position}}</td>
                    <td>{{$user->profile_url}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$role[$user->role]}}</td>
                    <th><a href="projects?created_by={{$user->id}}">Mostrar Projectos</a></th>
                </tr>
            @endforeach
        </table>

        <p id="demo"></p>

        {!! $users->appends(Request::except('page'))->render() !!}
    {{--{{ $users->appends(Input::except('page'))->links() }}--}}


</div>

@endsection
