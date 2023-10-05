<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('wallet_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Wallet" format="csv" />
                <livewire:excel-export model="Wallet" format="xlsx" />
                <livewire:excel-export model="Wallet" format="pdf" />
            @endif


            @can('wallet_create')
                <x-csv-import route="{{ route('admin.wallets.csv.store') }}" />
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
                            {{ trans('cruds.wallet.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.wallet.fields.name') }}
                            @include('components.table.sort', ['field' => 'name'])
                        </th>
                        <th>
                            {{ trans('cruds.wallet.fields.msisdn') }}
                            @include('components.table.sort', ['field' => 'msisdn'])
                        </th>
                        <th>
                            {{ trans('cruds.wallet.fields.business') }}
                            @include('components.table.sort', ['field' => 'business.name'])
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.registration_number') }}
                            @include('components.table.sort', ['field' => 'business.registration_number'])
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.address') }}
                            @include('components.table.sort', ['field' => 'business.address'])
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.phone') }}
                            @include('components.table.sort', ['field' => 'business.phone'])
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.email') }}
                            @include('components.table.sort', ['field' => 'business.email'])
                        </th>
                        <th>
                            {{ trans('cruds.business.fields.website') }}
                            @include('components.table.sort', ['field' => 'business.website'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($wallets as $wallet)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $wallet->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $wallet->id }}
                            </td>
                            <td>
                                {{ $wallet->name }}
                            </td>
                            <td>
                                {{ $wallet->msisdn }}
                            </td>
                            <td>
                                @if($wallet->business)
                                    <span class="badge badge-relationship">{{ $wallet->business->name ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($wallet->business)
                                    {{ $wallet->business->registration_number ?? '' }}
                                @endif
                            </td>
                            <td>
                                @if($wallet->business)
                                    {{ $wallet->business->address ?? '' }}
                                @endif
                            </td>
                            <td>
                                @if($wallet->business)
                                    {{ $wallet->business->phone ?? '' }}
                                @endif
                            </td>
                            <td>
                                @if($wallet->business)
                                    <a class="link-light-blue" href="mailto:{{ $wallet->business->email ?? '' }}">
                                        <i class="far fa-envelope fa-fw">
                                        </i>
                                        {{ $wallet->business->email ?? '' }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($wallet->business)
                                    {{ $wallet->business->website ?? '' }}
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('wallet_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.wallets.show', $wallet) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('wallet_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.wallets.edit', $wallet) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('wallet_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $wallet->id }})" wire:loading.attr="disabled">
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
            {{ $wallets->links() }}
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