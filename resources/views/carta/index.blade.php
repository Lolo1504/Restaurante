<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <title>{{$restaurante->nombre}}</title>
 
</head>
<body class ="bg-dark">
       <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin') }}
            </h2>
        </x-slot>
        <div class="py-6 h-screen bg-dark ">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">                                
                            @foreach ($data['categories'] as $category)
                        
                            <div class="collapsible bg-dark bg-gradient radio">
                                <div class="collapsible-title">
                                    <p class="text-lg fs-3 titulo">{{ $category->name }}</p>
                                </div>    
                                @if ($category->description)
                                    <div>
                                        <p class="text-lg font-bold">{{ $category->description }}</p>
                                    </div>
                                @endif
                                     </div> 
                                       <div class="collapsible-content   bg-secondary bg-gradient fs-4 fw-lighter mb-10 fuente radio2">
                                     <ul class="arr">
                                        @foreach ($category->dishes as $dish)
                                            <li class="linea">
                                                    <div class="container ">
                                                        <div class="row ">
                                                            <div class="col-11 mt-2 tamaño"> <h3>{{ $dish->name }}</h3></div>
                                                            <div class="col-1 align-self-end"><a>{{ $dish->price }}€</a></div>
                                                            <span class="indent">{{ $dish->traduction }}</span>
                                                            <div class="flex">
                                                    @foreach ($dish->allergens as $allergen)
                                                        <img class="allergen_image"
                                                            src='{{ asset("storage/allergens/$allergen->icon") }}' />
                                                    @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <br> 
                                        @endforeach
                                     
                                    </ul>
                                  </div>
                                @endforeach
                            </div>
                       
                </div> 
            </div>
        
       
    </x-app-layout>

    @vite(['resources/css/collapsable.css', ])
</body>
</html>