@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Videos</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>desc</th>
                    <th>Preview</th>
                    <th>User</th>
                    <th></th>
                </tr>
            @foreach($videos as $video)
                <tr>
                    <td>{{$video->title}}</td>
                    <td>{{$video->desc}}</td>
                    <td><video width="320" height="240" controls>
                        <source src="{{asset('storage/'.$video->cont)}}" type="video/mp4">
                      Your browser does not support the video tag.
                      </video></td>
                    <td>{{$video->name}}</td>
                    <td><a class="btn btn-primary" href="{{route('vidA.edit',$video->id)}}">Edit</a></td>
                    <form action="{{route('vidA.destroy',$video->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                    <td><button class="btn btn-danger">Borrar</button></td>
                    </form>
                </tr>
            @endforeach

            </thead>
        </table>
    </div>

    <div class="col-lg-12">

        <h1 class="my-4">Usuarios</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td><a class="btn btn-primary" href="{{route('vidA.show',$user->id)}}">Edit</a></td>
                    <form action="{{route('vidA.destroy',$user->id)}}" method="POST">
                        @csrf
                        @method("DELETE")
                    <td><button class="btn btn-danger">Borrar</button></td>
                    </form>
                    </form>
                </tr>
            @endforeach

            </thead>
        </table>
    </div>

    @endsection
