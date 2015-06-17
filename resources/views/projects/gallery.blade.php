@extends('header')
@section('title')
    Imagens de {{$project->name}}
@endsection
@section('content')

    <div class="container">
        <h3>Imagens</h3>
        @foreach(array_chunk($project->media->all(), 4) as $row)
        <div class="row">
           @foreach($row as $item)
           <div class="col-sm-6 col-md-3">
              <a href="#" class="thumbnail">
                 @if (in_array($item->mime_type, $image_type))
                 <img src="{{$file[$item->id]}}" alt="{{$file[$item->id]->title}}">
                 @endif
              </a>
           </div>
           @endforeach
        </div>
        @endforeach
        <h3>Documentos</h3>
        @foreach(array_chunk($project->media->all(), 4) as $row)
        <div class="row">
           @foreach($row as $item)
           <div class="col-sm-6 col-md-3">
              <a href="#" class="thumbnail">
                 @if (in_array($item->mime_type, $document_type))
                 <img src="{{$file[$item->id]}}" alt="{{$file[$item->id]->title}}">
                 @endif
              </a>
           </div>
           @endforeach
        </div>
        @endforeach
    </div>

@endsection