<?php

namespace App\Http\Requests;

use App\Models\Wallet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWalletRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('wallet_create'),
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
            'msisdn' => [
                'string',
                'required',
            ],
            'business_id' => [
                'integer',
                'exists:businesses,id',
                'nullable',
            ],
        ];
    }
}
