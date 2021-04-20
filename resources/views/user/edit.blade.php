@extends('layouts.app')

@section('content')
    <div class="col-lg-12">

        <h1 class="my-4">Property edit</h1>
        <form action="{{route('user.store')}}" method="POST">
            @csrf
            @method('POST')
            User
            <br/>
            <input type="text" name="name" value="{{$user->name}}" class="form form-control">
            <input type="hidden" name="id" value="{{$user->id}}" class="form form-control">
            Email
            <br/>
            <input type="email" name="email" value="{{$user->email}}" class="form form-control">

            <br/>
            <input type="submit" class="btn btn-primary" value="Save">
            <br/>
            <br/>
        </form>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#miModal">
            Cambiar contraseña
        </button>
    <br/>
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
                    <input type="hidden" name="id" value="{{$user->id}}" class="form form-control">
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

    @endsection
