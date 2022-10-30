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
            <div class="card mb-4">
                <h5 class="card-header text-capitalize">{{ isset($row) ? __('trans.action.update') : __('trans.action.create') }} {{ __('trans.category.name') }}</h5>

                <hr class="mt-0">

                <div class="card-body">
                    {{ html()->form()->action(isset($row) ? $routeUpdate : $routeCreate)->class('row g-3')->acceptsFiles()->open() }}
                    {{ html()->hidden('id', $row->id ?? NULL) }}

                    <div class="col-md-12">
                        @includeIf('components.forms._text', [
                            'type' => config('constants.TEXT'),
                            'label' => __('trans.category.title'),
                            'name' => 'name',
                            'value' => $row->name ?? NULL
                        ])
                    </div>

                    <div class="col-md-6">
                        @includeIf('components.forms._select', [
                            'type' => config('constants.SELECT'),
                            'arrList' => $getCategoryList ?? [],
                            'label' => __('trans.category.parent_id'),
                            'name' => 'parent_id',
                            'value' => $row->parent_id ?? NULL
                        ])
                    </div>

                    <div class="col-md-6">
                        @includeIf('components.forms._text', [
                            'type' => config('constants.TEXT'),
                            'label' => __('trans.description'),
                            'name' => 'description',
                            'value' => $row->description ?? NULL
                        ])
                    </div>

                    <div class="col-md-6">
                        @includeIf('components.forms._select', [
                            'type' => config('constants.SELECT'),
                            'arrList' => optionStatus() ?? [],
                            'label' => __('trans.status'),
                            'name' => 'status',
                            'value' => $row->status ?? NULL
                        ])
                    </div>

                    <div class="col-md-6">
                        @includeIf('components.forms._select', [
                            'type' => config('constants.SELECT'),
                            'arrList' => optionPopular() ?? [],
                            'label' => __('trans.popular'),
                            'name' => 'popular',
                            'value' => $row->popular ?? NULL
                        ])
                    </div>

                    <div class="col-12">
                        <hr>
                        @includeIf('components.forms._upload_once', [
                            'type' => config('constants.UPLOAD_ONCE'),
                            'path' => config('constants.PATH_CATEGORY'),
                            'name' => 'image_uri',
                            'value' => $row->image_uri ?? NULL
                        ])
                        <hr>
                    </div>

                    <div class="col-12">
                        @includeIf('components.forms._textarea', [
                            'type' => config('constants.TEXT_AREA'),
                            'label' => __('trans.seo.meta_title'),
                            'name' => 'meta_title',
                            'value' => $row->meta_title ?? NULL
                        ])
                    </div>

                    <div class="col-12">
                        @includeIf('components.forms._textarea', [
                            'type' => config('constants.TEXT_AREA'),
                            'label' => __('trans.seo.meta_keyword'),
                            'name' => 'meta_keyword',
                            'value' => $row->meta_keyword ?? NULL
                        ])
                    </div>

                    <div class="col-12">
                        @includeIf('components.forms._textarea', [
                            'type' => config('constants.TEXT_AREA'),
                            'label' => __('trans.seo.meta_description'),
                            'name' => 'meta_description',
                            'value' => $row->meta_description ?? NULL
                        ])
                    </div>

                    <div class="col-12">
                        {{ html()->submit(__('trans.action.save'))->class('btn btn-primary text-capitalize me-1') }}
                    </div>
                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
