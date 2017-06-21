@extends('teachers.home')
@section('contentDashboard')
    <h2 class="sub-header">Subir Tareas</h2>
    <div class="row">
        <h4>Tarea</h4>
        {{Form::open(['url'=>'/admin/import/store/homeworks', 'files'=>true,'class'=>'']) }}
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="week">Seleccione Semana</label>
            <select name="week" id="week" class="form-control">
                @foreach(range(0,8) as $week)
                    <option value="{{$week}}">Semana {{$week}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="section">Seleccion Seccion</label>
            <select name="course" id="course" class="form-control">
                @foreach(Course::all() as $course)
                    <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Ingrese Zip</label>
            <input type="file" id="zip" name="zip" class="form-control">
            <p class="help-block">Archivo de Tareas de Webcursos</p>
        </div>
        <button type="submit" class="btn btn-block btn-primary">Enviar</button>
    </div>

@endsection