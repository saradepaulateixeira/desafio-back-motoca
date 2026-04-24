<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'required|string|in:car,motorcycle',
            'brand' => 'nullable|string|max:50',
            'model' => 'required|string|max:100',
            'year' => 'required|integer|min:2000',
            'price' => 'required|numeric|min:0.01',
            'color' => 'nullable|string|max:30',
            'mileage' => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'type.required' => 'O tipo do veículo é obrigatório.',
            'type.in' => 'O tipo deve ser "car" ou "motorcycle".',
            'model.required' => 'O modelo é obrigatório.',
            'year.required' => 'O ano é obrigatório.',
            'year.min' => 'O ano deve ser maior ou igual a 2000.',
            'price.required' => 'O preço é obrigatório.',
            'price.min' => 'O preço deve ser maior que zero.',
        ];
    }
}