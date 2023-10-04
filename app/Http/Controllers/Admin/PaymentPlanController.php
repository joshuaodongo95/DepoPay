<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentPlan;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentPlanController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_plan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.payment-plan.index');
    }

    public function create()
    {
        abort_if(Gate::denies('payment_plan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.payment-plan.create');
    }

    public function edit(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.payment-plan.edit', compact('paymentPlan'));
    }

    public function show(PaymentPlan $paymentPlan)
    {
        abort_if(Gate::denies('payment_plan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.payment-plan.show', compact('paymentPlan'));
    }
}
