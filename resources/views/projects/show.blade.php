@extends('header')
@section('content')

<div class="container">
    <div class="project">
        <div style="float:left; width: 48%; overflow: auto;">
            <p><h1>{{$project->name}}</h1>({{$project->acronym}})</p>
            <p>Tipo: {{$project->type}}</p>
            <p>Tema: {{$project->theme}}</p>
            <p>Começado em: {{$project->started_at}}</p>
            <p>Acabado em: {{$project->finished_at}}</p>
            <p>Estado: {{($project->state == '1' ? 'Aprovado' : 'Reprovado')}}</p>
            <p>Criado por:</p>
            <ul>
                <li>
                    <p>{{$created_by->name}}</p>
                </li>
            </ul>
        </div>
        <div style="float:right; width: 48%;">
            <img src="http://digitalsynopsis.com/wp-content/uploads/2013/12/lorem-ipsum-1.gif"/>
        </div>
        <div style="clear:both">&nbsp;</div>
        <div>
            <p>Descrição:</p>
            <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;{{$project->description}}</p>
            <p>Observations:</p>
            <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;{{$project->observations}}</p>
            <p>Keywords:</p>
            <ul>
                @foreach($keywords as $keyword)
                <li>
                    <p><a href='#'>{{$keyword}}</a></p>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
@extends('footer')