@extends('layouts.admin')
@section('content')
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.paymentPlan.title_singular') }}:
                    {{ trans('cruds.paymentPlan.fields.id') }}
                    {{ $paymentPlan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('payment-plan.edit', [$paymentPlan])
        </div>
    </div>
@endsection
