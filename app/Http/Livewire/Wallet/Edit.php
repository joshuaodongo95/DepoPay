<?php

namespace App\Http\Livewire\Wallet;

use App\Models\Business;
use App\Models\Wallet;
use Livewire\Component;

class Edit extends Component
{
    public Wallet $wallet;

    public array $listsForFields = [];

    public function mount(Wallet $wallet)
    {
        $this->wallet = $wallet;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.wallet.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->wallet->save();

        return redirect()->route('admin.wallets.index');
    }

    protected function rules(): array
    {
        return [
            'wallet.name' => [
                'string',
                'nullable',
            ],
            'wallet.msisdn' => [
                'string',
                'required',
            ],
            'wallet.business_id' => [
                'integer',
                'exists:businesses,id',
                'nullable',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['business'] = Business::pluck('name', 'id')->toArray();
    }
}
