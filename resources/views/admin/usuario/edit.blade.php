
@extends('adminlte::page')

@section('title', 'Barbarrosa')

@section('content_header')
	<h1>Edit usuario</h1>
@stop

@section('content')

@if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
@endif

<div class="card">
    <div class="card-body">
        {{ html()->modelForm($usuario, 'PUT')->route('admin.usuario.update',$usuario)->open() }}

        <div class="form-group">
            {{ html()->label('nombre')->for('name') }}
            {{ html()->text('name')->class('form-control')->placeholder('Introduce the name of the user') }}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div> 
        <div class="form-group">
            {{ html()->label('email')->for('email') }}
            {{ html()->text('email')->class('form-control')->isReadonly() }}
        </div>
        <div class="form-group">
            <label for="restauranteId">Restaurante
            </label>
            <select name="restauranteId" id="restauranteId" class="form-control" required>
                @foreach ($restaurantes as $restaurante)
                    <option value="{{ $restaurante->id }}">{{ $restaurante->nombre }}</option>
                @endforeach
            </select>
            
        </div>
       
        {{html()->submit('Update usuario')->class('btn btn-primary')}}
    </div>
</div>
@stop

@vite('resources/js/email.js')