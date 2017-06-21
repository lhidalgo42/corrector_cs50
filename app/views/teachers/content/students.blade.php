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
            @foreach($students as $student)
                <tr>
                    <td>{{$student->rut}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{Course::find($student->course_id)->section}}</td>
                    <td>{{\Carbon\Carbon::parse($student->created_at)->diffForHumans()}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{$students->links()}}
    </div>
@endsection