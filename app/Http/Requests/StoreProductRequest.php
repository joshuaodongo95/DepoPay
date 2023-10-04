<?php

namespace App\Http\Requests;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('product_create'),
            response()->json(
                ['message' => 'This action is unauthorized.'],
                Response::HTTP_FORBIDDEN
            ),
        );

        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'unit_price' => [
                'numeric',
                'required',
            ],
            'business_id' => [
                'integer',
                'exists:businesses,id',
                'required',
            ],
            'category_id' => [
                'integer',
                'exists:categories,id',
                'required',
            ],
        ];
    }
}
