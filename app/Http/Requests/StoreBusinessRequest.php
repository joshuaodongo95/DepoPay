<?php

namespace App\Http\Requests;

use App\Models\Business;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBusinessRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('business_create'),
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
                'nullable',
            ],
            'registration_number' => [
                'string',
                'required',
                'unique:businesses,registration_number',
            ],
            'address' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'required',
            ],
            'email' => [
                'email:rfc',
                'nullable',
            ],
            'website' => [
                'string',
                'nullable',
            ],
        ];
    }
}
