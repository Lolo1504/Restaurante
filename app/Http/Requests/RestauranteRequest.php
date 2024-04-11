<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestauranteRequest extends FormRequest
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
        $Restaurante = $this->route()->parameter('Restaurante');

        $rules = [
            'nombre' => 'required|unique:Restaurantes'
            
        ];
        if ($Restaurante) {
            $rules['nombre'] =  'required|unique:categories,nombre,'.$Restaurante->id;
        }
        
        return $rules;
    }
}
