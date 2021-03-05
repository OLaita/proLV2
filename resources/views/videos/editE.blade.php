@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Property edit</h1>
        <form action="{{route('vidE.update',$videos->id)}}" method="POST">
            @csrf
            @method('PUT')
            Title
            <br/>
            <input type="text" name="description" value="{{$videos->title}}" class="form form-control">

            Description
            <br/>
            <input type="text" name="price" value="{{$videos->desc}}" class="form form-control">

            <br/>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br/>
        </form>
    <br/>
    </div>

    @endsection
