<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => 'sometimes|string|in:car,motorcycle',
            'brand' => 'nullable|string|max:50',
            'model' => 'sometimes|string|max:100',
            'year' => 'sometimes|integer|min:2000',
            'price' => 'sometimes|numeric|min:0.01',
            'color' => 'nullable|string|max:30',
            'mileage' => 'nullable|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'type.in' => 'O tipo deve ser "car" ou "motorcycle".',
            'year.min' => 'O ano deve ser maior ou igual a 2000.',
            'price.min' => 'O preço deve ser maior que zero.',
        ];
    }
}