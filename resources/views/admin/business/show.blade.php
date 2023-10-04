@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.business.title_singular') }}:
                    {{ trans('cruds.business.fields.id') }}
                    {{ $business->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.business.fields.id') }}
                            </th>
                            <td>
                                {{ $business->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.business.fields.name') }}
                            </th>
                            <td>
                                {{ $business->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.business.fields.registration_number') }}
                            </th>
                            <td>
                                {{ $business->registration_number }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.business.fields.address') }}
                            </th>
                            <td>
                                {{ $business->address }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.business.fields.phone') }}
                            </th>
                            <td>
                                {{ $business->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.business.fields.email') }}
                            </th>
                            <td>
                                <a class="link-light-blue" href="mailto:{{ $business->email }}">
                                    <i class="far fa-envelope fa-fw">
                                    </i>
                                    {{ $business->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.business.fields.website') }}
                            </th>
                            <td>
                                {{ $business->website }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('business_edit')
                    <a href="{{ route('admin.businesses.edit', $business) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.businesses.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection