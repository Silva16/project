@extends('header')
@section('title')
    Media de {{$project->name}}
@endsection
@section('content')

    <h2 style="margin-left: 10px; color: #337ab7; margin-bottom: 20px">Multimédia - {{$project->name}}</h2>

    <div style="margin-left: 10px; margin-bottom: 20px">

    {!! Form::open(['method' => 'GET', 'action' => ['MediaController@index', $project->id]]) !!}

            <select name="filter" id="filter" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($filter == "All") selected="selected" @endif value="All" selected>Todos as mídias</option>
                <option @if($filter == "Approved") selected="selected" @endif value="Approved">Mídias Aprovadas</option>
                <option @if($filter == "Pending") selected="selected" @endif value="Pending">Mídias Pendentes</option>
                <option @if($filter == "Refused") selected="selected" @endif value="Refused">Mídias Recusadas</option>
            </select>

            <select name="sort" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($sort == "Title") selected="selected" @endif value="Title" selected>Titulo do mídia</option>
                <option @if($sort == "Mime") selected="selected" @endif value="Mime">Tipo de mídia</option>
                <option @if($sort == "File") selected="selected" @endif value="File">Nome do ficheiro</option>
                <option @if($sort == "Created") selected="selected" @endif value="Created">Data de criação</option>
                <option @if($sort == "Updated") selected="selected" @endif value="Updated">Data de atualização</option>
            </select>

            <select name="order" onchange="" class="form-control" style="width: 200px; float: left; margin-right: 10px">
                <option @if($order == "Ascendant") selected="selected" @endif value="Ascendant">Ascendente</option>
                <option @if($order == "Descendant") selected="selected" @endif value="Descendant">Descendente</option>
            </select>
            <input class="btn" type="submit" value="Filtrar"/>
    {!! Form::close() !!}

    </div>

    <div style="margin-left: 10px; margin-bottom: 20px">

            {!! Form::open(['method' => 'GET', 'action' => ['MediaController@create', $project->id]]) !!}
            {!! Form::submit('Adicionar') !!}
            {!! Form::close() !!}

    </div>






    <div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
            @if ($user->role == 2)
                <th>Acção</th>
            @endif
            <th>Titulo</th>
            <th>Titulo Alternativo</th>
            <th>Descrição</th>
            <th>Tipo</th>
            <th>Referência Externa</th>
            <th>Nome do ficheiro</th>
            <th>Ficheiro</th>
            <th>Criado por</th>
            <th>Estado</th>
            <th>Aprovado por</th>
            <th>Mensagem de rejeição</th>
            <th>Editar</th>
            <th>Apagar</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($medias as $media)
        <tr>
            @if ($user->role == 2 && $media->state == 2)
            <td>
                <div style="margin-bottom: 10px">
                {!! Form::open(['method' => 'POST', 'action' => ['MediaController@approve', $media->id]]) !!}
                {!! Form::submit('Aprovar') !!}
                {!! Form::close() !!}
                </div>
                {!! Form::open(['method' => 'GET', 'action' => ['MediaController@refuse', $media->id]]) !!}
                {!! Form::submit('Rejeitar') !!}
                {!! Form::close() !!}
            </td>
            @else
                <td><hr width="82%"></td>
            @endif
            <td>{{$media->title}}</td>
            <td>{{$media->alt}}</td>
            <td>{{$media->description}}</td>
            @if (in_array($media->mime_type, $image_type, true))
                <td>Imagem</td>
            @elseif($media->mime_type == 'application/pdf')
                <td>Documento</td>
            @elseif($media->mime_type == 'video/youtube')
                <td>Youtube Url</td>
            @endif
            @if($media->mime_type == 'video/youtube')
                <td><a href="https://www.youtube.com/watch?v={{$media->ext_url}}">https://www.youtube.com/watch?v={{$media->ext_url}}</a></td>
            @else
                <td><a href="{{$media->ext_url}}">{{$media->ext_url}}</a></td>
            @endif
            <td>{{$media->int_file}}</td>
            @if (in_array($media->mime_type, $image_type))
                <td align="center"><img src="{{$file[$media->id]}}" height="100"></td>
            @elseif($media->mime_type == 'application/pdf')
                <td align="center">
                    {!! html_entity_decode(HTML::linkAction('MediaController@showProject', HTML::image($pdfLogo, "Logo"), array(basename($media->int_file)))) !!}
                </td>
            @else
            <td></td>
            @endif
            <td>{{$created_by[$media->id]}}</td>
            @if($media->state == 0)
                <td style="color: red; font-weight: bold">Recusado</td>
            @elseif($media->state == 1)
                <td style="color: green; font-weight: bold">Aprovado</td>
            @elseif($media->state == 2)
                <td style="color: #FFCC00; font-weight: bold">Pendente</td>
            @endif
            @if ($approved_by[$media->id] != null)
                <td>{{$approved_by[$media->id]}}</td>
            @else
                <td><hr align="center" width="82%"></td>
            @endif
            @if ($media->refusal_msg != null)
                <td>{{$media->refusal_msg}}</td>
            @else
                <td><hr align="center" width="82%"></td>
            @endif
            <td>
                {!! Form::open(['method' => 'GET', 'action' => ['MediaController@edit', $media->id]]) !!}
                {!! Form::submit('Editar') !!}
                {!! Form::close() !!}
            </td>
            <td>
                {!! Form::open(['method' => 'DELETE', 'action' => ['MediaController@destroy', $media->id]]) !!}
                {!! Form::submit('Apagar') !!}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
</table>


</div>

@endsection