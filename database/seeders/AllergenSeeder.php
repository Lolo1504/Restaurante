<?php

namespace Database\Seeders;

use App\Models\Allergen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllergenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $allergenArray=["altramuces","apio","cacahuetes","crustaceos","frutos_cascara","gluten","huevos","lacteos","moluscos","mostaza",
        "pescado","sesamo","soja","sulfitos"];

        foreach($allergenArray as $AllergeName){
            $allergen = new Allergen();
            $allergen->name=$AllergeName;
            $allergen->icon=$AllergeName.".png";
            $allergen->save();
        }
    }
}
