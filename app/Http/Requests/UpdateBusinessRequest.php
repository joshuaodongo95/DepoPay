<?php

namespace App\Http\Requests;

use App\Models\Business;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBusinessRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('business_edit'),
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
                'unique:businesses,registration_number,' . request()->route('business')->id,
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
