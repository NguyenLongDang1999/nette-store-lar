{{ html()->label($label, $name)->class('form-label') }}

@isset($value)
    {{ html()->password($name)->class('form-control')->addClass($errors->has($name) ? 'is-invalid' : '')->value($value) }}
@else
    {{ html()->password($name)->class('form-control')->addClass($errors->has($name) ? 'is-invalid' : '') }}
@endisset

@if($errors->has($name))
    <div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>
@endif
