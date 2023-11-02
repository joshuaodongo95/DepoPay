<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Models\Subscription;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Bmatovu\MtnMomo\Products\Collection;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubscriptionController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('subscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subscription.index');
    }

    public function store(StoreSubscriptionRequest $request)
    {
        $subscription = Subscription::create($request->validated());
        // Create subscription to momo here after saving subscription
        if($subscription){            
            try {
                $collection = new Collection();
                
                $referenceId = $collection->requestToPay($subscription->id, '46733123450', 100);
                $subscription->ref = $referenceId;
                $subscription->save();
            } catch(CollectionRequestException $e) {
                do {
                    printf("\n\r%s:%d %s (%d) [%s]\n\r", 
                    $e->getFile(), $e->getLine(), $e->getMessage(), $e->getCode(), get_class($e));
                } while($e = $e->getPrevious());
            }
            
        }
        return view('admin.user.index');
    }


    public function create()
    {
        abort_if(Gate::denies('subscription_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subscription.create');
    }

    public function edit(Subscription $subscription)
    {
        abort_if(Gate::denies('subscription_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.subscription.edit', compact('subscription'));
    }

    // public function show(Subscription $subscription)
    // {
    //     abort_if(Gate::denies('subscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $subscription->load('customer', 'paymentPlan', 'product');

    //     return view('admin.subscription.show', compact('subscription'));
    // }
    public function show(Subscription $subscription)
    {
        $user = auth()->user();

        // Check if the user is the owner of the subscription or has permission to view subscriptions
        if ($user->id === $subscription->customer_id || $user->can('subscription_show')) {
            $subscription->load('customer', 'paymentPlan', 'product');

            return view('admin.subscription.show', compact('subscription'));
        }

        abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
    }


    public function __construct()
    {
        $this->csvImportModel = Subscription::class;
    }
}
