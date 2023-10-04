<?php

namespace App\Http\Livewire\Business;

use App\Models\Business;
use Livewire\Component;

class Create extends Component
{
    public Business $business;

    public function mount(Business $business)
    {
        $this->business = $business;
    }

    public function render()
    {
        return view('livewire.business.create');
    }

    public function submit()
    {
        $this->validate();

        $this->business->save();

        return redirect()->route('admin.businesses.index');
    }

    protected function rules(): array
    {
        return [
            'business.name' => [
                'string',
                'nullable',
            ],
            'business.registration_number' => [
                'string',
                'required',
                'unique:businesses,registration_number',
            ],
            'business.address' => [
                'string',
                'nullable',
            ],
            'business.phone' => [
                'string',
                'required',
            ],
            'business.email' => [
                'email:rfc',
                'nullable',
            ],
            'business.website' => [
                'string',
                'nullable',
            ],
        ];
    }
}
