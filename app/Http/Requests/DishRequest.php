<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $dish = $this->route()->parameter('dish');
        
        $rules=[
            'name' => 'required',
            'slug' => "required",
            'traduction' => 'required',
            'price' => 'required',
            'category_id' => 'required',
        ];
        if ($dish) {
            $rules['slug'] =  'required|unique:dishes,slug,'.$dish->id;
        }
        
        return $rules;
    }
}
