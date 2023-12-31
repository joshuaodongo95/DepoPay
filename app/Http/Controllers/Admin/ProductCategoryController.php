<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\WithCSVImport;
use App\Models\ProductCategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCategoryController extends Controller
{
    use WithCSVImport;

    public function index()
    {
        abort_if(Gate::denies('product_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.product-category.index');
    }

    public function create()
    {
        abort_if(Gate::denies('product_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.product-category.create');
    }

    public function edit(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.product-category.edit', compact('productCategory'));
    }

    public function show(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.product-category.show', compact('productCategory'));
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['product_category_create', 'product_category_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }
        if (request()->has('max_width') || request()->has('max_height')) {
            $this->validate(request(), [
                'file' => sprintf(
                    'image|dimensions:max_width=%s,max_height=%s',
                    request()->input('max_width', 100000),
                    request()->input('max_height', 100000)
                ),
            ]);
        }

        $model                     = new ProductCategory();
        $model->id                 = $request->input('model_id', 0);
        $model->exists             = true;
        $media                     = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));
        $media->wasRecentlyCreated = true;

        return response()->json(compact('media'), Response::HTTP_CREATED);
    }

    public function __construct()
    {
        $this->csvImportModel = ProductCategory::class;
    }
}
