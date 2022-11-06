<!DOCTYPE html>

<html
    lang="vi"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}"
    data-template="vertical-menu-template-no-customizer"
>
    <head>
        <meta charset="utf-8"/>
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
        />

        <title>Login - CMS Store</title>
        @include('layouts.backend.linkCSS')
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}"/>
    </head>

    <body>
        <!-- Content -->

        <div class="container-xxl">
            <div class="authentication-wrapper authentication-basic container-p-y">
                <div class="authentication-inner py-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="app-brand justify-content-center">
                                {{ html()->a(route('login'))->class('app-brand-link gap-2')->open() }}
                                <x-application-logo class="app-brand-logo demo"/>
                                {{ html()->a()->close() }}
                            </div>

                            {{ html()->form('POST', route('login'))->class('mb-3')->open() }}
                            <div class="mb-3">
                                <x-forms._text name="email" :label="__('trans.auth.email')"/>
                            </div>

                            <div class="mb-3">
                                <x-forms._password name="password" :label="__('trans.auth.password')"/>
                            </div>

                            <div class="mb-3">
                                <x-forms._checkbox name="remember" :label="__('trans.auth.remember')"/>
                            </div>

                            <div class="mb-3">
                                {{ html()->submit(__('trans.auth.login'))->class('btn btn-primary text-capitalize d-grid w-100') }}
                            </div>
                            {{ html()->form()->close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.backend.linkJS')
    </body>
</html>

