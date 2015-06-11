@extends('header')
@section('content')

<script>

    function projectimg() {
        document.getElementById("teste").src = "css/imagens/cleal.jpg";
    }
</script>
    <div class="container">
        @foreach($projects as $project)
        <div id="artigo">
            <section >
                <article id="articles">
                    <figure style="float:right; width: 48%" class="imgproj">
                        <img id="teste" alt="" src="" width="350px" height="210px"/>
                    </figure>
                    <div style="width: 48%" id="projects">
                        <h1>{{$project->name}}</h1>
                        <h6>{{$project->started_at}}</h6>
                        <p style="text-align: justify; text-justify: inter-word;  line-height: 1.5em; height: 9em; overflow: hidden;">
                            {{$project->description}}
                            {!! HTML::linkAction('ProjectsController@show', 'Ler mais', array($project->id)) !!}
                        </p>
                        <p style="font-weight: bold;">{{$created_by[$project->id]}}</p>
                        {{--@foreach($project->users as $user)
                            <p style="font-weight: bold;">{{$user->name}}</p>
                        @endforeach--}}

                    </div>
                </article>
            </section>
        </div>
        @endforeach
    </div>

@endsection
@extends('footer')