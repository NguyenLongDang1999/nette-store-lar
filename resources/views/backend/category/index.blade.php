@extends('layouts.backend.index')

@section('title', 'Category Page')

@section('pageCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
@endsection

@section('pageJS')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    @include('backend.category.components.scripts')
@endsection

@section('header')
    <li class="breadcrumb-item text-capitalize">
        {{ html()->a(route('admin.category.index'), __('trans.category.manager')) }}
    </li>

    <li class="breadcrumb-item text-capitalize active">{{ __('trans.list') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.category.create') }}" class="btn btn-label-primary text-capitalize mb-4">
                <span class="tf-icons bx bx-plus"></span> {{ __('trans.action.create') }}
            </a>
        </div>

        <div class="col-12">
            @include('components._messages')
        </div>

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header text-capitalize">{{ __('trans.list') }}</h5>

                <div class="card-body">
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
                        {{ html()->button(__('trans.action.search'))->class('btn btn-sm btn-primary')->id('btnFrmSearch') }}
                        {{ html()->reset(__('trans.action.reset'))->class('btn btn-sm btn-warning')->id('btnFrmReset') }}
                    </div>
                    {{ html()->form()->close() }}

                    <div class="col-12">
                        <hr/>

                        <table class="dt-responsive table table-bordered text-nowrap" id="category-table">
                            <thead class="text-uppercase">
                                <tr>
                                    <th></th>
                                    <th>{{ __('trans.info') }}</th>
                                    <th>{{ __('trans.category.parent_id') }}</th>
                                    <th>{{ __('trans.status') }}</th>
                                    <th>{{ __('trans.popular') }}</th>
                                    <th>{{ __('trans.created_at') }}</th>
                                    <th>{{ __('trans.updated_at') }}</th>
                                    <th>{{ __('trans.act') }}</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components._action')
@endsection
