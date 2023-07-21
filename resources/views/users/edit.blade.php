@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Actualizar informacion</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre: ') !!}
                {!! Form::text('name', null, [
                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba un nombre',
                ]) !!}

                @error('name')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Correo electrónico: ') !!}
                {!! Form::email('email', null, [
                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba el correo electrónico',
                ]) !!}

                @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Contraseña: ') !!}
                {!! Form::password('password', [
                    'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba una nueva contraseña si desea cambiarla',
                ]) !!}

                @error('password')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {!! Form::submit('Actualizar USUARIO', ['class' => 'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
