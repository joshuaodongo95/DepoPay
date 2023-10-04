<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('business.name') ? 'invalid' : '' }}">
        <label class="form-label" for="name">{{ trans('cruds.business.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" wire:model.defer="business.name">
        <div class="validation-message">
            {{ $errors->first('business.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.business.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('business.registration_number') ? 'invalid' : '' }}">
        <label class="form-label required" for="registration_number">{{ trans('cruds.business.fields.registration_number') }}</label>
        <input class="form-control" type="text" name="registration_number" id="registration_number" required wire:model.defer="business.registration_number">
        <div class="validation-message">
            {{ $errors->first('business.registration_number') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.business.fields.registration_number_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('business.address') ? 'invalid' : '' }}">
        <label class="form-label" for="address">{{ trans('cruds.business.fields.address') }}</label>
        <input class="form-control" type="text" name="address" id="address" wire:model.defer="business.address">
        <div class="validation-message">
            {{ $errors->first('business.address') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.business.fields.address_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('business.phone') ? 'invalid' : '' }}">
        <label class="form-label required" for="phone">{{ trans('cruds.business.fields.phone') }}</label>
        <input class="form-control" type="text" name="phone" id="phone" required wire:model.defer="business.phone">
        <div class="validation-message">
            {{ $errors->first('business.phone') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.business.fields.phone_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('business.email') ? 'invalid' : '' }}">
        <label class="form-label" for="email">{{ trans('cruds.business.fields.email') }}</label>
        <input class="form-control" type="email" name="email" id="email" wire:model.defer="business.email">
        <div class="validation-message">
            {{ $errors->first('business.email') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.business.fields.email_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('business.website') ? 'invalid' : '' }}">
        <label class="form-label" for="website">{{ trans('cruds.business.fields.website') }}</label>
        <input class="form-control" type="text" name="website" id="website" wire:model.defer="business.website">
        <div class="validation-message">
            {{ $errors->first('business.website') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.business.fields.website_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.businesses.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>