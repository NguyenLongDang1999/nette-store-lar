@extends('layouts.backend.index')

@section('title', $row->name ?? 'Brand Create Page')

@section('pageCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
@endsection

@section('pageJS')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
@endsection

@section('header')
    <li class="breadcrumb-item text-capitalize">
        {{ html()->a(route('admin.brand.index'), __('trans.brand.manager')) }}
    </li>

    <li class="breadcrumb-item text-capitalize active">
        {{ $row->name ?? __('trans.action.create') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            {{ html()->a(route('admin.brand.index'))->class('btn btn-label-secondary text-capitalize mb-4')->open() }}
            {{ html()->span()->class('tf-icons bx bx-arrow-back') }}
            {{ __('trans.action.back') }}
            {{ html()->a()->close()}}
        </div>

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header text-capitalize">{{ isset($row) ? __('trans.action.update') : __('trans.action.create') }} {{ __('trans.brand.name') }}</h5>

                <hr class="mt-0">

                <div class="card-body">
                    {{ html()->form()->action(isset($row) ? $routeUpdate : $routeCreate)->class('row g-3')->acceptsFiles()->open() }}
                    {{ html()->hidden('id', $row->id ?? NULL) }}

                    <div class="col-md-12">
                        <x-forms._text
                            name="name"
                            :label="__('trans.brand.title')"
                            :value=" $row->name ?? NULL"
                        />
                    </div>

                    <div class="col-md-6">
                        <x-forms._text
                            name="description"
                            :label="__('trans.description')"
                            :value=" $row->description ?? NULL"
                        />
                    </div>

                    <div class="col-md-6">
                        <x-forms._select
                            name="status"
                            :arr-list="optionStatus() ?? []"
                            :label="__('trans.status')"
                            :value="$row->status ?? NULL"
                        />
                    </div>

                    <div class="col-12">
                        <hr>
                        <x-forms._upload_once
                            name="image_uri"
                            :path="config('constants.PATH_BRAND')"
                            :value="$row->image_uri ?? NULL"
                        />
                        <hr>
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
