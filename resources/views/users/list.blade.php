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
            <th>URL</th>
            <th>Função</th>
            <th>Estado</th>
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
            <td><img src={{$image[$user->id]}} height="100"></td>
            {{--<td><img alt="Foto de Perfil" src={{base_path() . '/storage/app/imgs/' . $user->photo_url}}</td>--}}
            <td>{{$user->profile_url}}</td>
            <td>{{$role[$user->role]}}</td>
            <td>
                {{--{!! Form::open(array('url' => ' ')) !!}
                {!! Form::checkbox('Estado', $user->flags, false, ['onClick' => 'this.form.submit']) !!}
                {!! Form::close() !!}--}}
            </td>
            <td>
                {!! Form::open(['method' => 'GET', 'action' => ['UsersController@edit', $user->id]]) !!}
                {!! Form::submit('Editar') !!}
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE', 'action' => ['UsersController@destroy', $user->id]]) !!}
                {!! Form::submit('Apagar') !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>


</div>

@endsection
@extends('footer')