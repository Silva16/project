@extends('header')
@section('title')
    Media de {{$project->name}}
@endsection
@section('content')

{!! Form::open(['method' => 'GET', 'action' => ['MediaController@create', $project->id]]) !!}
{!! Form::submit('Adicionar') !!}
{!! Form::close() !!}

    <h2 style="margin-left: 10px">Multimédia - {{$project->name}}</h2>




    <div class="table-responsive">
    <table class="table">
    <thead>
        <tr>
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
        <tr >
            <td>{{$media->title}}</td>
            <td>{{$media->alt}}</td>
            <td>{{$media->description}}</td>
            @if (in_array($media->mime_type, $image_type, true))
                <td>Imagem</td>
            @elseif($media->mime_type == 'application/pdf')
                <td>Documento</td>
            @endif
            <td>{{$media->ext_url}}</td>
            <td>{{$media->int_file}}</td>
            @if (in_array($media->mime_type, $image_type))
                <td align="center"><img src="{{$file[$media->id]}}" height="100"></td>
            @elseif($media->mime_type == 'application/pdf')
                <td align="center">
                    {!! html_entity_decode(HTML::linkAction('MediaController@showProject', HTML::image($pdfLogo, "Logo"), array(basename($media->int_file)))) !!}
                </td>
            @endif
            <td>{{$media->created_by}}</td>
            <td>{{$media->state}}</td>
            <td>{{$media->approved_by}}</td>
            <td>{{$media->refusal_msg}}</td>
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