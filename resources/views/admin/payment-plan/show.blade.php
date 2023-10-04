@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.paymentPlan.title_singular') }}:
                    {{ trans('cruds.paymentPlan.fields.id') }}
                    {{ $paymentPlan->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.paymentPlan.fields.id') }}
                            </th>
                            <td>
                                {{ $paymentPlan->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.paymentPlan.fields.name') }}
                            </th>
                            <td>
                                {{ $paymentPlan->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.paymentPlan.fields.duration') }}
                            </th>
                            <td>
                                {{ $paymentPlan->duration_label }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('payment_plan_edit')
                    <a href="{{ route('admin.payment-plans.edit', $paymentPlan) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.payment-plans.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection