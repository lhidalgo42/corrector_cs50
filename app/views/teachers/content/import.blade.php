@extends('teachers.home')
@section('contentDashboard')
    <h2 class="sub-header">Importar</h2>
    <div class="row">
        <h4>Importar Alumnos</h4>
        {{Form::open(['url'=>'/admin/import/store/students', 'files'=>true,'class'=>'']) }}
        <div class="form-group">
            <label for="Seccion">Seleccione Seccion</label>
            <select name="seccion" id="seccion" class="form-control">
                @foreach(Course::where('year',date('Y'))->get() as $course)
                    <option value="{{$course->id}}">{{$course->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="row">
            <h4>Formato Excel <small>Importacion Directa OMEGA</small></h4>
            <table class="table table-bordered">
                <tr>
                    <th>Expediente</th>
                    <th>Rut</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Inscrito el</th>
                    <th>Estado</th>
                    <th>E-mail</th>
                    <th>Nota</th>
                </tr>
            </table>
        </div>
        <div class="form-group">
            <label for="file">Archivo</label>
            <input type="file" class="form-control" id="file" name="file" placeholder="Archivo">
        </div>

        <button class="btn btn-sm btn-primary" type="submit">Subir</button>
        {{Form::close()}}
    </div>
@endsection