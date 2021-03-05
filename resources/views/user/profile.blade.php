@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="col-sm-4">
        <h1 class="my-4">Perfil</h1>
        <p>Usuario: {{ $user->name }}</p>
        <p>Email: {{ $user->email }}</p>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#miModal">
            Cambiar contraseña
        </button>
    </div>

        <div class="col-sm-8 d-flex flex-wrap w-100 justify-content-center">
            @foreach ($videos as $video)
                <div class="card" style="width:250px;">
                    @if ($video->mini != null)<img class="card-img-top"
                            src="{{ asset('storage/' . $video->mini) }}" alt="Card image"
                            style="width:100%; height: 150px;">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title">{{ $video->title }}</h4>
                        <a href="{{ route('src.show', $video->user) }}" class="card-text">{{ $video->user }}</a><br>
                        <a href="{{ route('vid.show', $video->id) }}" class="btn btn-primary">Ver Video</a>

                        <a class="btn btn-primary" href="{{ route('vidE.edit', $video->id) }}">Edit</a>
                        <form action="{{ route('vidE.destroy', $video->id) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <td><button class="btn btn-danger">Borrar</button></td>
                        </form>
                    </div>
                </div>
                <br>
            @endforeach
        </div>

        <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="modal-body" action="{{ route('user.update', Auth::user()) }}" method="POST">
                        @csrf
                        @method('PUT')
                        Nueva Contraseña
                        <br />
                        <input type="password" name="password" class="form form-control">
                        Confirmar Contraseña
                        <br />
                        <input type="password" name="password_confirmation" class="form form-control">
                        <br />
                        <input type="submit" class="btn btn-primary" value="Save">
                    </form>
                </div>
            </div>
        </div>
        <br />
    </div>

@endsection
