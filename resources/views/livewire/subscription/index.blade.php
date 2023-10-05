<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('subscription_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Subscription" format="csv" />
                <livewire:excel-export model="Subscription" format="xlsx" />
                <livewire:excel-export model="Subscription" format="pdf" />
            @endif


            @can('subscription_create')
                <x-csv-import route="{{ route('admin.subscriptions.csv.store') }}" />
            @endcan

        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.subscription.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.subscription.fields.customer') }}
                            @include('components.table.sort', ['field' => 'customer.name'])
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                            @include('components.table.sort', ['field' => 'customer.email'])
                        </th>
                        <th>
                            {{ trans('cruds.subscription.fields.ref') }}
                            @include('components.table.sort', ['field' => 'ref'])
                        </th>
                        <th>
                            {{ trans('cruds.subscription.fields.payment_plan') }}
                            @include('components.table.sort', ['field' => 'payment_plan.name'])
                        </th>
                        <th>
                            {{ trans('cruds.paymentPlan.fields.duration') }}
                            @include('components.table.sort', ['field' => 'payment_plan.duration'])
                        </th>
                        <th>
                            {{ trans('cruds.subscription.fields.status') }}
                            @include('components.table.sort', ['field' => 'status'])
                        </th>
                        <th>
                            {{ trans('cruds.subscription.fields.currency') }}
                            @include('components.table.sort', ['field' => 'currency'])
                        </th>
                        <th>
                            {{ trans('cruds.subscription.fields.product') }}
                            @include('components.table.sort', ['field' => 'product.name'])
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.description') }}
                            @include('components.table.sort', ['field' => 'product.description'])
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.price') }}
                            @include('components.table.sort', ['field' => 'product.price'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subscriptions as $subscription)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $subscription->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $subscription->id }}
                            </td>
                            <td>
                                @if($subscription->customer)
                                    <span class="badge badge-relationship">{{ $subscription->customer->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($subscription->customer)
                                    <a class="link-light-blue" href="mailto:{{ $subscription->customer->email ?? '' }}">
                                        <i class="far fa-envelope fa-fw">
                                        </i>
                                        {{ $subscription->customer->email ?? '' }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $subscription->ref }}
                            </td>
                            <td>
                                @if($subscription->paymentPlan)
                                    <span class="badge badge-relationship">{{ $subscription->paymentPlan->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($subscription->paymentPlan)
                                    {{ $subscription->paymentPlan->duration_label }}
                                @endif
                            </td>
                            <td>
                                {{ $subscription->status_label }}
                            </td>
                            <td>
                                {{ $subscription->currency }}
                            </td>
                            <td>
                                @if($subscription->product)
                                    <span class="badge badge-relationship">{{ $subscription->product->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($subscription->product)
                                    {{ $subscription->product->description ?? '' }}
                                @endif
                            </td>
                            <td>
                                @if($subscription->product)
                                    {{ $subscription->product->price ?? '' }}
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('subscription_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.subscriptions.show', $subscription) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('subscription_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.subscriptions.edit', $subscription) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('subscription_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $subscription->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $subscriptions->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush