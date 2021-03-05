@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">New Video</h1>
        <form action="{{route('vidE.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            Title
        <br/>
            <input type="text" name="title" value="" class="form form-control" required>
            <br/>
            Descripcion
            <input type="text" name="desc" value="" class="form form-control" required>
            <br/>
            Video
            <input type="file" name="video">
            Miniatura
            <input type="file" name="image">
            <br/>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br/>
        </form>
    <br/>
    </div>

    @endsection
