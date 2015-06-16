@extends('header')
@section('title')
{{$project->name}}
@endsection
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
            <p style="font-weight: bold">Criado por:</p>
            <ul>
                @foreach ($project->users as $user)
                    <li>
                        {{$user->name}}
                    </li>
                @endforeach
            </ul>
        </div>
        <div style="float:right; width: 48%;">
            <img src="{{$image}}" width="450px" height="300px"/>
        </div>
        <div style="clear:both">&nbsp;</div>
        <div>
            <p style="font-weight: bold">Descrição:</p>
            <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;{{$project->description}}</p>
            <p style="font-weight: bold">Observations:</p>
            <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;{{$project->observations}}</p>
            <p style="font-weight: bold">Keywords:</p>
            <ul>
                @foreach($keywords as $keyword)
                <li>
                    <p><a href='{{url("keywords/".trim($keyword))}}'>{{trim($keyword)}}</a></p>
                </li>
                @endforeach
            </ul>
        </div>
        </br>
        <button class="btn btn-lg" onclick="window.location='{{ URL::action('ProjectsController@gallery', $project->id) }}'">Galeria</button>
    </div>
</div>

@endsection