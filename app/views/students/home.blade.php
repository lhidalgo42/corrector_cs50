@extends('layouts.master')
@section('content')

    <div class="container">
        <h1>Ingrese Rut <span class="pull-right h4"><a href="/admin?ref=variableSecreta">Menu Admin</a></span></h1>
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control input-lg" id="rut" placeholder="12345678-K" autofocus
                       autocomplete="off" data-provide="typeahead">
                <div class="input-group-addon"><a href="#"><i class="fa fa-search fa-2x"></i></a></div>
            </div>
        </div>
    </div>
    <script>
        $('#rut').typeahead({
            source: function (query, process) {
                return $.post('/student/' + query, function (data) {
                    return process(data);
                });
            }
        }).change(function () {
            $.ajax({
                url: '/student/get/' + $(this).val(),
                type: 'post',
                success: function (data) {
                    console.log(data);
                }
            })
        })
    </script>
@endsection