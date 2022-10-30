{{ html()->form()->action(route('admin.category.getList'))->class('row g-3')->id('frmSearch')->attribute('onsubmit', 'return false')->open() }}
<div class="col-md-6">
    @includeIf('components.forms._text', [
        'type' => config('constants.TEXT'),
        'label' => __('trans.category.title'),
        'name' => 'search[name]'
    ])
</div>

<div class="col-md-6">
    @includeIf('components.forms._select', [
        'type' => config('constants.SELECT'),
        'arrList' => $getCategoryList ?? [],
        'label' => __('trans.category.parent_id'),
        'name' => 'search[parent_id]',
        'value' => NULL
    ])
</div>

<div class="col-md-6">
    @includeIf('components.forms._select', [
        'type' => config('constants.SELECT'),
        'arrList' => optionStatus() ?? [],
        'label' => __('trans.status'),
        'name' => 'search[status]',
        'value' => NULL
    ])
</div>

<div class="col-md-6">
    @includeIf('components.forms._select', [
        'type' => config('constants.SELECT'),
        'arrList' => optionPopular() ?? [],
        'label' => __('trans.popular'),
        'name' => 'search[popular]',
        'value' => NULL
    ])
</div>

<div class="col-12 text-center">
    {{ html()->button(__('trans.action.search'))->class('btn btn-sm btn-primary text-capitalize')->id('btnFrmSearch') }}
    {{ html()->reset(__('trans.action.reset'))->class('btn btn-sm btn-warning text-capitalize')->id('btnFrmReset') }}
</div>
{{ html()->form()->close() }}
