

@extends('adminlte::page')
@section('title', 'Barbarrosa')

@section('content_header')
<h1>Create user</h1>
@stop

@section('content_header')
<h1>Crear nuevo usuario</h1>
@stop

@section('content')


<div class="card">
    <div class="card-body">
        {{ html()->form('POST')->route('admin.usuario.store')->open() }}

        <div class="form-group">
            {{ html()->label('Nombre')->for('name') }}
            {{ html()->text('name')->class('form-control')->placeholder('Introduce the name of the restaurante') }}
            
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {{ html()->label('gmail')->for('gmail') }}
            {{ html()->text('gmail')->class('form-control')->isReadonly() }}
            
            @error('gmail')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <select name="IdRestaurante" id="IdRestaurante">
                @foreach($restaurantes  as $restaurante)
                <option value="{{ $restaurante->id }}">{{$restaurante->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            {{ html()->label('password')->for('password') }}
            {{ html()->password('password')->class('form-control') }}
            
            @error('nombre')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        {{html()->submit('Create user')->class('btn btn-primary')}}
        {{ html()->form()->close() }}
    </div>
</div>
@stop

@vite('resources/js/gmail.js')