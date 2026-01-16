<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateItemsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.name' => 'required|string|max:255|unique:items,name|regex:/^[^<>]*$/',
            'items.*.unit_id' => 'required|exists:units,id',
            'items.*.quantity' => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'items.*.name.unique' => 'The item name must be unique.',
            'items.*.name.required' => 'Item name is required.',
            'items.*.unit_id.required' => 'Unit is required.',
            'items.*.unit_id.exists' => 'Selected unit is invalid.',
        ];
    }
}