<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('paymentPlan.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.paymentPlan.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="paymentPlan.name">
        <div class="validation-message">
            {{ $errors->first('paymentPlan.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.paymentPlan.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('paymentPlan.duration') ? 'invalid' : '' }}">
        <label class="form-label">{{ trans('cruds.paymentPlan.fields.duration') }}</label>
        <select class="form-control" wire:model="paymentPlan.duration">
            <option value="null" disabled>{{ trans('global.pleaseSelect') }}...</option>
            @foreach($this->listsForFields['duration'] as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
        <div class="validation-message">
            {{ $errors->first('paymentPlan.duration') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.paymentPlan.fields.duration_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.payment-plans.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>