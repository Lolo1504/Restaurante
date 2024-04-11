<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dish;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SortController extends Controller
{
    function categories(Request $request){
        $this->sorts(Category::class,$request);
    }

    function dishes(Request $request){
        $this->sorts(Dish::class,$request);
    }

    function sorts(String $model,Request $request){
        $position=1;
        $sorts=$request->get('sorts');
        foreach ($sorts as $sort) {
            $element=$model::find($sort);
            $element->position=$position;
            $element->save();
            $position++;
        }
    }
}
