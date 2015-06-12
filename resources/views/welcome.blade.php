@extends('header')
@section('content')
    <div class="container">


        <style>
            .owl-item img{
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
            <li>{{$project-> name}}</li>
        @endforeach
        </ul>
    </div>
    <script>

        $(document).ready(function(){
            $("#owl-demo").owlCarousel({

                autoPlay: 3000,

                items : 3

            });



        });

    </script>
@endsection