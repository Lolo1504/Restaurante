

@extends('adminlte::page')
@section('title', 'Barbarrosa')

@section('content_header')
<h1>Create category</h1>
@stop

@section('content_header')
<h1>Crear nueva categoría</h1>
@stop

@section('content')

@if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
@endif
<div class="card">
    <div class="card-body">
        {{ html()->form('POST')->route('admin.Restaurante.store')->open() }}

        <div class="form-group">
            {{ html()->label('Nombre')->for('nombre') }}
            {{ html()->text('nombre')->class('form-control')->placeholder('Introduce the name of the restaurante') }}
            
            @error('nombre')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{html()->submit('Create restaurante')->class('btn btn-primary')}}
        {{ html()->form()->close() }}
    </div>
</div>
@stop

@vite('resources/js/gmail.js')