<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadTrait;
use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Requests\UpdateProductCategoryRequest;
use App\Http\Resources\Admin\ProductCategoryResource;
use App\Models\ProductCategory;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductCategoryApiController extends Controller
{
    use MediaUploadTrait;

    public function index()
    {
        abort_if(Gate::denies('product_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductCategoryResource(ProductCategory::all());
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $productCategory = ProductCategory::create($request->validated());

        if ($request->input('product_category_photo', false)) {
            $productCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_category_photo'))))->toMediaCollection('product_category_photo');
        }

        return (new ProductCategoryResource($productCategory))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ProductCategoryResource($productCategory);
    }

    public function update(UpdateProductCategoryRequest $request, ProductCategory $productCategory)
    {
        $productCategory->update($request->validated());

        if ($request->input('product_category_photo', false)) {
            if (! $productCategory->product_category_photo || $request->input('product_category_photo') !== $productCategory->product_category_photo->file_name) {
                if ($productCategory->product_category_photo) {
                    $productCategory->product_category_photo->delete();
                }
                $productCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('product_category_photo'))))->toMediaCollection('product_category_photo');
            }
        } elseif ($productCategory->product_category_photo) {
            $productCategory->product_category_photo->delete();
        }

        return (new ProductCategoryResource($productCategory))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ProductCategory $productCategory)
    {
        abort_if(Gate::denies('product_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productCategory->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
