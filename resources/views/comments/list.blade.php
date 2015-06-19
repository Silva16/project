@extends('header')
@section('title')
    Comentários de {{$project->name}}
@endsection
@section('content')

    <h2 style="margin-left: 10px; color: #337ab7; margin-bottom: 20px">Comentários - {{$project->name}}</h2>

    <div style="margin-left: 10px; margin-bottom: 20px">

    {!! Form::open(['method' => 'GET', 'action' => ['CommentsController@index', $project->id]]) !!}

            <select name="filter" id="filter" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($filter == "All") selected="selected" @endif value="All" selected>Todos as comentários</option>
                <option @if($filter == "Approved") selected="selected" @endif value="Approved">Comentários Aprovadas</option>
                <option @if($filter == "Pending") selected="selected" @endif value="Pending">Comentários Pendentes</option>
                <option @if($filter == "Refused") selected="selected" @endif value="Refused">Comentários Recusados</option>
            </select>

            <select name="sort" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($sort == "Created") selected="selected" @endif value="Created">Data de criação</option>
            </select>

            <select name="order" onchange="" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($order == "Ascendant") selected="selected" @endif value="Ascendant">Ascendente</option>
                <option @if($order == "Descendant") selected="selected" @endif value="Descendant">Descendente</option>
            </select>
            <input class="btn" type="submit" value="Filtrar"/>
    {!! Form::close() !!}

    </div>

    <div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
            @if ($user->role == 2)
                <th>Acção</th>
            @endif
            <th>Comentário</th>
            <th>Criado por</th>
            <th>Estado</th>
            <th>Aprovado por</th>
            <th>Mensagem de rejeição</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($comments as $comment)
        <tr>
            @if ($user->role == 2 && $comment->state == 2)
            <td>
                <div style="margin-bottom: 10px">
                {!! Form::open(['method' => 'POST', 'action' => ['CommentsController@approve', $comment->id]]) !!}
                {!! Form::submit('Aprovar') !!}
                {!! Form::close() !!}
                </div>
                {!! Form::open(['method' => 'GET', 'action' => ['CommentsController@refuse', $comment->id]]) !!}
                {!! Form::submit('Rejeitar') !!}
                {!! Form::close() !!}
            </td>
            @else
                <td><hr width="82%"></td>
            @endif
            <td>{{$comment->comment}}</td>
            @if (array_key_exists($comment->id, $user_name))
                <td>{{$user_name[$comment->id]}}</td>
            @else
                <td>{{"Visitante"}}</td>
            @endif
            @if($comment->state == 0)
                <td style="color: red; font-weight: bold">Recusado</td>
            @elseif($comment->state == 1)
                <td style="color: green; font-weight: bold">Aprovado</td>
            @elseif($comment->state == 2)
                <td style="color: #FFCC00; font-weight: bold">Pendente</td>
            @endif
            @if (array_key_exists($comment->id, $approved_by))
                <td>{{$approved_by[$comment->id]}}</td>
            @else
                <td><hr align="center" width="82%"></td>
            @endif
            @if ($comment->refusal_msg != null)
                <td>{{$comment->refusal_msg}}</td>
            @else
                <td><hr align="center" width="82%"></td>
            @endif
        </tr>
    @endforeach
</table>


</div>

@endsection