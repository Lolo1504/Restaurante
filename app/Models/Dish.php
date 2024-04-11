<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable=['name','slug','traduction','price','position','category_id','allergens'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function allergens(){
        return $this->belongsToMany(Allergen::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }

    public function getDishAllergensId(){
        return $this->allergens()->allRelatedIds()->toArray();
    }

}
