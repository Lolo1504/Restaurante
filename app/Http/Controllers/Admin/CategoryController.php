<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Restaurante;

use function Ramsey\Uuid\v7;

class CategoryController extends Controller
{

    public function index()
    {
        
        $categories=Category::orderBy("position","asc")->get();
        return view('admin.categories.index',compact('categories'));
    }

    public function create()
    {
        $restaurantes = restaurante::select('id','nombre')->get();
        
        return view('admin.categories.create',compact('restaurantes'));
    }
    
    public function store(CategoryRequest $request)
    {
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
            'restauranteId' => $request->restauranteId ,
            ]
        );
        return redirect()->route('admin.categories.index')->with('info','The category was created successfully');
    }
        

        
    }

    public function edit(Category $category)
    {
        $restaurantes = restaurante::select('id','nombre')->get();

        return view('admin.categories.edit',compact('category','restaurantes'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update(
            ['name'=> $request->name,
             'slug'=> $request->slug,
             'description'=> $request->description]
         );
        return redirect()->route('admin.categories.index')->with('info','The category was updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('info','The category was deleted successfully');
    }
}
