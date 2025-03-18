@section('title', 'Login')
<link rel="stylesheet" href="/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="login">
    <div class="log-in-container ">
        <div class="left-container">
            <div class="logo">
                <svg viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg">
                    <circle class="cls-1" cx="12" cy="4.34" r="2.86" />
                    <circle class="cls-1" cx="19.64" cy="16.75" r="2.86" />
                    <circle class="cls-1" cx="4.36" cy="16.75" r="2.86" />
                    <path class="cls-1"
                        d="M6 19.09a8.59 8.59 0 0 0 12 0M14.82 4.82a8.57 8.57 0 0 1 5.77 8.11 7 7 0 0 1-.08 1.1M3.49 14a7 7 0 0 1-.08-1.1 8.57 8.57 0 0 1 5.77-8.08" />
                </svg>
                <h1>Maliks HR System</h1>
            </div>

            <div class="instruction">
                <h2>Sign In
                </h2>

                <p>Enter your email address and
                    password to access
                    admin panel.
                </p>
            </div>

            <form class="form-login" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-group">
                    <label for="identifier">Email or Pin Code:</label>
                    <input type="text" id="identifier" name="identifier" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>


            <div class="login-help">
                <p>Don't have an account?</p>
                <a href="https://wa.me/96176938653" target="_blank">Call Shadi !</a>
            </div>
            @if ($errors->any())
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            html: `
                        <ul style="text-align: left;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    `,
                            confirmButtonText: 'OK'
                        });
                    });
                </script>
            @endif

        </div>

        <div class="right">
            <p>With Maliks, <br> Sky is <br> the Limit</p>
        </div>
    </div>
</body>

</html>
