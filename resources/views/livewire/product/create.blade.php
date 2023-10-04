<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('product.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.product.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="product.name">
        <div class="validation-message">
            {{ $errors->first('product.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.description') ? 'invalid' : '' }}">
        <label class="form-label" for="description">{{ trans('cruds.product.fields.description') }}</label>
        <textarea class="form-control" name="description" id="description" wire:model.defer="product.description" rows="4"></textarea>
        <div class="validation-message">
            {{ $errors->first('product.description') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.description_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('mediaCollections.product_picture') ? 'invalid' : '' }}">
        <label class="form-label required" for="picture">{{ trans('cruds.product.fields.picture') }}</label>
        <x-dropzone id="picture" name="picture" action="{{ route('admin.products.storeMedia') }}" collection-name="product_picture" max-file-size="10" max-width="4096" max-height="4096" />
        <div class="validation-message">
            {{ $errors->first('mediaCollections.product_picture') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.picture_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.unit_price') ? 'invalid' : '' }}">
        <label class="form-label required" for="unit_price">{{ trans('cruds.product.fields.unit_price') }}</label>
        <input class="form-control" type="number" name="unit_price" id="unit_price" required wire:model.defer="product.unit_price" step="0.01">
        <div class="validation-message">
            {{ $errors->first('product.unit_price') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.unit_price_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.business_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="business">{{ trans('cruds.product.fields.business') }}</label>
        <x-select-list class="form-control" required id="business" name="business" :options="$this->listsForFields['business']" wire:model="product.business_id" />
        <div class="validation-message">
            {{ $errors->first('product.business_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.business_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('product.category_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="category">{{ trans('cruds.product.fields.category') }}</label>
        <x-select-list class="form-control" required id="category" name="category" :options="$this->listsForFields['category']" wire:model="product.category_id" />
        <div class="validation-message">
            {{ $errors->first('product.category_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.product.fields.category_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>