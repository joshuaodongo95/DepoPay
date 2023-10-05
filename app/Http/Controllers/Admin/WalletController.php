<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\Wallet;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WalletController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('wallet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.wallet.index');
    }

    public function create()
    {
        abort_if(Gate::denies('wallet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.wallet.create');
    }

    public function edit(Wallet $wallet)
    {
        abort_if(Gate::denies('wallet_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.wallet.edit', compact('wallet'));
    }

    public function show(Wallet $wallet)
    {
        abort_if(Gate::denies('wallet_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wallet->load('business');

        return view('admin.wallet.show', compact('wallet'));
    }

    public function __construct()
    {
        $this->csvImportModel = Wallet::class;
    }
}
