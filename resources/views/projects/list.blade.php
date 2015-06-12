@extends('header')
@section('content')

{{--<script>

    function projectimg() {
        document.getElementById("teste").src = "css/imagens/cleal.jpg";
    }
</script>--}}


    <div class="container">
        <h5 style="color: #286090; font-weight: bold; margin-left: 2px">Ordenar por:</h5>
        {!! Form::open(['method' => 'POST', 'action' => ['ProjectsController@filter']]) !!}
         <select name="filter" onchange="this.form.submit()" class="form-control" style="width: 200px">
            <option value="Author">Autor</option>
            <option value="Date">Data</option>
            <option value="Project">Projeto</option>
        </select>
        {!! Form::close() !!}

        @foreach($projects as $project)
        <div id="artigo">
            <section>
                <article id="articles">
                    <figure style="float:right; width: 48%" class="imgproj">
                        <img alt="" src="{{$image[$project->id]}}" width="350px" height="210px"/>
                    </figure>
                    <div style="width: 48%" id="projects">
                        <h1>{{$project->name}}</h1>
                        <h6>{{$project->started_at}}</h6>
                        <p style="text-align: justify; text-justify: inter-word;  line-height: 1.5em; height: 9em; overflow: hidden;">
                            {{$project->description}}
                            {!! HTML::linkAction('ProjectsController@show', 'Ler mais', array($project->id)) !!}
                        </p>
                        <p style="font-weight: bold;">{{$created_by[$project->id]}}</p>
                        </br>
                        {{--@foreach($project->users as $user)
                            <p style="font-weight: bold;">{{$user->name}}</p>
                        @endforeach--}}
                    </div>
                </article>
            </section>
        </div>
        @endforeach

        <p id="demo"></p>

        {!! $projects->render() !!}

    </div>



@endsection
@extends('footer')