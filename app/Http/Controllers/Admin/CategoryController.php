<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Restaurante;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v7;

class CategoryController extends Controller
{

    public function index()
    {
        $user = auth::user();
        if($user->IdRestaurante){
            $categories=Category::orderBy("position","asc")
            ->where('restauranteId','=',$user->IdRestaurante)
            ->get();}
        else{
            $categories =Category::orderBy("position","asc")
            ->get();
        }

        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        $user = auth::user();
        
        $restaurantes = restaurante::select('id','nombre')
        ->where('id', '=', $user->IdRestaurante )
        ->get();
        
        return view('admin.categories.create',compact('restaurantes'));
    }
    
    public function store(CategoryRequest $request)
    {
        $user = auth::user();
        
        $res = Category::where('slug', $request->slug)
        ->where('restauranteId', $request->restauranteId)
        ->exists();
        if($res)
        {
            return redirect()->route('admin.categories.create')->with('info','The category wasnt created successfully');
        }
        else{Category::create(
           ['name'=> $request->name,
            'slug'=> $request->slug,
            'description'=> $request->description,
            'position' => Category::count()+1,
            'restauranteId' => $user->IdRestaurante ,
            ]
        );
        return redirect()->route('admin.categories.index')->with('info','The category was created successfully');
    }
    }

    public function edit(Category $category)
    {
       

        return view('admin.categories.edit',compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update(
            ['name'=> $request->name,
             'slug'=> $request->slug,
             'description'=> $request->description   
             ]
         );
        return redirect()->route('admin.categories.index')->with('info','The category was updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('info','The category was deleted successfully');
    }
}
