<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessRequest;
use App\Http\Requests\UpdateBusinessRequest;
use App\Http\Resources\Admin\BusinessResource;
use App\Models\Business;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BusinessApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusinessResource(Business::all());
    }

    public function store(StoreBusinessRequest $request)
    {
        $business = Business::create($request->validated());

        return (new BusinessResource($business))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Business $business)
    {
        abort_if(Gate::denies('business_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BusinessResource($business);
    }

    public function update(UpdateBusinessRequest $request, Business $business)
    {
        $business->update($request->validated());

        return (new BusinessResource($business))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Business $business)
    {
        abort_if(Gate::denies('business_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $business->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
