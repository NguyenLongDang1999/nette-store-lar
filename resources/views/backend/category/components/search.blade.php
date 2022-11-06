{{ html()->form()->action(route('admin.category.getList'))->class('row g-3')->id('frmSearch')->attribute('onsubmit', 'return false')->open() }}
<div class="col-md-6">
    <x-forms._text
        name="search[name]"
        :label="__('trans.category.title')"
    />
</div>

<div class="col-md-6">
    <x-forms._select
        name="search[parent_id]"
        :arr-list="$getCategoryList ?? []"
        :label="__('trans.category.parent_id')"
        :value="NULL"
    />
</div>

<div class="col-md-6">
    <x-forms._select
        name="search[status]"
        :arr-list="optionStatus() ?? []"
        :label="__('trans.status')"
        :value="NULL"
    />
</div>

<div class="col-md-6">
    <x-forms._select
        name="search[popular]"
        :arr-list="optionPopular() ?? []"
        :label="__('trans.popular')"
        :value="NULL"
    />
</div>

<div class="col-12 text-center">
    {{ html()->button(__('trans.action.search'))->class('btn btn-sm btn-primary text-capitalize')->id('btnFrmSearch') }}
    {{ html()->reset(__('trans.action.reset'))->class('btn btn-sm btn-warning text-capitalize')->id('btnFrmReset') }}
</div>
{{ html()->form()->close() }}
