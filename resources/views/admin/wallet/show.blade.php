@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.wallet.title_singular') }}:
                    {{ trans('cruds.wallet.fields.id') }}
                    {{ $wallet->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.wallet.fields.id') }}
                            </th>
                            <td>
                                {{ $wallet->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.wallet.fields.name') }}
                            </th>
                            <td>
                                {{ $wallet->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.wallet.fields.msisdn') }}
                            </th>
                            <td>
                                {{ $wallet->msisdn }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('wallet_edit')
                    <a href="{{ route('admin.wallets.edit', $wallet) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.wallets.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection