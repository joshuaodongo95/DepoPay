<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('subscription.customer_id') ? 'invalid' : '' }}">
        <label class="form-label" for="customer">{{ trans('cruds.subscription.fields.customer') }}</label>
        <x-select-list class="form-control" id="customer" name="customer" :options="$this->listsForFields['customer']" wire:model="subscription.customer_id" />
        <div class="validation-message">
            {{ $errors->first('subscription.customer_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.subscription.fields.customer_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('subscription.ref') ? 'invalid' : '' }}">
        <label class="form-label" for="ref">{{ trans('cruds.subscription.fields.ref') }}</label>
        <input class="form-control" type="text" name="ref" id="ref" wire:model.defer="subscription.ref">
        <div class="validation-message">
            {{ $errors->first('subscription.ref') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.subscription.fields.ref_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('subscription.payment_plan_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="payment_plan">{{ trans('cruds.subscription.fields.payment_plan') }}</label>
        <x-select-list class="form-control" required id="payment_plan" name="payment_plan" :options="$this->listsForFields['payment_plan']" wire:model="subscription.payment_plan_id" />
        <div class="validation-message">
            {{ $errors->first('subscription.payment_plan_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.subscription.fields.payment_plan_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('subscription.status') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.subscription.fields.status') }}</label>
        <select class="form-control" wire:model="subscription.status">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['status'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('subscription.status') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.subscription.fields.status_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('subscription.currency') ? 'invalid' : '' }}">
        <label class="form-label" for="currency">{{ trans('cruds.subscription.fields.currency') }}</label>
        <input class="form-control" type="text" name="currency" id="currency" wire:model.defer="subscription.currency">
        <div class="validation-message">
            {{ $errors->first('subscription.currency') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.subscription.fields.currency_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('subscription.product_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="product">{{ trans('cruds.subscription.fields.product') }}</label>
        <x-select-list class="form-control" required id="product" name="product" :options="$this->listsForFields['product']" wire:model="subscription.product_id" />
        <div class="validation-message">
            {{ $errors->first('subscription.product_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.subscription.fields.product_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.subscriptions.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>