@extends('header')
@section('title')
    Lista de Projectos
@endsection
@section('content')

    {{--<script>

        function projectimg() {
            document.getElementById("teste").src = "css/imagens/cleal.jpg";
        }
    </script>--}}


    <div class="container">
        {!! Form::open(['method' => 'GET', 'action' => ['ProjectsController@index']]) !!}
        <select name="sort" class="form-control" style="width: 200px; float: left; margin-right: 10px">
            <option @if($sort == "Author") selected="selected" @endif value="Author">Nome do Autor</option>
            <option @if($sort == "Date") selected="selected" @endif value="Date">Data de criação</option>
            <option @if($sort == "Project") selected="selected" @endif value="Project" selected>Nome do Projeto</option>
            <option @if($sort == "Last Update") selected="selected" @endif value="Last Update">Data de atualização
            </option>
        </select>

        <select name="order" onchange="" class="form-control" style="width: 200px; float: left; margin-right: 10px">
            <option @if($order == "Ascendant") selected="selected" @endif value="Ascendant">Ascendente</option>
            <option @if($order == "Descendant") selected="selected" @endif value="Descendant">Descendente</option>
        </select>
        <input class="btn" type="submit" value="Ordenar"/>
        {!! Form::close() !!}

        </br>

        @foreach($projects as $project)
            <div id="artigo">
                <section>
                    <article id="articles">
                        <figure style="float:right; width: 48%" class="imgproj">
                            <img alt="" src="{{$image[$project->id]}}" width="350px" height="210px"/>
                        </figure>
                        <div style="width: 48%" id="projects">
                            <h1>{!! HTML::linkAction('ProjectsController@show', $project->name, array($project->id))
                                !!}</h1>
                            <h6><label style="font-weight: bold">Criado em:</label> {{$project->started_at}}</h6>

                            <p style="text-align: justify; text-justify: inter-word;  line-height: 1.5em; height: 9em; overflow: hidden;">
                                {{$project->description}}
                                {!! HTML::linkAction('ProjectsController@show', 'Ler mais', array($project->id)) !!}
                            </p>

                            <p style="font-weight: bold;">{{$created_by[$project->id]}}</p>

                        </div>
                        <hr align="left" width="82%">
                    </article>
                </section>
            </div>
        @endforeach

        <p id="demo"></p>

        {!! $projects->appends(Request::except('page'))->render() !!}

    </div>

@endsection