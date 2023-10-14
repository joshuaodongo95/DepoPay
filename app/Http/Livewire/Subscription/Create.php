<?php

namespace App\Http\Livewire\Subscription;

use App\Models\PaymentPlan;
use App\Models\Product;
use App\Models\Subscription;
use App\Models\User;
use Livewire\Component;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Bmatovu\MtnMomo\Products\Collection;

class Create extends Component
{
    public array $listsForFields = [];

    public Subscription $subscription;

    public function mount(Subscription $subscription)
    {
        $this->subscription = $subscription;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.subscription.create');
    }

    public function submit()
    {
        $this->validate();

        $this->subscription->save();
        
        if ($this->subscription) {
            try {
                $referenceId = $this->handlePayment();
                $this->subscription->ref = $referenceId;
                $this->subscription->save();
            } catch (CollectionRequestException $e) {
                $this->handlePaymentException($e);
            }
        }
        
        return redirect()->route('admin.subscriptions.index');
    }

    private function handlePayment()
    {
        $collection = new Collection();
        // Request payment and return the referenceId
        return $collection->requestToPay($this->subscription->id, '46733123453', 100,'MoMO TEST','Pay in Cash');
    }

    private function handlePaymentException(CollectionRequestException $e)
    {
        do {
            printf(
                "\n\r%s:%d %s (%d) [%s]\n\r",
                $e->getFile(),
                $e->getLine(),
                $e->getMessage(),
                $e->getCode(),
                get_class($e)
            );
        } while ($e = $e->getPrevious());
    }

    protected function rules(): array
    {
        return [
            'subscription.customer_id' => [
                'integer',
                'exists:users,id',
                'nullable',
            ],
            'subscription.ref' => [
                'string',
                'nullable',
            ],
            'subscription.payment_plan_id' => [
                'integer',
                'exists:payment_plans,id',
                'required',
            ],
            'subscription.status' => [
                'nullable',
                'in:' . implode(',', array_keys($this->listsForFields['status'])),
            ],
            'subscription.currency' => [
                'string',
                'nullable',
            ],
            'subscription.product_id' => [
                'integer',
                'exists:products,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['customer']     = User::pluck('name', 'id')->toArray();
        $this->listsForFields['payment_plan'] = PaymentPlan::pluck('name', 'id')->toArray();
        $this->listsForFields['status']       = $this->subscription::STATUS_SELECT;
        $this->listsForFields['product']      = Product::pluck('name', 'id')->toArray();
    }
}
