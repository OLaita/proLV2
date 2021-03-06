@extends('layouts.app')

@section('content')
    <div class="row content">
        <div style="left:50px" class="col-sm-8">
            <div>
                <video width="80%" controls>
                    <source src="{{ asset('storage/' . $videos->cont) }}" type="video/mp4">
                    Your browser does not support HTML video.
                </video><br>
                <h1 class="my-4">{{ $videos->title }}</h1>
                <span>{{ $videos->desc }}</span><br><a href="{{ route('src.show', $videos->name) }}" class="card-text">{{ $videos->name }}</a>
                @auth
                <div class="d-flex flex-row">
                        @if (Auth::user()->hasRole('admin'))
                            <a class="btn btn-primary" href="{{ route('vidA.edit', $videos->id) }}">Edit</a>
                            <form action="{{ route('vidA.destroy', $videos->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td><button class="btn btn-danger">Borrar</button></td>
                            </form>
                        @elseif(Auth::user()->name == $videos->name)
                            <a class="btn btn-primary" href="{{ route('vidE.edit', $videos->id) }}">Edit</a>
                            <form action="{{ route('vidE.destroy', $videos->id) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <td><button class="btn btn-danger">Borrar</button></td>
                            </form>
                        @endif
                        </div>

                    @endauth
            </div>
            <div class="bg-primary text-white text-center w-75">
                <h4>Comentarios</h4>
                <form class="d-flex justify-content-cente align-items-center flex-column"
                    action="{{ route('com.update', $videos->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6 text-center form-group">
                        <label for="name">Pon un comentario:</label>
                        <textarea maxlength="255" required class="form-control" rows="2" id="comment"
                            name="comment"></textarea>
                    </div>
                    <button type="submit" name="newPost" class="btn btn-primary bg-dark">Submit</button>
                    <br />
                    <br />
                </form><br>
                <div class="flex-column d-flex align-items-center">
                    @foreach ($comments->get() as $comment)
                        <div style="margin-bottom:10px; padding: 10px;" class="w-75 bg-dark text-white text-left">
                            <div class="d-flex justify-content-between"><span>{{ $comment->name }}</span>
                                <span class="text-muted">Hace:
                                    @if ($comment->created_at->diff(now()->toDateTimeString())->i == 0)
                                        Ahora
                                    @elseif($comment->created_at->diff(now()->toDateTimeString())->h == 0)
                                        {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min
                                    @elseif($comment->created_at->diff(now()->toDateTimeString())->days == 0)
                                        {{ $comment->created_at->diff(now()->toDateTimeString())->h }} horas
                                        {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min
                                    @elseif($comment->created_at->diff(now()->toDateTimeString())->days <= 2)
                                            {{ $comment->created_at->diff(now()->toDateTimeString())->days }} dias
                                            {{ $comment->created_at->diff(now()->toDateTimeString())->h }} horas
                                        {{ $comment->created_at->diff(now()->toDateTimeString())->i }} min @else mucho
                                            @endif
                                </span>
                            </div><br>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-4 sidenav">
            @foreach ($allVid as $video)
                <div class="card" style="width:200px; height: 250px;">
                    @if ($video->mini != null)<img class="card-img-top"
                            src="{{ asset('storage/' . $video->mini) }}" alt="Card image" style="width:100%; height: 100px;">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $video->title }}</h4>
                        <a href="{{ route('src.show', $video->name) }}" class="card-text">{{ $video->name }}</a>
                        <a href="{{ route('vid.show', $video->id) }}" class="btn btn-primary">Ver Video</a>
                    </div>
                </div>
                <br>
            @endforeach
        </div>

    @endsection
