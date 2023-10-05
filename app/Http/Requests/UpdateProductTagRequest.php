<?php

namespace App\Http\Requests;

use App\Models\ProductTag;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateProductTagRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('product_tag_edit'),
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
        ];
    }
}
