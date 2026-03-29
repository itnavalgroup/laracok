<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- [Head] start -->

<head>
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
    <link rel="stylesheet" href="{{ asset('assets/css/style-preset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ppd-modern.css') }}">

    <!-- [Favicon] -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- [Plugin CSS] -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/dataTables.bootstrap5.min.css') }}">

    <!-- [Fonts & Icons] -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">

    @livewireStyles
</head>
<!-- [Head] end -->

<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
    <script>
        // Apply theme immediately to prevent flicker
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.body.setAttribute('data-pc-theme', 'dark');
        } else {
            document.body.setAttribute('data-pc-theme', 'light');
        }
    </script>

    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->

    @auth
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Header -->
    @include('layouts.header')
    @endauth

    <!-- [ Main Content ] start -->
    <div class="pc-container" @guest style="margin-left: 0; top: 0;" @endguest>
        <div class="pc-content">
            @auth
            @if (isset($header))
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            {{ $header }}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endauth

            {{ $slot }}
        </div>
    </div>
    <!-- [ Main Content ] end -->

    @auth
    <!-- Footer -->
    @include('layouts.footer')
    @endauth

    <!-- ================== [ JAVASCRIPT ] ================== -->

    <!-- jQuery harus paling awal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Core Plugins -->
    <script src="{{ asset('assets/js/plugins/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/fonts/custom-font.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.js') }}"></script>

    <!-- DataTables -->
    <script src="{{ asset('assets/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/dataTables.bootstrap5.min.js') }}"></script>

    <!-- ApexCharts -->
    <script src="{{ asset('assets/js/plugins/apexcharts.min.js') }}"></script>

    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <!-- Layout Scripts -->
    <script>
        $(document).ready(function() {
            const body = document.body;
            const toggleBtn = $('#dark-mode-toggle');

            function updateToggleIcons(theme) {
                if (theme === 'dark') {
                    toggleBtn.find('.dark-icon').addClass('d-none');
                    toggleBtn.find('.light-icon').removeClass('d-none');
                } else {
                    toggleBtn.find('.dark-icon').removeClass('d-none');
                    toggleBtn.find('.light-icon').addClass('d-none');
                }
            }

            // Initial call
            const currentTheme = body.getAttribute('data-pc-theme');
            updateToggleIcons(currentTheme);
            if (typeof layout_change === 'function') layout_change(currentTheme);

            toggleBtn.on('click', function(e) {
                e.preventDefault();
                const newTheme = body.getAttribute('data-pc-theme') === 'dark' ? 'light' : 'dark';

                body.setAttribute('data-pc-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                updateToggleIcons(newTheme);

                if (typeof layout_change === 'function') layout_change(newTheme);
            });
        });

        if (typeof change_box_container === 'function') change_box_container('false');
        if (typeof layout_rtl_change === 'function') layout_rtl_change('false');
        if (typeof preset_change === 'function') preset_change("preset-1");
        if (typeof font_change === 'function') font_change("Public-Sans");
    </script>

    <x-alert-modal />
    <x-confirm-modal />

    <!-- html2canvas & jsPDF for PDF-Canvas capture -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    @livewireScripts
    @stack('scripts')
</body>
<!-- [Body] end -->

</html>