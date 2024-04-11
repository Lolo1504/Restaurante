<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurante;
use App\Http\Requests\RestauranteRequest;


class resturante extends Controller
{
    public function index()
    {
        $restaurantes=Restaurante::orderBy("id","asc")->get();
        return view('admin.Restaurante.index',compact('restaurantes'));
    }

    public function create()
    {
        return view('admin.Restaurante.create');
    }
    
    public function store(RestauranteRequest $request)
    {
       
        Restaurante::create(
           ['nombre'=> $request->nombre
            ]
        );

        return redirect()->route('admin.Restaurante.index')->with('info','The Restaurante was created successfully');
    }

    public function edit(Restaurante $Restaurante)
    {
        return view('admin.Restaurante.edit',compact('Restaurante'));
    }

    public function update(RestauranteRequest $request, Restaurante $Restaurante)
    {
        $Restaurante->update(
            ['nombre'=> $request->nombre]
         );
        return redirect()->route('admin.Restaurante.index')->with('info','The Restaurante was updated successfully');
    }

    public function destroy(Restaurante $category)
    {
        $category->delete();
        return redirect()->route('admin.Restaurante.index')->with('info','The Restaurante was deleted successfully');
    }
}


