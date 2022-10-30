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
                    className: 'text-capitalize',
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
                        let $name = full['name'],
                            $editPages = full['edit_pages'],
                            $image = full['image_uri'];

                        return '<div class="d-flex justify-content-start align-items-center user-name">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar avatar-sm me-3">' +
                            '<img src="' + $image + '" class="rounded-circle" alt="Image"/>' +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<a href="' +
                            $editPages +
                            '" class="text-body text-truncate text-capitalize"><span class="fw-semibold">' +
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
                        const $editPages = full['edit_pages'],
                            $delete = full['delete'],
                            $id = full['id'];

                        return (
                            '<a href=' + $editPages + ' class="btn btn-sm btn-icon item-edit me-2"><i class="bx bxs-edit"></i></a>' +
                            '<a href="javascript:void(0)" class="btn btn-sm btn-icon item-edit" data-bs-toggle="modal" data-bs-target="#action-dialog" data-id=' + $id + ' data-action=' + $delete + '>' +
                            '<i class="bx bxs-trash"></i>' +
                            '</a>'
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
