    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Admin') }}
            </h2>
        </x-slot>
        <div class="py-6 h-screen bg-bisque">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @foreach($data['restaurantes'] as $restaurante)
                <div class="py-1">
                    <div class="collapsible">
                        <div class="collapsible-title">
                            <p class="text-lg font-bold">{{ $restaurante->nombre }}</p><i class='fas fa-angle-down arrow'></i>
                        </div>
                    </div>
                                <div class="collapsible-content hidden">
                            @foreach ($restaurante->categories as $category)
                    
                            
                                <div class="collapsible-title">
                                    <p class="text-lg font-bold">{{ $category->name }}</p>
                                </div>
                                @if ($category->description)
                                    <div>
                                        <p class="text-lg font-bold">{{ $category->description }}</p>
                                    </div>
                                @endif
                        <div class="collapsible-title">

                                    <i class='fas fa-angle-down arrow'></i>
                        </div>
                               
                                    <ul>
                                        @foreach ($category->dishes as $dish)
                                            <li>
                                                <strong>
                                                    <p>{{ $dish->name }}...{{ $dish->price }}</p>
                                                </strong>
                                                <span>{{ $dish->traduction }}</span>
                                                <div class="flex">
                                                    @foreach ($dish->allergens as $allergen)
                                                        <img class="allergen_image"
                                                            src='{{ asset("storage/allergens/$allergen->icon") }}' />
                                                    @endforeach
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                  
                                @endforeach
                            </div>
                        </div>
                  
                    @endforeach
                </div> 
            </div>
        
       
    </x-app-layout>

    @vite(['resources/css/collapsable.css', 'resources/js/collapsable.js'])