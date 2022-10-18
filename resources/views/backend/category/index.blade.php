@extends('layouts.backend.index')

@section('title', 'Category Page')

@section('pageCSS')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}"
    >
@endsection

@section('pageJS')
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('header')
    <li class="breadcrumb-item text-capitalize">
        <a href="{{ route('admin.category.index') }}">{{ __('trans.category.manager') }}</a>
    </li>

    <li class="breadcrumb-item text-capitalize active">{{ __('trans.list') }}</li>
@endsection

@section('content')
    {{--    <div class="row">--}}
    {{--        <div class="col-12">--}}
    {{--            <a href="{{ route('admin.category.index') }}" class="btn btn-label-danger text-capitalize mb-4">--}}
    {{--                <span class="tf-icons bx bx-arrow-back"></span> {{ __('trans.action.back') }}--}}
    {{--            </a>--}}

    {{--            <a href="{{ route('admin.category.create') }}" class="btn btn-label-primary text-capitalize mb-4">--}}
    {{--                <span class="tf-icons bx bx-plus"></span> {{ __('trans.action.create') }}--}}
    {{--            </a>--}}

    {{--            <a href="{{ route('admin.category.recycle') }}" class="btn btn-label-secondary text-capitalize mb-4">--}}
    {{--                <span class="tf-icons bx bx-trash"></span> {{ __('trans.action.recycle') }}--}}
    {{--            </a>--}}
    {{--        </div>--}}

    {{--        <div class="col-12">--}}
    {{--            <div class="card mb-4">--}}
    {{--                <h5 class="card-header text-capitalize">{{ __('trans.list') }}</h5>--}}

    {{--                <div class="card-body">--}}
    {{--                    {{ Aire::open()->class('row g-3')->id('frmSearch')->route('admin.category.getList')->setAttribute('onsubmit', 'return false') }}--}}
    {{--                    <div class="col-md-6">--}}
    {{--                        {{ Aire::input('search[name]', __('trans.category.title')) }}--}}
    {{--                    </div>--}}

    {{--                    <div class="col-md-6">--}}
    {{--                        {{ Aire::select($getCategoryList ?? [], 'search[parent_id]', __('trans.category.parent_id')) }}--}}
    {{--                    </div>--}}

    {{--                    <div class="col-md-6">--}}
    {{--                        {{ Aire::select(optionStatus() ?? [], 'search[status]', __('trans.status')) }}--}}
    {{--                    </div>--}}

    {{--                    <div class="col-md-6">--}}
    {{--                        {{ Aire::select(optionPopular() ?? [], 'search[popular]', __('trans.popular')) }}--}}
    {{--                    </div>--}}

    {{--                    <div class="col-12 text-center">--}}
    {{--                        <hr/>--}}
    {{--                    </div>--}}
    {{--                    {{ Aire::close() }}--}}

    {{--                    <div class="col-12">--}}
    {{--                        {{ Aire::open()->id('frmTbList')->route('admin.category.getList')->get() }}--}}
    {{--                        <table class="dt-responsive table table-bordered text-nowrap" id="category-table">--}}
    {{--                            <thead>--}}
    {{--                                <tr>--}}
    {{--                                    <th></th>--}}
    {{--                                    <th></th>--}}
    {{--                                    <th>{{ __('trans.avatar') }}</th>--}}
    {{--                                    <th>{{ __('trans.category.title') }}</th>--}}
    {{--                                    <th>{{ __('trans.category.parent_id') }}</th>--}}
    {{--                                    <th>{{ __('trans.status') }}</th>--}}
    {{--                                    <th>{{ __('trans.popular') }}</th>--}}
    {{--                                    <th>{{ __('trans.created_at') }}</th>--}}
    {{--                                    <th>{{ __('trans.updated_at') }}</th>--}}
    {{--                                    <th>{{ __('trans.act') }}</th>--}}
    {{--                                </tr>--}}
    {{--                            </thead>--}}
    {{--                        </table>--}}
    {{--                        {{ Aire::close() }}--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{ Aire::button(__('trans.action.create'))->addClass('btn-primary')->setAttribute('data-bs-toggle', 'modal')->setAttribute('data-bs-target', '#showForm') }}
    <livewire:backend.category.category-list/>
{{--    <livewire:backend.category.category-create/>--}}
@endsection
