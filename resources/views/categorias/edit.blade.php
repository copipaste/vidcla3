@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar CATEGORIA</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {{-- para editar abrimos el formulario con Form::model --}}

        {{-- tomar en cuenta que la ruta update necesita que le pasemos un parametro --}}
        {!! Form::model($categoria, ['route' => ['admin.categoria.update', $categoria], 'method' => 'put']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Nombre: ') !!}
            {!! Form::text('nombre', null, [
                'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
                'placeholder' => 'Escriba un nombre',
            ]) !!}

            {{-- Directiva de blade->error --}}
            @error('nombre')
                {{-- La clase "invalid-feedback" necesita que encima de el si o si exista
               un input con la clase "is-invalid", caso contrario no muestra nada --}}
                <span class="invalid-feedback">
                    {{-- El mensaje de error esta almacenado temporalmente en una
                var llamada message --}}
                    <strong>{{ $message }}</strong>

                </span>
            @enderror

        </div>


        {!! Form::submit('Actualizar CATEGORIA', ['class' => 'btn btn-primary mt-2']) !!}

        {!! Form::close() !!}
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop