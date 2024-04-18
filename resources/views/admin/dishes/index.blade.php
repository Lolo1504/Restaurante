@extends('adminlte::page')

@section('title', 'Barbarrosa')

@section('content_header')

<a class="btn btn-secondary btn-sm float-right" href="{{ route('admin.dishes.create') }}">Add dish</a>

<h1>Dish list</h1>
@stop

@section('content')

@if (session('info'))
<div class="alert alert-success">
    <strong>{{ session('info') }}</strong>
</div>
@endif

<div class="card">
    
    <div class="card-body">
        @if (!$dishes->isEmpty())
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody id="dish">
                @foreach ($dishes as $dish)
                <tr class="handle" data-id={{$dish->id}}>
                    <td>{{ $dish->id }}</td>
                    <td>{{ $dish->name }}</td>
                    <td width="10px">
                        
                        <a href="{{ route('admin.dishes.edit',$dish) }}" class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td width="10px">

                        <form action="{{ route('admin.dishes.destroy',$dish) }}" method="POST">
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
        {{html()->span('There are no dishes, but you can create one by pressing the button in the upper right corner.')}}
        @endif
    </div>
</div>
@stop
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    new Sortable(dish, {
    handle: ".handle",
    animation: 150,
    store: {
        set: function (sortable) {
            const sorts= sortable.toArray();
            console.log(sorts);
            axios.post("{{ route('api.sort.dishes') }}",{
                sorts:sorts
            }).catch(function(error){
                console.log(error);
            });
        }
    }
});
</script>
@endpush