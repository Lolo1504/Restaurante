

@extends('adminlte::page')

@section('title', 'Barbarrosa')

@section('content_header')

<a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.Restaurante.create') }}">Add restaurante</a>

<h1>restaurante list</h1>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif

<div class="card">
    
    <div class="card-body">
        @if (!$restaurantes->isEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>nombre</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody id="restaurante">
                @foreach ($restaurantes as $restaurante)
                <tr class="handle" data-id={{$restaurante->id}}>
                    <td>{{ $restaurante->id }}</td>
                    <td>{{ $restaurante->nombre }}</td>
                 
                    <td width="10px">
                        <a href="{{ route('admin.Restaurante.edit',$restaurante) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td width="10px">

                        <form action="{{ route('admin.Restaurante.destroy',$restaurante) }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        @else
        {{html()->span('There are no categories, but you can create one by pressing the button in the upper right corner.')}}
        @endif
    </div>
</div>
@stop
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    new Sortable(category, {
    handle: ".handle",
    animation: 150,
    store: {
        set: function (sortable) {
            const sorts= sortable.toArray();
            console.log(sorts);
            axios.post("{{ route('api.sort.categories') }}",{
                sorts:sorts
            }).catch(function(error){
                console.log(error);
            });
        }
    }
});
</script>
@endpush