
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
        {{ html()->modelForm($Restaurante, 'PUT')->route('admin.Restaurante.update',$Restaurante)->open() }}

        <div class="form-group">
            {{ html()->label('nombre')->for('nombre') }}
            {{ html()->text('nombre')->class('form-control')->placeholder('Introduce the name of the restaurante') }}
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        {{html()->submit('Update restaurante')->class('btn btn-primary')}}
    </div>
</div>
@stop

@vite('resources/js/slug_generator.js')