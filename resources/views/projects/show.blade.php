@extends('header')
@section('title')
{{$project->name}}
@endsection
@section('content')

<div class="container">
    <div class="project">
        <div style="float:left; width: 48%; overflow: auto;">
            <p><h1>{{$project->name}}</h1>({{$project->acronym}})</p>
            <div class="highlight">
            <p>
                <label style="font-weight: bold">Tipo:</label>
                {{$project->type}}
            </p>
            <p>
                <label style="font-weight: bold">Tema:</label>
                {{$project->theme}}
            </p>
            <p>
                <label style="font-weight: bold">Começado em:</label>
                {{$project->started_at}}
                </p>
            <p>
                <label style="font-weight: bold">Acabado em: </label>
                {{$project->finished_at}}
                </p>
            <p>
                <label style="font-weight: bold">Estado: </label>
                {{($project->state == '1' ? 'Aprovado' : 'Reprovado')}}
            </p>
            <p style="font-weight: bold">Criado por:</p>
            <ul>
                @foreach ($project->users as $user)
                    <li>
                        {{$user->name}}
                    </li>
                @endforeach
            </ul>
        </div>
        </div>
        <div style="float:right; margin-top: 30px; margin-right: 20px">
            <img src="{{$image}}" width="450px" height="300px"/>
        </div>
        <div style="clear:both">&nbsp;</div>
        <div>
            <div class="highlight">
                <p style="font-weight: bold">Descrição:</p>
                <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;{{$project->description}}</p>
            </div>
            <div class="highlight">
            <p style="font-weight: bold">Observations:</p>
            <p style="text-align: justify;">&nbsp;&nbsp;&nbsp;{{$project->observations}}</p>
            </div>
            <div class="highlight">
            <p style="font-weight: bold">Keywords:</p>
            <ul>
                @foreach($keywords as $keyword)
                <li>
                    <p><a href='{{url("keywords/".trim($keyword))}}'>{{trim($keyword)}}</a></p>
                </li>
                @endforeach
            </ul>
            </div>
        </div>
        </br>
        <button class="btn btn-lg" onclick="window.location='{{ URL::action('ProjectsController@gallery', $project->id) }}'">Galeria</button>
        </br>
        </br>
    </div>
</div>

@endsection