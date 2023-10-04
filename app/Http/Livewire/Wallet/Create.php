<?php

namespace App\Http\Livewire\Wallet;

use App\Models\Wallet;
use Livewire\Component;

class Create extends Component
{
    public Wallet $wallet;

    public function mount(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function render()
    {
        return view('livewire.wallet.create');
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
        ];
    }
}
