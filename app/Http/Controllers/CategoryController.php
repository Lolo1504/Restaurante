<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Restaurante;

class CategoryController extends Controller
{
    public function index()
    {
        $restaurantes = Restaurante::has('categories')
        ->with(['categories' => function ($query) {
            $query->orderBy('position', 'asc');
        }])
        ->orderBy('id', 'asc')
        ->get();
        $categories = Category::has('dishes')
        ->with(['dishes' => function ($query) {
            $query->orderBy('position', 'asc');
        }])
        ->orderBy('position', 'asc')
        ->get();
        $data['restaurantes'] = $restaurantes;
        $data['categories'] = $categories;
    return view('categories.index', compact('data'));
    }
}

      