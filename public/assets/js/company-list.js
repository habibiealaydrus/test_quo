'use strict';
var currentDate = new Date()
var day = currentDate.getDate()
var month = currentDate.getMonth() + 1
var year = currentDate.getFullYear()

var d = day + "-" + month + "-" + year;

$(function () {
    const addNewCompanyForm = document.getElementById('addNewCompanyForm');
    // Add New Company Form Validation
    const fv = FormValidation.formValidation(addNewCompanyForm, {
        fields: {
            code: {
                validators: {
                    notEmpty: {
                        message: 'Please enter code of company'
                    }
                }
            },
            name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter name of company'
                    }
                }
            },
            area: {
                validators: {
                    notEmpty: {
                        message: 'Please enter area of company'
                    }
                }
            },
            codeArea: {
                validators: {
                    notEmpty: {
                        message: 'Please enter code area'
                    }
                }
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                // Use this for enabling/changing valid/invalid class
                eleValidClass: '',
                rowSelector: function (field, ele) {
                    // field is the field name & ele is the field element
                    return '.mb-3';
                }
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            // Submit the form when all fields are valid
            defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
            autoFocus: new FormValidation.plugins.AutoFocus()
        }
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

    var dt_filter_table = $('.data-company');

    if (dt_filter_table.length) {
        // Setup - add a text input to each footer cell
        $('.data-company thead tr').clone(true).appendTo('.data-company thead');
        $('.data-company thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            var $input = $('<input type="text" class="form-control" placeholder="'+ title +'"/>');

            // Add left and right border styles to the parent element
            $(this).css('border-left', 'none');
            if (i === $('.data-company thead tr:eq(1) th').length - 1) {
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
            orderCellsTop: true,
            buttons: [{
                    extend: 'collection',
                    className: 'btn btn-label-secondary dropdown-toggle mx-3 waves-effect waves-light',
                    text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
                    buttons: [{
                            extend: 'print',
                            text: '<i class="ti ti-printer me-2" ></i>Print',
                            className: 'dropdown-item',
                            title: 'Data Company On ' + d,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4],
                            },
                            customize: function (win) {
                                //customize print view for dark
                                $(win.document.body)
                                    .css('color', headingColor)
                                    .css('border-color', borderColor)
                                    .css('background-color', bodyBg);
                                $(win.document.body)
                                    .find('table')
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
                            title: 'Data Company On ' + d,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4],
                            }
                        },
                        {
                            extend: 'excel',
                            text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
                            className: 'dropdown-item',
                            title: 'Data Company On ' + d,
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4],
                            }
                        },
                        {
                            extend: 'pdf',
                            text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
                            title: 'Data Company On ' + d,
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4],
                            }
                        },
                        {
                            extend: 'copy',
                            text: '<i class="ti ti-copy me-2" ></i>Copy',
                            title: 'Data Company On ' + d,
                            className: 'dropdown-item',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4],
                            }
                        }
                    ]
                },
                {
                    text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add New Company</span>',
                    className: 'add-new btn btn-primary waves-effect waves-light',
                    attr: {
                        'data-bs-toggle': 'offcanvas',
                        'data-bs-target': '#offcanvasAddCompany'
                    }
                }
            ],
        });
    }


    // on key up from input field
    $('input.dt-input').on('keyup', function () {
        filterColumn($(this).attr('data-column'), $(this).val());
    });

    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 200);


      // Delete Record
  $('.data-company tbody').on('click', '.delete-record', function () {
    let id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert company!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, Delete Company!',
        customClass: {
            confirmButton: 'btn btn-danger me-2 waves-effect waves-light',
            cancelButton: 'btn btn-secondary waves-effect waves-light'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            //fetch to delete data
            $.ajax({
                url: 'company/delete?companyId=' + id,
                type: "get",
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Company has been deleted.',
                        customClass: {
                            confirmButton: 'btn btn-success waves-effect waves-light'
                        }
                    });
                    //remove post on table
                    $(`#index_${id}`).remove();
                }
            });


        }
    })
  });
});
