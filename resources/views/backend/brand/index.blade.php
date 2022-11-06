@extends('layouts.backend.index')

@section('title', 'Brand Page')

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
    @include('backend.brand.components.scripts')
@endsection

@section('header')
    <li class="breadcrumb-item text-capitalize">
        {{ html()->a(route('admin.brand.index'), __('trans.brand.manager')) }}
    </li>

    <li class="breadcrumb-item text-capitalize active">{{ __('trans.list') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.brand.create') }}" class="btn btn-label-primary text-capitalize mb-4">
                <span class="tf-icons bx bx-plus"></span> {{ __('trans.action.create') }}
            </a>
        </div>

        <div class="col-12">
            <x-_messages/>
        </div>

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header text-capitalize">{{ __('trans.list') }}</h5>

                <div class="card-body">
                    @includeIf('backend.brand.components.search')

                    <div class="col-12">
                        <hr/>

                        <table class="dt-responsive table table-bordered text-nowrap" id="brand-table">
                            <thead class="text-uppercase">
                                <tr>
                                    <th></th>
                                    <th>{{ __('trans.info') }}</th>
                                    <th>{{ __('trans.status') }}</th>
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
