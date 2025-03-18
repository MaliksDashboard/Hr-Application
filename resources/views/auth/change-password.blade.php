@section('title', 'Change Password')
<link rel="stylesheet" href="/css/style.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body class="login">
    <div class="log-in-container">
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
                <h2>Change Password</h2>
                <p>For security reasons, please set a new password before accessing your account.</p>
            </div>

            <form class="form-login" method="POST" action="{{ route('password.change') }}">
                @csrf
                <div class="input-group">
                    <label for="password">New Password:</label>
                    <input type="password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" required>
                </div>
                <button type="submit">Change Password</button>
            </form>

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


    </div>
</body>

</html>
