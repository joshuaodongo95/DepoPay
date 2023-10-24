@extends('layouts.admin')
@section('content')
    <div class="card bg-white">
        <div class="card-header border-b border-blueGray-200">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('cruds.paymentPlan.title_singular') }}
                    {{ trans('global.list') }}
                </h6>

                @can('payment_plan_create')
                    <a class="btn btn-indigo" href="{{ route('admin.payment-plans.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.paymentPlan.title_singular') }}
                    </a>
                @endcan
            </div>
        </div>
        @livewire('payment-plan.index')

    </div>
@endsection
