@extends('layouts.backend.index')

@section('title', 'Profile Page')

@section('pageCSS')
@endsection

@section('pageJS')

@endsection

@section('header')
    <li class="breadcrumb-item text-capitalize active">{{ __('trans.profile.title') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Account</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-account-settings-security.html"><i class="bx bx-lock-alt me-1"></i>
                        Security</a>
                </li>
            </ul>

            <div class="card mb-4">
                <h5 class="card-header text-capitalize">{{ __('trans.profile.title') }}</h5>
                <!-- Account -->
                <div class="card-body">
                    <x-forms._upload_once
                        name="image_uri"
                        :path="config('constants.PATH_ADMIN')"
                        :value="$row->image_uri ?? NULL"
                    />
                </div>

                <hr class="my-0"/>

                <div class="card-body">
                    <form id="formAccountSettings" method="POST" onsubmit="return false">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="firstName"
                                    name="firstName"
                                    value="John"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input class="form-control" type="text" name="lastName" id="lastName" value="Doe"/>
                            </div>
                        </div>

                        <div class="mt-2">
                            {{ html()->submit(__('trans.action.save'))->class('btn btn-primary text-capitalize me-1') }}
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
