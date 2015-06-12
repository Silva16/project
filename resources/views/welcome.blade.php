@extends('header')
@section('content')
    <div class="container">


        <style>
            .owl-item img {
                width: 300px;
            }
        </style>
        <div id="owl-demo" class="owl-carousel">

            <div class="owl-item"><img src="css/imagens/logo.png" alt="Owl Image"></div>
            <div class="owl-item"><img src="css/imagens/filipe67.jpg" alt="Owl Image"></div>
            <div class="owl-item"><img src="css/imagens/costa.nelson.jpg" alt="Owl Image"></div>
            <div class="owl-item"><img src="css/imagens/erika.abreu.jpg" alt="Owl Image"></div>
            <div class="owl-item"><img src="css/imagens/eva.fonseca.jpg" alt="Owl Image"></div>
            <div class="owl-item"><img src="css/imagens/gil37.jpg" alt="Owl Image"></div>
            <div class="owl-item"><img src="css/imagens/ifaria.jpg" alt="Owl Image"></div>
            <div class="owl-item"><img src="css/imagens/teresa87.jpg" alt="Owl Image"></div>

        </div>
        <ul>
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
        </ul>
    </div>
    <script>

        $(document).ready(function () {
            $("#owl-demo").owlCarousel({

                autoPlay: 3000,

                items: 3

            });


        });

    </script>
@endsection