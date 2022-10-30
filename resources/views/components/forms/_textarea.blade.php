@if($type === config('constants.TEXT_AREA'))
    {{ html()->label($label, $name)->class('form-label') }}

    @isset($value)
        {{ html()->textarea($name)->class('form-control')->addClass($errors->has($name) ? 'is-invalid' : '')->value($value) }}
    @else
        {{ html()->textarea($name)->class('form-control')->addClass($errors->has($name) ? 'is-invalid' : '') }}
    @endisset

    @if($errors->has($name))
        <div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>
    @endif
@endif
