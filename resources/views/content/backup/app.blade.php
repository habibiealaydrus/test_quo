<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style layout-wide customizer-hide" dir="ltr"
    data-theme="theme-default" data-assets-path="/../assets/" data-template="horizontal-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name', 'Integration Quotation Application') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Integration Quotation Application" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/front-pages/icons/shuttle-rocket.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/toastr/toastr.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/quill/editor.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/flatpickr/flatpickr.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/@form-validation/form-validation.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/spinkit/spinkit.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/quill/typography.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/quill/editor.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/leaflet/leaflet.css" />
    <!-- Helpers -->
    <script src="/assets/vendor/js/helpers.js"></script>
    <script src="/assets/vendor/js/template-customizer.js"></script>
    <script src="/assets/js/config.js"></script>

</head>

<body>
    <!-- Content -->
    @guest
    @yield('content')
    @else
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
        <div class="layout-container">
            @isset($exlude)
            @if (!in_array('sidebar', $exlude))
            @include('layouts.sidebar')
            @endif
            <div class="layout-page">
                <div class="content-wrapper">
                    @if (!in_array('navbar', $exlude))
                    @include('layouts.navbar')
                    @endif
                    @else
                    @include('layouts.navbar')
                    <div class="layout-page">
                        <div class="content-wrapper">
                            @include('layouts.sidebar')

                            @endisset
                            <div class="container-xxl flex-grow-1 container-p-y">
                                @yield('content')
                            </div>
                            <!-- FOOTER -->
                            <div class="content-backdrop fade"></div>
                        </div>
                    </div>
                    @endguest
                </div>
            </div>
            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>
            <div class="modal modal-transparent fade" id="ModalPreloader" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div style="padding: 70px 0; text-align: center;">
                                <img src="{{ asset('assets/img/plane.gif') }}" alt="Preloader" width="200px">
                                <h4 class="text-white">Please wait...</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.script')
            <script>
                function showPreloader() {
                    $('#ModalPreloader').modal('show')
                }

                function hidePreloader() {
                    $('#ModalPreloader').modal('hide')
                    setTimeout(() => {
                        $('#ModalPreloader').modal('hide')
                    }, 10000);
                }
                $(document).ready(function () {
                    getNotification();
                })

                function getNotification() {
                    var id = '{{ Auth::user()->compId ?? '
                    ' }}';
                    var el = $('.notificationElement');
                    el.html(
                        '<span class="list-group-item list-group-item-action text-center">😇 Empty Notification</span>'
                    );
                    $.ajax({
                        url: '{{ url("/notifications?id=") }}' + id,
                        type: 'GET',
                        success: function (res) {
                            if (res.notification.length > 0) {
                                el.html('');
                                $('.countNotification').html(res.notification.length);
                                $.each(res.notification, function (key, val) {
                                    var row = $('<a href="' + val.follup_url +
                                        '" class="list-group-item list-group-item-action dropdown-notifications-item">'
                                    );
                                    row.html(`
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                           <span class="avatar-initial rounded-circle bg-label-success">
                                                           <i class="ti ti-bell"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">` + val.title + `</h6>
                                                        <p class="mb-0">` + val.content + `</p>
                                                        <small class="text-muted">` + val.created_format + `</small>
                                                    </div>
                                                </div>
                                            `);
                                    el.append(row);
                                })
                            }
                        }
                    });
                }

            </script>
</body>

</html>
