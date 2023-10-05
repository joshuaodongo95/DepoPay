<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWalletRequest;
use App\Http\Requests\UpdateWalletRequest;
use App\Http\Resources\Admin\WalletResource;
use App\Models\Wallet;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WalletApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('wallet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WalletResource(Wallet::with(['business'])->get());
    }

    public function store(StoreWalletRequest $request)
    {
        $wallet = Wallet::create($request->validated());

        return (new WalletResource($wallet))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Wallet $wallet)
    {
        abort_if(Gate::denies('wallet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WalletResource($wallet->load(['business']));
    }

    public function update(UpdateWalletRequest $request, Wallet $wallet)
    {
        $wallet->update($request->validated());

        return (new WalletResource($wallet))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Wallet $wallet)
    {
        abort_if(Gate::denies('wallet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wallet->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
