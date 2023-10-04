<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BusinessController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('business_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.business.index');
    }

    public function create()
    {
        abort_if(Gate::denies('business_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.business.create');
    }

    public function edit(Business $business)
    {
        abort_if(Gate::denies('business_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.business.edit', compact('business'));
    }

    public function show(Business $business)
    {
        abort_if(Gate::denies('business_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.business.show', compact('business'));
    }
}
