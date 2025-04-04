<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Maliks HR Application')</title>

    <link rel="preload" href="/css/style.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="/css/style.css">
    </noscript>

    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.min.css" />


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


</head>

<body>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notyf = new Notyf({
                    duration: 4000, // Notification duration (ms)
                    position: {
                        x: 'right',
                        y: 'top'
                    }, // Position of notifications
                });

                notyf.success('{{ session('success') }}'); // Display success message
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const notyf = new Notyf({
                    duration: 4000,
                    position: {
                        x: 'right',
                        y: 'top'
                    }
                });
                notyf.error('{{ session('error') }}');
            });
        </script>
    @endif

    @include('layouts.nav')

    @yield('main')

    @vite(['resources/js/app.js', 'resources/css/app.css'])

    <div id="loadingSpinner" class="loading-spinner" style="display: none;">
        <span class="loader"></span>
    </div>

    @stack('scripts')

    <script defer src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>


</body>

</html>


{{-- Tawk.io --}}
<script type="text/javascript">
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/67bf228be366d1190c78a7bd/1il19ts5u';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
</script>



<script>
    // Optionally update third-color dynamically if session values are changed without page reload
    document.addEventListener('DOMContentLoaded', function() {
        const thirdColor = "{{ session('third_color', '#ff5733') }}";
        const font = "{{ session('font', 'Play') }}";

        // Update the root CSS variable
        document.documentElement.style.setProperty('--third-color', thirdColor);

        // Update font-family
        document.body.style.fontFamily = font;
    });

    document.addEventListener('DOMContentLoaded', () => {
        const spinner = document.getElementById('loadingSpinner');

        // Show spinner on AJAX start
        document.addEventListener('ajaxStart', () => spinner.style.display = 'flex');

        // Hide spinner on AJAX end
        document.addEventListener('ajaxComplete', () => spinner.style.display = 'none');

        // Example usage with fetch:
        async function fetchWithSpinner(url, options) {
            spinner.style.display = 'flex';
            try {
                const response = await fetch(url, options);
                return response;
            } catch (err) {
                console.error(err);
            } finally {
                spinner.style.display = 'none';
            }
        }

        // Usage:
        fetchWithSpinner('/some-api-endpoint');
    });
</script>
