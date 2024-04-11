
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
        {{ html()->modelForm($restaurante, 'PUT')->route('admin.restaurante.update',$restaurante)->open() }}

        <div class="form-group">
            {{ html()->label('Name')->for('name') }}
            {{ html()->text('name')->class('form-control')->placeholder('Introduce the name of the restaurante') }}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
@stop

@vite('resources/js/slug_generator.js')