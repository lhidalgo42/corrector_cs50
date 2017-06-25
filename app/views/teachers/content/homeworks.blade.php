@extends('teachers.home')
@section('contentDashboard')
    <h2 class="sub-header">Subir Tareas</h2>
    <div class="row">
        <h4>Tarea</h4>
        {{Form::open(['url'=>'/admin/import/store/homeworks', 'files'=>true,'class'=>'']) }}
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
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
            <label for="section">Tipo de Revision</label>
            <select name="check" id="course" class="form-control">
                <option value="exist">Existe</option>
                <option value="replace">Compilacion y Ejecucion (Reemplaza los GetInt() y GetString())</option>
            </select>
        </div>
        <div class="row container-fluid" id="list">
            <label for="section">Variables de Reemplazo</label>
            <table class="table table-bordered">
                <tr>
                    <th>GetInt()</th>
                    <th>GetString()</th>
                    <th>GetChar()</th>
                </tr>
                @for($i=0;$i<5;$i++)
                <tr>
                    <td><input type="number" name="options[int][]" class="form-control" value="{{rand(1,10)}}"></td>
                    <td><input type="text" name="options[string][]" class="form-control" value="{{Faker\Factory::create()->word}}"></td>
                    <td><input type="text" name="options[char][]" class="form-control" value="{{Faker\Factory::create()->randomLetter}}"></td>
                </tr>
                 @endfor
            </table>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Ingrese Zip</label>
            <input type="file" id="zip" name="zip" class="form-control">
            <p class="help-block">Archivo de Tareas de Webcursos</p>
        </div>
        <button type="submit" class="btn btn-block btn-primary">Enviar</button>
    </div>
@endsection