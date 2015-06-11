@extends('header')
@section('content')

{!! Form::open(['method' => 'GET', 'action' => ['MediaController@create', $project->id]]) !!}
{!! Form::submit('Adicionar') !!}
{!! Form::close() !!}

    <h2>Multimédia - {{$project->name}}</h2>




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
        <tr>
            <td>{{$media->title}}</td>
            <td>{{$media->alt}}</td>
            <td>{{$media->description}}</td>
                @if (in_array($media->mime_type, $mimetype, true))
                    <td>Imagem</td>
                @endif
            <td>{{$media->ext_url}}</td>
            <td>{{$media->int_file}}</td>
            <td><img src={{$image[$media->id]}} height="100"></td>
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
@extends('footer')