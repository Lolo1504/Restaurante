

@extends('adminlte::page')

@section('title', 'Barbarrosa')

@section('content_header')
	<h1>Edit category</h1>
@stop

@section('content')

@if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
@endif

<div class="card">
    <div class="card-body">
        {{ html()->modelForm($category, 'PUT')->route('admin.categories.update',$category)->open() }}

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
            <div class="form-group">
        <label for="restaurante_id">Restaurante</label>
        <select name="restaurante_id" id="restaurante_id" class="form-control" required>
            @foreach ($restaurantes as $restaurante)
                <option value="{{ $restaurante->id }}">{{ $restaurante->nombre }}</option>
            @endforeach
        </select>
    </div>
        
        {{html()->submit('Update category')->class('btn btn-primary')}}
        {{ html()->closeModelForm() }}
    </div>
   
</div>
@stop

@vite('resources/js/slug_generator.js')