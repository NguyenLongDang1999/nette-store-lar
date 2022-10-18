@extends('layouts.backend.index')

@section('title', 'Category Create Page')

@section('pageCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    {{--    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}">--}}
@endsection

@section('pageJS')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    {{--    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>--}}
    <script></script>
@endsection

@section('header')
    <li class="breadcrumb-item text-capitalize">
        <a href="{{ route('admin.category.index') }}">{{ __('trans.category.manager') }}</a>
    </li>

    <li class="breadcrumb-item text-capitalize active">{{ __('trans.action.create') }}</li>
@endsection

@section('content')
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <a href="{{ route('admin.category.index') }}" class="btn btn-label-danger text-capitalize mb-4">--}}
{{--                <span class="tf-icons bx bx-arrow-back"></span> {{ __('trans.action.back') }}--}}
{{--            </a>--}}
{{--        </div>--}}

{{--        <div class="col-12">--}}
{{--            {{ Aire::open()->route('admin.category.store')->multipart()->rules($result['rules'])->messages($result['message'])->validate($result['rules'], $result['message']) }}--}}
{{--            {{ Aire::summary()->verbose() }}--}}
{{--            <div class="card mb-4">--}}
{{--                <h5 class="card-header text-capitalize">{{ __('trans.create.basic') }}</h5>--}}

{{--                <div class="card-body">--}}
{{--                    <div class="row g-3">--}}
{{--                        <div class="col-md-6">--}}
{{--                            {{ Aire::input('name', __('trans.category.title')) }}--}}
{{--                        </div>--}}

{{--                        <div class="col-md-6">--}}
{{--                            {{ Aire::input('slug', __('trans.slug')) }}--}}
{{--                        </div>--}}

{{--                        <div class="col-md-6">--}}
{{--                            {{ Aire::select($getCategoryList ?? [], 'parent_id', __('trans.category.parent_id')) }}--}}
{{--                        </div>--}}

{{--                        <div class="col-md-6">--}}
{{--                            {{ Aire::input('description', __('trans.description')) }}--}}
{{--                        </div>--}}

{{--                        <div class="col-md-6">--}}
{{--                            {{ Aire::select(optionStatus() ?? [], 'status', __('trans.status')) }}--}}
{{--                        </div>--}}

{{--                        <div class="col-md-6">--}}
{{--                            {{ Aire::select(optionPopular() ?? [], 'popular', __('trans.popular')) }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card mb-4">--}}
{{--                <h5 class="card-header text-capitalize">{{ __('trans.create.image') }}</h5>--}}

{{--                <div class="card-body">--}}
{{--                    <div class="d-flex align-items-start align-items-sm-center gap-4">--}}
{{--                        <img src="" class="d-block rounded" id="uploaded-image" width="150" height="150" title="Image"--}}
{{--                             alt="Image"--}}
{{--                        >--}}

{{--                        <div class="button-wrapper">--}}
{{--                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">--}}
{{--                                <span class="d-none d-sm-block">Chọn Hình</span>--}}
{{--                                <i class="bx bx-upload d-block d-sm-none"></i>--}}
{{--                                {{ Aire::file('image')->setAttribute('hidden', 'hidden')->accept('image/png, image/jpeg')->class('image-file-input')->groupHide()->id('upload') }}--}}
{{--                            </label>--}}

{{--                            <button type="button" class="btn btn-label-secondary image-file-reset mb-4">--}}
{{--                                <i class="bx bx-reset d-block d-sm-none"></i>--}}
{{--                                <span class="d-none d-sm-block">Làm Mới</span>--}}
{{--                            </button>--}}

{{--                            <p class="mb-0">Chấp nhận ảnh JPG, GIF or PNG.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card mb-4">--}}
{{--                <h5 class="card-header text-capitalize">{{ __('trans.seo.title') }}</h5>--}}

{{--                <div class="card-body">--}}
{{--                    <div class="row g-3">--}}
{{--                        <div class="col-12">--}}
{{--                            {{ Aire::textArea('meta_title', __('trans.seo.meta_title')) }}--}}
{{--                        </div>--}}

{{--                        <div class="col-12">--}}
{{--                            {{ Aire::textArea('meta_keyword', __('trans.seo.meta_keyword')) }}--}}
{{--                        </div>--}}

{{--                        <div class="col-12">--}}
{{--                            {{ Aire::textArea('meta_description', __('trans.seo.meta_description')) }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-12">--}}
{{--                {{ Aire::submit(__('trans.action.create'))->addClass('btn-primary') }}--}}
{{--            </div>--}}
{{--            {{ Aire::close() }}--}}
{{--        </div>--}}
{{--    </div>--}}

<livewire:backend.category.category-create/>
@endsection
