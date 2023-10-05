<?php

namespace App\Http\Requests;

use App\Models\Subscription;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSubscriptionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('subscription_edit'),
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
            'ref' => [
                'string',
                'nullable',
            ],
            'customer_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'payment_plan_id' => [
                'integer',
                'exists:payment_plans,id',
                'required',
            ],
            'status' => [
                'nullable',
                'in:' . implode(',', array_keys(Subscription::STATUS_SELECT)),
            ],
            'product_id' => [
                'integer',
                'exists:products,id',
                'required',
            ],
            'currency' => [
                'string',
                'nullable',
            ],
        ];
    }
}
