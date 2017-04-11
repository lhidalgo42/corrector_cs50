@extends('teachers.home')
@section('contentDashboard')
    <h2 class="sub-header">Cursos <span class="pull-right"><a href="/course/create" class="btn btn-default">Crear Curso</a></span></h2>
    <div class="table-responsive">
        <table class="table table-striped" style="height: 100%">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Creado</th>
                <th>Enviados</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>{{$course->name}}</td>
                    <td>{{$course->created_at}}</td>
                    <td>0</td>
                    <td><div class="btn-group" style="position: absolute">
                            <button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Acciones <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Analizar Envios</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="/course/edit/{{$course->id}}">Editar</a></li>
                                <li><a href="/course/destroy/{{$course->id}}">Borrar</a></li>
                            </ul>
                        </div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection