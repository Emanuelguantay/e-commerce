<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Role;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    //Par validar formulario!! form!!
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role_id === Role::VENDEDOR || auth()->user()->role_id === Role::ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // method()-> metodo GET,PUT,POST,PATCH,DELETE
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST': {
                return [
                    'name' => 'required|min:3',
                    'marca_id' => [
                        'required',
                        Rule::exists('marcas','id')
                    ],
                    'indumentaria_id' => [
                        'required',
                        Rule::exists('indumentarias','id')
                    ],
                    'genero_id' => [
                        'required',
                        Rule::exists('generos','id')
                    ],
                    'picture' => 'required|image|mimes:jpg,jpeg,png',
                    'price' => 'required',
                    
                      
                ];
            }

             case 'PUT': {
                return [
                    'name' => 'required|min:3',
                    'marca_id' => [
                        'required',
                        Rule::exists('marcas','id')
                    ],
                    'indumentaria_id' => [
                        'required',
                        Rule::exists('indumentarias','id')
                    ],
                    'genero_id' => [
                        'required',
                        Rule::exists('generos','id')
                    ],
                    'picture' => 'sometimes|image|mimes:jpg,jpeg,png',
                    'price' => 'required',
                      
                ];
            }
        }
    }
}
