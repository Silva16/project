@extends('header')
@section('title')
    Dashboard de {{$user->name}}
@endsection
@section('content')

    <h1 style="margin-left: 10px; color: #337ab7; margin-bottom: 20px">Dashboard</h1>

    <div style="margin-left: 10px; margin-bottom: 20px">

    {!! Form::open(['method' => 'GET', 'action' => ['DashboardController@index']]) !!}

            <select name="filter" id="filter" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($filter == "All") selected="selected" @endif value="All" selected>Todos os projectos</option>
                @if ($user->role == 2)
                    <option @if($filter == "Mine") selected="selected" @endif value="Mine">Os meus projectos</option>
                @endif
                <option @if($filter == "Approved") selected="selected" @endif value="Approved">Projetos Aprovados</option>
                <option @if($filter == "Pending") selected="selected" @endif value="Pending">Projectos Pendentes</option>
                <option @if($filter == "Refused") selected="selected" @endif value="Refused">Projectos Recusados</option>
            </select>

            <select name="sort" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($sort == "Name") selected="selected" @endif value="Name" selected>Nome do Projeto</option>
                <option @if($sort == "Acronym") selected="selected" @endif value="Acronym">Acronimo</option>
                <option @if($sort == "Type") selected="selected" @endif value="Type">Tipo</option>
                <option @if($sort == "Theme") selected="selected" @endif value="Theme">Tema</option>
                <option @if($sort == "Started") selected="selected" @endif value="Started">Data de criação</option>
                <option @if($sort == "Updated") selected="selected" @endif value="Updated">Data de atualização</option>
            </select>

            <select name="order" onchange="" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($order == "Ascendant") selected="selected" @endif value="Ascendant">Ascendente</option>
                <option @if($order == "Descendant") selected="selected" @endif value="Descendant">Descendente</option>
            </select>
            <input class="btn" type="submit" value="Filtrar"/>
    {!! Form::close() !!}

    </div>

    <div style="margin-left: 10px">

    {!! Form::open(['method' => 'GET', 'action' => ['ProjectsController@create']]) !!}
    {!! Form::submit('Adicionar Projecto', array('class' => 'btn btn-lg')) !!}
    {!! Form::close() !!}

    </div>

    <div class="table-responsive" style="overflow: scroll">
    <table class="table">
        <thead>
            <tr>
                @if ($user->role == 2)
                    <th>Acção</th>
                @endif
                <th>Nome</th>
                <th>Acrónimo</th>
                <th>Tipo</th>
                <th>Tema</th>
                <th>Descrição</th>
                <th>Mídia</th>
                <th>Comentários</th>
                <th>Palavras-Chave</th>
                <th>Iniciado</th>
                <th>Finalizado</th>
                <th>Criado por</th>
                <th>Actualizado por</th>
                <th>Observações</th>
                <th>Software</th>
                <th>Hardware</th>
                <th>Estado</th>
                <th>Aprovado por</th>
                <th>Mensagem de Rejeição</th>
                <th>Editar</th>
                <th>Apagar</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($projects as $project)

            <tr>
                @if ($user->role == 2 && $project->state == 2)
                <td>
                    <div style="margin-bottom: 10px">
                    {!! Form::open(['method' => 'POST', 'action' => ['ProjectsController@approve', $project->id]]) !!}
                    {!! Form::submit('Aprovar') !!}
                    {!! Form::close() !!}
                    </div>
                    {!! Form::open(['method' => 'GET', 'action' => ['ProjectsController@refuse', $project->id]]) !!}
                    {!! Form::submit('Rejeitar') !!}
                    {!! Form::close() !!}
                </td>
                @endif
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
                <td>
                    {!! Form::open(['method' => 'GET', 'action' => ['CommentsController@index', $project->id]]) !!}
                    {!! Form::submit('Comentários') !!}
                    {!! Form::close() !!}
                </td>
                <td>{{$project->keywords}}</td>
                <td>{{$project->started_at}}</td>
                @if ($project->finished_at != null)
                    <td>{{$project->finished_at}}</td>
                @else
                    <td><hr align="center" width="82%"></td>
                @endif
                <td>{{$created_by[$project->id]}}</td>
                <td>{{$updated_by[$project->id]}}</td>
                @if ($project->observations != null)
                    <td>{{$project->observations}}</td>
                @else
                    <td><hr align="center" width="82%"></td>
                @endif
                @if ($project->used_software != null)
                    <td>{{$project->used_software}}</td>
                @else
                    <td><hr align="center" width="82%"></td>
                @endif
                @if ($project->used_hardware != null)
                    <td>{{$project->used_hardware}}</td>
                @else
                    <td><hr align="center" width="82%"></td>
                @endif
                @if($project->state == 0)
                    <td style="color: red; font-weight: bold">Recusado</td>
                @elseif($project->state == 1)
                    <td style="color: green; font-weight: bold">Aprovado</td>
                @elseif($project->state == 2)
                    <td ><p style="color: #FFCC00; font-weight: bold">Pendente</p>
                    </td>
                @endif
                @if (array_key_exists($project->id, $approved_by))
                    <td>{{$approved_by[$project->id]}}</td>
                @else
                    <td><hr align="center" width="82%"></td>
                @endif
                @if ($project->refusal_msg != null)
                    <td>{{$project->refusal_msg}}</td>
                @else
                    <td><hr align="center" width="82%"></td>
                @endif
                <td>
                    {!! Form::open(['method' => 'GET', 'action' => ['ProjectsController@edit', $project->id]]) !!}
                    {!! Form::submit('Editar') !!}
                    {!! Form::close() !!}
                </td>
                <td>
                    {!! Form::open(['method' => 'DELETE', 'action' => ['ProjectsController@destroy', $project->id]]) !!}
                    {!! Form::submit('Apagar') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>


    </div>


@endsection