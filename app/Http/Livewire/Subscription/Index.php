<?php

namespace App\Http\Livewire\Subscription;

use App\Http\Livewire\WithConfirmation;
use App\Http\Livewire\WithSorting;
use App\Models\Subscription;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithSorting, WithConfirmation;

    public int $perPage;

    public array $orderable;

    public string $search = '';

    public array $selected = [];

    public array $paginationOptions;

    protected $queryString = [
        'search' => [
            'except' => '',
        ],
        'sortBy' => [
            'except' => 'id',
        ],
        'sortDirection' => [
            'except' => 'desc',
        ],
    ];

    public function getSelectedCountProperty()
    {
        return count($this->selected);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function resetSelected()
    {
        $this->selected = [];
    }

    public function mount()
    {
        $this->sortBy            = 'id';
        $this->sortDirection     = 'desc';
        $this->perPage           = 100;
        $this->paginationOptions = config('project.pagination.options');
        $this->orderable         = (new Subscription())->orderable;
    }

    public function render()
    {
        $user = auth()->user();
        if (auth()->user()->isAdmin) {
            $subscriptions = Subscription::with(['customer', 'paymentPlan', 'product'])
                ->advancedFilter([
                    's'               => $this->search ?: null,
                    'order_column'    => $this->sortBy,
                    'order_direction' => $this->sortDirection,
                ])
                ->paginate($this->perPage);
        } else {
            $subscriptions = Subscription::with(['customer', 'paymentPlan', 'product'])
                ->where('customer_id', $user->id)
                ->advancedFilter([
                    's'               => $this->search ?: null,
                    'order_column'    => $this->sortBy,
                    'order_direction' => $this->sortDirection,
                ])
                ->paginate($this->perPage);
        }

        // Ensure $subscriptions is an empty array when it's null
        $subscriptions = $subscriptions ?: [];

        return view('livewire.subscription.index', compact('subscriptions'));
    }


    public function deleteSelected()
    {
        abort_if(Gate::denies('subscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        Subscription::whereIn('id', $this->selected)->delete();

        $this->resetSelected();
    }

    public function delete(Subscription $subscription)
    {
        abort_if(Gate::denies('subscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscription->delete();
    }
}
