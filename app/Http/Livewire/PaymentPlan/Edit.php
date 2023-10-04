<?php

namespace App\Http\Livewire\PaymentPlan;

use App\Models\PaymentPlan;
use Livewire\Component;

class Edit extends Component
{
    public PaymentPlan $paymentPlan;

    public array $listsForFields = [];

    public function mount(PaymentPlan $paymentPlan)
    {
        $this->paymentPlan = $paymentPlan;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.payment-plan.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->paymentPlan->save();

        return redirect()->route('admin.payment-plans.index');
    }

    protected function rules(): array
    {
        return [
            'paymentPlan.name' => [
                'string',
                'required',
            ],
            'paymentPlan.duration' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['duration'])),
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['duration'] = $this->paymentPlan::DURATION_SELECT;
    }
}
