@section('title', 'Login')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
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

        <div style="margin-bottom: 70px;" class="instruction">
            <h2>Sign In
            </h2>

            <p style="color: var(--here-only);  font-size: 14px;">Enter your email address and
                password to access
                admin panel.
            </p>
        </div>

        <form class="form-login" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>

        <div style="display: flex;align-items: center;gap: 10px;margin-top: 20px; justify-content: center;">
            <p style="color: #ff6c2f">Don't have an account?</p>
            <a style="color: var(--primary-color);font-weight: bold" href="https://wa.me/96176938653"
                target="_blank">Call Shadi !</a>
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
        <img src="images/bg.jpg" alt="">
    </div>
</body>

</html>


<style>
    @import url('https://fonts.googleapis.com/css2?family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Play:wght@400;700&display=swap');

    :root {
        --primary-color: #1C212D;
        --second-color: #657084;
        --third-color: #611abe;
        --light-color: #c7ced6de;
        --here-only: #5d7186;
        --text-light-color: #a2a5b9;
    }

    li {
        list-style: none;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        display: flex;
        overflow: hidden;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        color: var(--primary-color);
        justify-content: space-around;
        background-color: #f9f7f7;
        font-family: "Hanken Grotesk", serif;
    }


    a {
        text-decoration: none;
    }

    svg {
        width: 40px;
    }

    section {
        display: flex;
        width: 100%;
    }

    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10%;
        gap: 10px;
    }

    .form-login {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px
    }

    .input-group {
        display: flex;
        flex-direction: column;
        width: 100%;
        justify-content: center;
        align-items: start;
        gap: 10px;
    }

    .input-group label {
        color: var(--here-only);
        font-size: 14px;
    }

    .input-group input {
        border: 1px solid var(--light-color);
        height: 43px;
        border-radius: 10px;
        padding-inline: 10px;
        color: var(--here-only);
        font-size: 16px;
        width: 100%;
        max-width: 500px;
    }

    .input-group input:focus {
        outline: none;
    }

    .form-login button {
        width: 100%;
        background-color: rgba(255, 108, 47, 0.1);
        border: none;
        color: #ff6c2f;
        padding: 10px;
        border-radius: 10px;
        cursor: pointer;
        transition: .2s ease-in-out;
    }

    .form-login button:hover {
        background-color: rgba(255, 108, 47, 1);
        color: white;
    }

    .right {
        height: 90%;
    }

    .right img {
        width: 100%;
        max-width: 700px;
        border-radius: 10px;
        height: 100%;
        object-fit: cover;
    }
</style>
