@extends('header')
@section('content')

<script>

    function projectimg() {
        document.getElementById("teste").src = "css/imagens/cleal.jpg";
    }
</script>
    <div class="container" >



                <div id="artigo">

                <figure class="imgproj">

                    <img  id="teste" alt="" src="" width="350px" height="210px"/>

                </figure>
                <section id="projects">
                    <h1>    Project Flips </h1>
                    <h6>    11 Maio 2015  </h6>

                    <article id="articles">
                        <p >
                            O Lorem Ipsum é um texto modelo da indústria tipográfica e de impressão.
                            O Lorem Ipsum tem vindo a ser o texto padrão usado por estas indústrias desde o ano de 1500,
                            quando uma misturou os caracteres de um texto para criar um espécime de livro. Este texto não só sobreviveu 5 séculos,
                            mas também o salto para a tipografia electrónica, mantendo-se essencialmente inalterada.
                            Foi popularizada nos anos 60 com a disponibilização das folhas de Letraset,
                            que continham passagens com Lorem Ipsum, e mais recentemente com os programas
                            de publicação como o Aldus PageMaker que incluem versões do Lorem Ipsum.
                        </p>

                    </article>

                    <p id="autor" > Jebazz </p>

                </section>
                    </div>




    </div>


@endsection
@extends('footer')