{{ html()->label($label, $name)->class('form-label') }}
{{ html()->select($name, $arrList, $value)->class('bootstrap-select text-capitalize w-100')->attributes(['data-style' => 'btn-default text-capitalize', 'data-size' => 8]) }}

@if($errors->has($name))
    <div class="invalid-feedback d-block">{{ $errors->first($name) }}</div>
@endif
