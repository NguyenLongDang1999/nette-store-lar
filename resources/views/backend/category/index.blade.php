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

    <script>
        let categoryTable = $('#category-table'),
            click_mode = 0,
            aLengthMenuGeneral = [
                [20, 50, 100, 500, 1000],
                [20, 50, 100, 500, 1000]
            ];

        if (categoryTable.length) {
            var oTable = categoryTable.DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sPaginationType": "full_numbers",
                "sAjaxSource": "{{ route('admin.category.getList') }}",
                "bDeferRender": true,
                "bFilter": false,
                "bDestroy": true,
                "aLengthMenu": aLengthMenuGeneral,
                "iDisplayLength": 20,
                "bSort": true,
                "aaSorting": [
                    [5, "desc"]
                ],
                columns: [
                    {
                        data: ''
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'parent_id',
                        "bSortable": false
                    },
                    {
                        data: 'status',
                        "bSortable": false
                    },
                    {
                        data: 'popular',
                        "bSortable": false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'updated_at'
                    },
                    {
                        data: 'action',
                        "bSortable": false
                    },
                ],
                "fnServerParams": function (aoData) {
                    if (click_mode === 0) {
                        aoData.push({
                            "name": "search[name]",
                            "value": $('#frmSearch input[name="search[name]"]').val()
                        });
                        aoData.push({
                            "name": "search[parent_id]",
                            "value": $('#frmSearch select[name="search[parent_id]"]').val()
                        });
                        aoData.push({
                            "name": "search[status]",
                            "value": $('#frmSearch select[name="search[status]"]').val()
                        });
                        aoData.push({
                            "name": "search[popular]",
                            "value": $('#frmSearch select[name="search[popular]"]').val()
                        });
                    }
                },
                columnDefs: [
                    {
                        // For Responsive
                        className: 'control',
                        searchable: false,
                        orderable: false,
                        responsivePriority: 2,
                        targets: 0,
                        render: function (data, type, full, meta) {
                            return '';
                        }
                    },
                    {
                        targets: 1,
                        responsivePriority: 4,
                        render: function (data, type, full, meta) {
                            let $output;
                            let $name = full['name'],
                                $editPages = full['edit_pages'],
                                $image = full['image_uri'];

                            if ($image) {
                                $output = '{{ html()->img('', 'Image')->class('rounded-circle') }}'
                            } else {
                                const stateNum = Math.floor(Math.random() * 6);
                                const states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                                const $state = states[stateNum];
                                $name = full['name'];
                                let $initials = $name.match(/\b\w/g) || [];
                                $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                                $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
                            }
                            // Creates full output for row
                            return '<div class="d-flex justify-content-start align-items-center user-name">' +
                                '<div class="avatar-wrapper">' +
                                '<div class="avatar avatar-sm me-3">' +
                                $output +
                                '</div>' +
                                '</div>' +
                                '<div class="d-flex flex-column">' +
                                '<a href="' +
                                $editPages +
                                '" class="text-body text-truncate"><span class="fw-semibold">' +
                                $name +
                                '</span></a>' +
                                '</div>' +
                                '</div>';
                        }
                    },
                    {
                        targets: 3,
                        render: function (data, type, full) {
                            const $status_number = full['status'];
                            const $status = {
                                {{ config('constants.STATUS_ACTIVE') }}: {
                                    icon: '<i class="bx bx-check bx-xs"></i>',
                                    class: 'bg-label-primary'
                                },
                                {{ config('constants.STATUS_INACTIVE') }}: {
                                    icon: '<i class="bx bx-x bx-xs"></i>',
                                    class: ' bg-label-danger'
                                },
                            };
                            if (typeof $status[$status_number] === 'undefined') {
                                return data;
                            }
                            return (
                                '<span class="badge badge-center rounded-pill ' + $status[$status_number].class + ' w-px-30 h-px-30">' +
                                $status[$status_number].icon +
                                '</span>'
                            );
                        }
                    },
                    {
                        targets: 4,
                        render: function (data, type, full) {
                            const $featured_number = full['popular'];
                            const $featured = {
                                {{ config('constants.POPULAR_ACTIVE') }}: {
                                    icon: '<i class="bx bx-check bx-xs"></i>',
                                    class: 'bg-label-primary'
                                },
                                {{ config('constants.POPULAR_INACTIVE') }}: {
                                    icon: '<i class="bx bx-x bx-xs"></i>',
                                    class: ' bg-label-danger'
                                },
                            };
                            if (typeof $featured[$featured_number] === 'undefined') {
                                return data;
                            }
                            return (
                                '<span class="badge badge-center rounded-pill ' + $featured[$featured_number].class + ' w-px-30 h-px-30">' +
                                $featured[$featured_number].icon +
                                '</span>'
                            );
                        }
                    },
                    {
                        targets: -1,
                        title: 'Thao Tác',
                        render: function (data, type, full) {
                            const $editPages = full['edit_pages'];

                            return (
                                '<a href=' + $editPages + ' class="btn btn-sm btn-icon item-edit"><i class="bx bxs-edit"></i></a>'
                            );
                        }
                    }
                ],
                dom: 'r <"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                const data = row.data();
                                return 'Chi Tiết Thông Tin: ' + data['name'];
                            }
                        }),
                        type: 'column',
                        renderer: function (api, rowIdx, columns) {
                            const data = $.map(columns, function (col, i) {
                                return col.title !== ''
                                    ? '<tr data-dt-row="' +
                                    col.rowIndex +
                                    '" data-dt-column="' +
                                    col.columnIndex +
                                    '">' +
                                    '<td class="text-capitalize">' +
                                    col.title +
                                    ':' +
                                    '</td> ' +
                                    '<td>' +
                                    col.data +
                                    '</td>' +
                                    '</tr>'
                                    : '';
                            }).join('');

                            return data ? $('<table class="table"/><tbody />').append(data) : false;
                        }
                    }
                }
            });
        }

        $(document).ready(function () {
            $('#btnFrmSearch').on('click', function () {
                click_mode = 0;
                oTable.draw();
            });

            $('#btnFrmReset').on('click', function () {
                click_mode = 1;
                oTable.draw();
                $('.bootstrap-select').selectpicker('val', '');
            });
        })
    </script>
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
            <a href="{{ route('admin.category.index') }}" class="btn btn-label-danger text-capitalize mb-4">
                <span class="tf-icons bx bx-arrow-back"></span> {{ __('trans.action.back') }}
            </a>

            <a href="{{ route('admin.category.create') }}" class="btn btn-label-primary text-capitalize mb-4">
                <span class="tf-icons bx bx-plus"></span> {{ __('trans.action.create') }}
            </a>

            <a href="{{ route('admin.category.recycle') }}" class="btn btn-label-secondary text-capitalize mb-4">
                <span class="tf-icons bx bx-trash"></span> {{ __('trans.action.recycle') }}
            </a>
        </div>

        <div class="col-12">
            <div class="card mb-4">
                <h5 class="card-header text-capitalize">{{ __('trans.list') }}</h5>

                <div class="card-body">
                    {{ html()->form()->action(route('admin.category.getList'))->class('row g-3')->id('frmSearch')->attribute('onsubmit', 'return false')->open() }}
                    <div class="col-md-6">
                        {{ html()->label(__('trans.category.title'), 'search[name]')->class('form-label') }}
                        {{ html()->text('search[name]')->class('form-control') }}
                    </div>

                    <div class="col-md-6">
                        {{ html()->label(__('trans.category.parent_id'), 'search[parent_id]')->class('form-label') }}
                        {{ html()->select('search[parent_id]', $getCategoryList ?? [])->class('bootstrap-select text-capitalize w-100')->attributes(['data-style' => 'btn-default text-capitalize', 'data-size' => 8]) }}
                    </div>

                    <div class="col-md-6">
                        {{ html()->label(__('trans.status'), 'search[status]')->class('form-label') }}
                        {{ html()->select('search[status]', optionStatus() ?? [])->class('bootstrap-select text-capitalize w-100')->attributes(['data-style' => 'btn-default text-capitalize', 'data-size' => 8]) }}
                    </div>

                    <div class="col-md-6">
                        {{ html()->label(__('trans.popular'), 'search[popular]')->class('form-label') }}
                        {{ html()->select('search[popular]', optionPopular() ?? [])->class('bootstrap-select text-capitalize w-100')->attributes(['data-style' => 'btn-default text-capitalize', 'data-size' => 8]) }}
                    </div>

                    <div class="col-12 text-center">
                        {{ html()->button(__('trans.action.search'))->class('btn btn-sm btn-primary')->id('btnFrmSearch') }}
                        {{ html()->reset(__('trans.action.reset'))->class('btn btn-sm btn-warning')->id('btnFrmReset') }}
                    </div>
                    {{ html()->form()->close() }}

                    <div class="col-12">
                        <hr/>
                    </div>

                    <div class="col-12">
                        <table class="dt-responsive table table-bordered text-nowrap" id="category-table">
                            <thead>
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
@endsection
