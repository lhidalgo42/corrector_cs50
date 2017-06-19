@extends('teachers.home')
@section('contentDashboard')
    <h2 class="sub-header">Alumnos <span class="pull-right"><a href="/student/create" class="btn btn-default">Crear Usuario</a></span></h2>
    <div class="table-responsive">
        <table class="table table-striped" style="height: 100%">
            <thead>
            <tr>
                <th>Rut</th>
                <th>Nombre</th>
                <th>Mail</th>
                <th>Curso</th>
                <th>Created at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{\Carbon\Carbon::parse($user->last_login)->diffForHumans()}}</td>
                    <td>{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection