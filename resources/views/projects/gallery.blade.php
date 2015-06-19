@extends('header')
@section('title')
    Imagens de {{$project->name}}
@endsection
@section('content')

    <div style="margin-bottom: 20px" class="container">
        <h3>Imagens</h3>
        @foreach(array_chunk($project->media->all(), 4) as $row)
            <div class="row">
                @foreach($row as $item)
                    @if ($item->state == 1)
                        @if (in_array($item->mime_type, $image_type))
                            <div class="col-sm-6 col-md-3">
                                <a href="#" class="thumbnail">

                                    <img src="{{$file[$item->id]}}" alt="">

                                </a>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        @endforeach
        <h3>Documentos</h3>
        @foreach($project->media as $media)
            @if ($media->state == 1)
                <a href="#">
                    @if ($media->mime_type == 'application/pdf')
                        <div style="margin-top: 20px" class="img-with-text highlight">
                            {!! html_entity_decode(HTML::linkAction('MediaController@showProject', HTML::image($pdfLogo,
                            "Logo"), array(basename($media->int_file)))) !!}
                            <p style="margin-top: 5px">{{$media->title}}</p>
                        </div>
                    @endif
                </a>
            @endif
        @endforeach

        <h3>Videos</h3>
        @foreach($project->media as $media)
            @if ($media->state == 1)
                <a href="#">
                    @if ($media->mime_type == 'video/youtube')
                        <div style="margin-top: 20px">
                            <iframe width="560" height="315" src="http://www.youtube.com/embed/{{$media->ext_url}}"
                                    frameborder="0" allowfullscreen></iframe>
                        </div>
                    @endif
                </a>
            @endif
        @endforeach
    </div>

@endsection