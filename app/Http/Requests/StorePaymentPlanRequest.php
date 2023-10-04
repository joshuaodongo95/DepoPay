<?php

namespace App\Http\Requests;

use App\Models\PaymentPlan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePaymentPlanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(
            Gate::denies('payment_plan_create'),
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
            'duration' => [
                'nullable',
                'in:' . implode(',', array_keys(PaymentPlan::DURATION_SELECT)),
            ],
        ];
    }
}
