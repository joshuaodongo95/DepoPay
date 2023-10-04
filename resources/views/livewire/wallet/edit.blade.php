<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('wallet.name') ? 'invalid' : '' }}">
        <label class="form-label" for="name">{{ trans('cruds.wallet.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" wire:model.defer="wallet.name">
        <div class="validation-message">
            {{ $errors->first('wallet.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.wallet.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('wallet.msisdn') ? 'invalid' : '' }}">
        <label class="form-label required" for="msisdn">{{ trans('cruds.wallet.fields.msisdn') }}</label>
        <input class="form-control" type="text" name="msisdn" id="msisdn" required wire:model.defer="wallet.msisdn">
        <div class="validation-message">
            {{ $errors->first('wallet.msisdn') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.wallet.fields.msisdn_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.wallets.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>