

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
<div class="alert alert-danger">
    <strong>{{ session('info') }}</strong>
</div>
@endif

<div class="card">
    <div class="card-body">
        {{ html()->form('POST')->route('admin.categories.store')->open() }}

        <div class="form-group">
            {{ html()->label('Name')->for('name') }}
            {{ html()->text('name')->class('form-control')->placeholder('Introduce the name of the category') }}
            
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            {{ html()->label('Slug')->for('slug')}}
            {{ html()->text('slug')->class('form-control')->isReadonly() }}
            @error('slug')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            
        </div>
        <div class="form-group">
            {{ html()->label('Description')->for('description') }}
            {{ html()->text('description')->class('form-control')->placeholder('Introduce the description of the category') }}
            
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>  
      
        
        
        {{html()->submit('Create category')->class('btn btn-primary')}}
        {{ html()->form()->close() }}
    </div>
</div>
@stop

@vite('resources/js/slug_generator.js')