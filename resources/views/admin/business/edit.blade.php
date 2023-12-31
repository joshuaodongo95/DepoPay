@extends('layouts.admin')
@section('content')
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.business.title_singular') }}:
                    {{ trans('cruds.business.fields.id') }}
                    {{ $business->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('business.edit', [$business])
        </div>
    </div>
@endsection
