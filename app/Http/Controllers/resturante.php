<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Restaurante;
use App\Http\Requests\RestauranteRequest;
use Illuminate\Support\Facades\Auth;



class resturante extends Controller
{
    public function index()
    {
        $user=auth::user();
        if($user->IdRestaurante)
        {
              $restaurantes=Restaurante::orderBy("id","asc")
        ->where("id","=",$user->IdRestaurante)
        ->get();
        }
        else
        {
            $restaurantes=Restaurante::orderBy("id","asc")
            ->get();
        }
      
        return view('admin.Restaurante.index',compact('restaurantes'));
    }

    public function create()
    {
        $user =auth::user();
        if ($user->IdRestaurante){
            
            return redirect()->route('admin.Restaurante.index' )->with('Nper','No tienes permiso para crear un restaurante');
        }
        else{ return view('admin.Restaurante.create');}
       
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
        $user =auth::user();
        if ($user->IdRestaurante){
            
            return redirect()->route('admin.Restaurante.index' )->with('Nper','No tienes permiso para editar un restaurante');
        }
        else{return view('admin.Restaurante.edit',compact('Restaurante'));}
        
    }

    public function update(RestauranteRequest $request, Restaurante $Restaurante)
    {
        $Restaurante->update(
            ['nombre'=> $request->nombre]
         );
        return redirect()->route('admin.Restaurante.index')->with('info','The Restaurante was updated successfully');
    }

    public function destroy(Restaurante $Restaurante)
    {
        $user =auth::user();
        if ($user->IdRestaurante){
            return redirect()->route('admin.Restaurante.index' )->with('Nper','No tienes permiso para eliminar un restaurante');
        }
        else
        {
                    $Restaurante->delete();
        return redirect()->route('admin.Restaurante.index')->with('info','The Restaurante was deleted successfully');
        }

    }
    public function show(Restaurante $restaurante)
    {
        $id = $restaurante['id']; 
        
        $categories = Category::has('dishes')
        ->with(['dishes' => function ($query) {
            $query->orderBy('position', 'asc');
        }])
        ->orderBy('position', 'asc')
        ->where('categories.restauranteId','=',$id)
        ->get();
        
        $data['categories'] = $categories;
    

        return view('carta.index',compact('data','restaurante'));
       
    }

}


