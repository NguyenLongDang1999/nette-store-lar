@extends('layouts.backend.index')

@section('title', $row->name ?? 'Category Create Page')

@section('pageCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
@endsection

@section('pageJS')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
@endsection

@section('header')
    <li class="breadcrumb-item text-capitalize">
        {{ html()->a(route('admin.category.index'), __('trans.category.manager')) }}
    </li>

    <li class="breadcrumb-item text-capitalize active">
        {{ $row->name ?? __('trans.action.create') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            {{ html()->a(route('admin.category.index'))->class('btn btn-label-secondary text-capitalize mb-4')->open() }}
            {{ html()->span()->class('tf-icons bx bx-arrow-back') }}
            {{ __('trans.action.back') }}
            {{ html()->a()->close()}}
        </div>

        <div class="col-12">
            @include('components._messages')
        </div>

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header text-capitalize">{{ isset($row) ? __('trans.action.update') : __('trans.action.create') }} {{ __('trans.category.name') }}</h5>

                <hr class="mt-0">

                <div class="card-body">
                    {{ html()->form()->action(route('admin.category.store'))->class('row g-3')->acceptsFiles()->open() }}
                    <div class="col-md-6">
                        {{ html()->label(__('trans.category.title'), 'name')->class('form-label') }}
                        {{ html()->text('name')->value($row->name ?? '')->class('form-control') }}
                    </div>

                    <div class="col-md-6">
                        {{ html()->label(__('trans.slug'), 'slug')->class('form-label') }}
                        {{ html()->text('slug')->value($row->slug ?? '')->class('form-control') }}
                    </div>

                    <div class="col-md-6">
                        {{ html()->label(__('trans.category.parent_id'), 'parent_id')->class('form-label') }}
                        {{ html()->select('parent_id', $getCategoryList ?? [], $row->parent_id ?? '')->class('bootstrap-select text-capitalize w-100')->attributes(['data-style' => 'btn-default text-capitalize', 'data-size' => 8]) }}
                    </div>

                    <div class="col-md-6">
                        {{ html()->label(__('trans.description'), 'description')->class('form-label') }}
                        {{ html()->text('description')->value($row->description ?? '')->class('form-control') }}
                    </div>

                    <div class="col-md-6">
                        {{ html()->label(__('trans.status'), 'status')->class('form-label') }}
                        {{ html()->select('status', optionStatus() ?? [], $row->status ?? '')->class('bootstrap-select text-capitalize w-100')->attributes(['data-style' => 'btn-default text-capitalize', 'data-size' => 8]) }}
                    </div>

                    <div class="col-md-6">
                        {{ html()->label(__('trans.popular'), 'popular')->class('form-label') }}
                        {{ html()->select('popular', optionPopular() ?? [], $row->popular ?? '')->class('bootstrap-select text-capitalize w-100')->attributes(['data-style' => 'btn-default text-capitalize', 'data-size' => 8]) }}
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            {{ html()->img('', 'Image')->class('d-block rounded')->id('uploaded-image')->attributes(['width' => 150, 'height' => 150]) }}

                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Chọn Hình</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>

                                    {{ html()->file('image')->acceptImage()->class('image-file-input')->id('upload')->attribute('hidden', 'hidden') }}
                                </label>

                                <button type="button" class="btn btn-label-secondary image-file-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Làm Mới</span>
                                </button>

                                <p class="mb-0">Chấp nhận ảnh JPG, GIF or PNG.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12">
                        {{ html()->label(__('trans.seo.meta_title'), 'meta_title')->class('form-label') }}
                        {{ html()->textarea('meta_title')->value($row->meta_title ?? '')->class('form-control') }}
                    </div>

                    <div class="col-12">
                        {{ html()->label(__('trans.seo.meta_keyword'), 'meta_keyword')->class('form-label') }}
                        {{ html()->textarea('meta_keyword')->value($row->meta_keyword ?? '')->class('form-control') }}
                    </div>

                    <div class="col-12">
                        {{ html()->label(__('trans.seo.meta_description'), 'meta_description')->class('form-label') }}
                        {{ html()->textarea('meta_description')->value($row->meta_description ?? '')->class('form-control') }}
                    </div>

                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-12">
                        {{ html()->submit(__('trans.action.create'))->class('btn btn-primary text-capitalize me-1') }}
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
