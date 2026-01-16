<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkStockRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'operations' => 'required|array|min:1',
            'operations.*.item_id' => 'required|exists:items,id',
            'operations.*.quantity' => 'required|numeric|min:0.01|max:999999',
        ];
    }

    public function messages()
    {
        return [
            'operations.*.item_id.required' => 'Item is required.',
            'operations.*.item_id.exists' => 'Selected item is invalid.',
            'operations.*.quantity.required' => 'Quantity is required.',
            'operations.*.quantity.min' => 'Quantity must be greater than 0.',
        ];
    }
}