<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\resturante;
use App\Models\Restaurante;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class usuarioController extends Controller
{
    public function index(){
        $user= auth::user();
        if($user->IdRestaurante)
        {
            $usuarios = user::orderby('id','asc')
            ->where("IdRestaurante",'=',$user->IdRestaurante)
            ->get();
        }
        else{$usuarios= user::orderby('id','asc')->get();}
        

        return view('admin.usuario.index',compact('usuarios'));
    }
    public function create()
    {
        $user= auth::user();
        if ($user->IdRestaurante)
        {
            return redirect()->route('admin.usuario.index')->with('Nper','No tienes permiso para crear un usuario');
        }
        $restaurantes= restaurante::select('id','nombre')->get();
    
        return view('admin.usuario.create',compact('restaurantes'));
    }
    public function store(Request $request)
    {
        
        User::create([
            'name' => $request['name'],
            'email' => $request['gmail'], 
            'IdRestaurante'=> $request['IdRestaurante'],
            'password' => Hash::make($request['password']),
           
        ]);
    
        return redirect()->route('admin.usuario.index')->with('info','El usuario a sido creado correctamente');
    }
    public function edit(user $usuario){
        $restaurantes= restaurante::select('id','nombre')->get();
        $user= auth::user();
        if ($user->IdRestaurante)
        {
            return redirect()->route('admin.usuario.index')->with('Nper','No tienes permiso para editar un usuario');
        }
        
        return view('admin.usuario.edit',compact('usuario','restaurantes'));
    }
    public function update(Request $request, user $usuario){
        
        $usuario->update(
            ['name'=> $request->name,
             'email' => $request ->email,
            ]
        );
        return redirect()->route('admin.usuario.index');
    }
    public function destroy(user $usuario)
    {
        $user= auth::user();
        if ($user->IdRestaurante)
        {
            return redirect()->route('admin.usuario.index')->with('Nper','No tienes permiso para borrar un usuario');
        }
        $usuario->delete();
        return redirect()->route('admin.usuario.index')->with('info','The usuario was deleted successfully');
    }
}
