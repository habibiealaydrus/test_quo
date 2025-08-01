var currentDate = new Date()
var day = currentDate.getDate()
var month = currentDate.getMonth() + 1
var year = currentDate.getFullYear()
var d = day + "-" + month + "-" + year;

$(function () {
    var dt_filter_table = $('.data-notification');

    if (dt_filter_table.length) {
        // Clone thead untuk filter per kolom
        $('.data-notification thead tr').clone(true).appendTo('.data-notification thead');
        $('.data-notification thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            var $input = $('<input type="text" class="form-control" placeholder="'+ title +'"/>');

            $(this).css('border-left', 'none');
            if (i === $('.data-notification thead tr:eq(1) th').length - 1) {
                $(this).css('border-right', 'none');
            }

            $(this).html($input);

            $('input', this).on('keyup change', function () {
                if (dt_filter.column(i).search() !== this.value) {
                    dt_filter.column(i).search(this.value).draw();
                }
            });
        });

        let borderColor, bodyBg, headingColor;
        if (isDarkStyle) {
          borderColor = config.colors_dark.borderColor;
          bodyBg = config.colors_dark.bodyBg;
          headingColor = config.colors_dark.headingColor;
        } else {
          borderColor = config.colors.borderColor;
          bodyBg = config.colors.bodyBg;
          headingColor = config.colors.headingColor;
        }

        var dt_filter = dt_filter_table.DataTable({
            dom: '<"d-flex justify-content-between align-items-center header-actions mx-2 row mt-75"' +
                '<"col-sm-12 col-lg-4 d-flex justify-content-center justify-content-lg-start" l>' +
                '<"col-sm-12 col-lg-8 ps-xl-75 ps-0"<"dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap"<"me-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: '_MENU_',
                search: '',
                searchPlaceholder: 'Search..'
            },
            order: [[5, 'desc']], // Urut berdasarkan created_at DESC
            orderCellsTop: true,
            columns: [
                {
                  data: null,
                  orderable: false,
                  searchable: false,
                  render: function (data, type, row, meta) {
                    const pageInfo = meta.settings.oInstance.api().page.info();
                    return pageInfo.recordsDisplay - (meta.row + meta.settings._iDisplayStart);
                  }
                  
                },
                { data: 'user_name' },
                { data: 'title' },
                { data: 'content' },
                { data: 'created_at' },
                {
                  data: null,
                  orderable: false,
                  searchable: false,
                  render: function () {
                    return '<button class="btn btn-sm btn-primary">View</button>';
                  }
                }
              ],              
            buttons: [{
                extend: 'collection',
                className: 'btn btn-label-secondary dropdown-toggle mx-3 waves-effect waves-light',
                text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="ti ti-printer me-2"></i>Print',
                        className: 'dropdown-item',
                        title: 'Data Notification On ' + d,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5] // Skip kolom No
                        },
                        customize: function (win) {
                            $(win.document.body)
                                .css('color', headingColor)
                                .css('border-color', borderColor)
                                .css('background-color', bodyBg);
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('color', 'inherit')
                                .css('border-color', 'inherit')
                                .css('background-color', 'inherit');
                        }
                    },
                    {
                        extend: 'csv',
                        text: '<i class="ti ti-file-text me-2" ></i>Csv',
                        className: 'dropdown-item',
                        title: 'Data Notification On ' + d,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excel',
                        text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                        className: 'dropdown-item',
                        title: 'Data Notification On ' + d,
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                        title: 'Data Notification On ' + d,
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'copy',
                        text: '<i class="ti ti-copy me-2"></i>Copy',
                        title: 'Data Notification On ' + d,
                        className: 'dropdown-item',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5]
                        }
                    }
                ]
            }]
        });
    }

    // Custom input filter
    $('input.dt-input').on('keyup', function () {
        filterColumn($(this).attr('data-column'), $(this).val());
    });

    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 200);
});
