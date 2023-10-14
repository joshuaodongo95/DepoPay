<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Resources\Admin\SubscriptionResource;
use App\Models\Subscription;
use Bmatovu\MtnMomo\Exceptions\CollectionRequestException;
use Bmatovu\MtnMomo\Products\Collection;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SubscriptionApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('subscription_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubscriptionResource(Subscription::with(['customer', 'paymentPlan', 'product'])->get());
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

        return (new SubscriptionResource($subscription))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Subscription $subscription)
    {
        abort_if(Gate::denies('subscription_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SubscriptionResource($subscription->load(['customer', 'paymentPlan', 'product']));
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update($request->validated());

        return (new SubscriptionResource($subscription))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Subscription $subscription)
    {
        abort_if(Gate::denies('subscription_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $subscription->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
