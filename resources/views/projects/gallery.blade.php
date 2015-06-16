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
                 <img src="{{$image[$item->id]}}"
                 alt="Generic placeholder thumbnail">
              </a>
           </div>
           @endforeach
        </div>
        @endforeach
    </div>

@endsection