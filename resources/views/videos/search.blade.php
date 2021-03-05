@extends('layouts.app')

@section('content')
<h1 class="my-4">Videos de {{$id}}</h1>
    <div class="d-flex flex-wrap w-100 justify-content-center">
        @foreach($videos as $video)
        <div class="card" style="width:400px">
            @if($video->mini!=null)<img class="card-img-top" src="{{asset('storage/'.$video->mini)}}" alt="Card image" style="width:100%; height: 250px;">@endif
            <div class="card-body">
            <h4 class="card-title">{{$video->title}}</h4>
            <a href="{{route('src.show',$video->user)}}" class="card-text">{{$video->user}}</a><br>
            <a href="{{route('vid.show',$video->id)}}" class="btn btn-primary">See Profile</a>
            @auth
                        @if (Auth::user()->hasRole('admin'))
                            <a class="btn btn-primary" href="{{ route('vidA.edit', $video->id) }}">Edit</a>
                            <form action="{{ route('vidA.destroy', $video->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td><button class="btn btn-danger">Borrar</button></td>
                            </form>
                        @elseif(Auth::user()->name == $video->user)
                            <a class="btn btn-primary" href="{{ route('vidE.edit', $video->id) }}">Edit</a>
                            <form action="{{ route('vidE.destroy', $video->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td><button class="btn btn-danger">Borrar</button></td>
                            </form>
                        @endif
                    @endauth
        </div>
        </div>
        <br>

    @endforeach
    </div>

    @endsection
