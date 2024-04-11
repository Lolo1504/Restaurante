<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DishRequest;
use App\Models\Allergen;
use App\Models\Category;
use App\Models\Dish;
use App\Models\Restaurante;

class DishController extends Controller
{
    public function index()
    {
        $dishes = Dish::orderBy("position", "asc")->get();;
        return view('admin.dishes.index', compact('dishes'));
    }

    public function create()
    {
        $categories = restaurante::join( 'categories as cat' ,'cat.restauranteId','=','restaurantes.id'  ) ->select('restaurantes.id','restaurantes.nombre','cat.name','cat.id')->get();
        $allergens = Allergen::all();
        return view('admin.dishes.create', compact('categories', 'allergens'));
    }

    public function store(DishRequest $request, Dish $dish)
    {
        $slug = $request->slug;

        $slug = $this->generateUniqueSlug($slug);

        $dish = Dish::create([
            'name' => $request->name,
            'slug' => $slug,
            'traduction' => $request->traduction,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'position' => Category::count() + 1
        ]);
        $dish->allergens()->sync($request->allergens);
        return redirect()->route('admin.dishes.index')->with('info', 'The dish was created successfully');
    }

    public function edit(Dish $dish)
    {
        $categories = restaurante::join( 'categories as cat' ,'cat.restauranteId','=','restaurantes.id'  ) 
                                   ->select('restaurantes.id','restaurantes.nombre','cat.name','cat.id')
                                   ->get();

        $allergens = Allergen::all();
        return view('admin.dishes.edit', compact('dish', 'categories', 'allergens'));
    }

    public function update(DishRequest $request, Dish $dish)
    {
        $slug = $request->slug;

        if ($request->slug!=$dish->slug) {
            $slug = $this->generateUniqueSlug($slug);
        }
        
        $dish->update(
            [
                'name' => $request->name,
                'slug' => $slug,
                'traduction' => $request->traduction,
                'price' => $request->price,
                'category_id' => $request->category_id
            ]
        );
        $dish->allergens()->sync($request->allergens);
        return redirect()->route('admin.dishes.index')->with('info', 'The dish was updated successfully');
    }

    public function destroy(Dish $dish)
    {
        $dish->delete();
        return redirect()->route('admin.dishes.index')->with('info', 'The dish was deleted successfully');
    }

    public function generateUniqueSlug($slug)
    {
        $existingSlugs = Dish::where('slug', 'LIKE', $slug . '%')->pluck('slug');

        if ($existingSlugs->isEmpty()) {
            return $slug;
        } else {
            $lastNumber = 1;

            foreach ($existingSlugs as $existingSlug) {
                if (preg_match('/\d+$/', $existingSlug, $matches)) {
                    $number = intval($matches[0]);
                    if ($number >= $lastNumber) {
                        $lastNumber = $number + 1;
                    }
                }
            }

            return $slug . '-' . $lastNumber;
        }
    }
}
