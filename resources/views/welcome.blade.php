@extends('header')
@section('title')
    Portfolios - IPLeiria
@endsection
@section('content')
    <div class="container">


        <style>
            #owl-example .item {
                margin: 3px;
                text-align: center;
            }

            #owl-example .item img {
                display: block;
                width: 100%;
                height: auto;
            }

           #owl-example .text{
                position:absolute;
                color:#FFF;
                display:block;
                bottom:0;
                left: 5%;
            }
        </style>
        <h1>Projectos em Destaque</h1>
        <div id="owl-example" class="owl-carousel">

            @foreach($featured as $project)
                <div class="item">
                    <a href="{{url("projects/".$project->id)}}">
                        <img src="{{$featuredImage[$project->id]}}" alt="{{$project->name}}"/>
                        <p class="text">{{$project->name}}</p>

                    </a>
                </div>
            @endforeach

        </div>
        <script>

            $(document).ready(function () {
                $("#owl-example").owlCarousel({

                    autoPlay: 3000,

                    items: 3

                });


            });
            /*$(document).ready(function () {

             $("#owl-example").owlCarousel();

             });*/

        </script>
        <h3 style="margin-top: 50px">Ultimos projectos actualizados</h3>
        <ul>
            @foreach($projects as $project)
                <div id="artigo" style="clear: both">
                    <section>
                        <article id="articles">
                            <hr>
                            <figure style="float:left; width: 50%" class="imgproj">
                                <img alt="" src="{{$image[$project->id]}}" width="350px" height="210px"/>
                            </figure>
                            <div style="float: right;width: 48%" id="projects">
                                <h1><a href="{{url("projects/".$project->id)}}">{{$project->name}}</a></h1>
                                <h6>{{$project->updated_at}}</h6>

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
@endsection