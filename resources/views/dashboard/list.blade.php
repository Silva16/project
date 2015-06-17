@extends('header')
@section('title')
    Dashboard de {{$user->name}}
@endsection
@section('content')



    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Acrónimo</th>
                <th>Tipo</th>
                <th>Tema</th>
                <th>Descrição</th>
                <th>Media</th>
                <th>Palavras-Chave</th>
                <th>Iniciado</th>
                <th>Desenvolvido até</th>
                <th>Finalizado</th>
                <th>Criado por</th>
                <th>Actualizado por</th>
                <th>Observações</th>
                <th>Software</th>
                <th>Hardware</th>
                <th>Estado</th>
                <th>Mensagem de Rejeição</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($user->projects as $project)
            <tr>
                <td>{{$project->name}}</td>
                <td>{{$project->acronym}}</td>
                <td>{{$project->type}}</td>
                <td>{{$project->theme}}</td>
                <td>{{$project->description}}</td>
                <td>
                    {!! Form::open(['method' => 'GET', 'action' => ['MediaController@index', $project->id]]) !!}
                    {!! Form::submit('Ficheiros') !!}
                    {!! Form::close() !!}
                </td>
                <td>{{$project->keywords}}</td>
                <td>{{$project->started_at}}</td>
                <td>{{$project->featured_until}}</td>
                <td>{{$project->finished_at}}</td>
                <td>{{$project->created_by}}</td>
                <td>{{$project->updated_by}}</td>
                <td>{{$project->observations}}</td>
                <td>{{$project->used_software}}</td>
                <td>{{$project->used_hardware}}</td>
                <td>{{$project->state}}</td>
                <td>{{$project->refusal_msg}}</td>
            </tr>
        @endforeach
    </table>


    </div>


@endsection