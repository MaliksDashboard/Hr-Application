<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Maliks HR Application')</title>
    <!-- Style Css Link -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Grid JS Link -->
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>

    <!-- Choices JS Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Notfy JS Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf/notyf.min.css">
    <script src="https://cdn.jsdelivr.net/npm/notyf/notyf.min.js"></script>

    <!-- JQUERY JS Link -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Selectize JS Link -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>

    <!-- Quill JS Link -->
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script> --}}

    <!-- Sweet Alert JS Link -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flat Picker JS Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- XLSX JS Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>


</head>
<meta name="csrf-token" content="{{ csrf_token() }}">

<body>

    @include('layouts.nav')

    @yield('main')

    <script src="/js/script.js"></script>
</body>

</html>


<script>
    function checkUserRole() {
        fetch('/api/get-user-role', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
                credentials: 'include', // Include cookies if using session-based auth
            })
            .then(response => response.json())
            .then(data => {
                const userRole = data.role_name; // Expecting { role_name: 'Admin' }
                if (userRole === 'Admin') {
                    // Allow access or load admin content
                    console.log('User is Admin');
                } else {
                    // Redirect to dashboard
                    window.location.href = '/dashboard';
                }
            })
            .catch(error => {
                console.error('Error fetching user role:', error);
                // Handle error, e.g., redirect to login
                window.location.href = '/login';
            });
    }
</script>


<!-- Start of LiveAgent integration script: Chat button: Circle animated button 67 -->
<script type="text/javascript">
    (function(d, src, c) {
        var t = d.scripts[d.scripts.length - 1],
            s = d.createElement('script');
        s.id = 'la_x2s6df8d';
        s.defer = true;
        s.src = src;
        s.onload = s.onreadystatechange = function() {
            var rs = this.readyState;
            if (rs && (rs != 'complete') && (rs != 'loaded')) {
                return;
            }
            c(this);
        };
        t.parentElement.insertBefore(s, t.nextSibling);
    })(document,
        'https://shadi.ladesk.com/scripts/track.js',
        function(e) {
            LiveAgent.createButton('6wm6srv5', e);
        });
</script>
<!-- End of LiveAgent integration script -->
