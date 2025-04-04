<header>
    <div class="right">

        <h2 class="custom-title">
            @yield('custom_title', 'Dashboard')
        </h2>
        {{-- <div id="icon" class="icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 800" xml:space="preserve">
                <path
                    d="M625.1 700.9H175.3c-41.4 0-74.9-33.6-74.9-74.9V175.8c0-41.4 33.6-74.9 74.9-74.9h449.9c41.4 0 74.9 33.5 74.9 74.9V626c-.1 41.4-33.6 74.9-75 74.9m-324.8-50v-500H187.7c-20.6 0-37.4 16.7-37.4 37.4v425.3c0 20.6 16.7 37.4 37.4 37.4h112.6z"
                    style="fill-rule:evenodd;clip-rule:evenodd" />
            </svg>
        </div> --}}
        {{-- <div style="display: none" class="search">
            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="m416 448-97-97q-42 32-95 32-43 0-80-21-37-22-58-59-22-37-22-80t22-80q21-37 58-58 37-22 80-22t80 22q37 21 59 58 21 37 21 80 0 54-33 96l97 97zM223 336q47 0 80-33 32-33 32-79 0-47-32-79-33-33-80-33-46 0-79 33-33 32-33 79 0 46 33 79t79 33" />
            </svg>
            <form action="{{ route('employees.index') }}" method="GET"
                style="display: flex; width: 100%;">
                <input type="text" name="search" id="search-box" class="search-input"
                    placeholder="Search Here" value="{{ request('search') }}"
                    onkeypress="return event.keyCode != 13 || this.form.submit();">
            </form>
        </div> --}}

    </div>
    <div class="left">


        <div id="add-event-popup" class="event-popup">
            <div class="popup">
                <button id="close-popup" class="close-btn">×</button>
                <h3 style="color:var(--primary-color)">Add New Event</h3>
                <form id="add-event-form">
                    <div
                        style="display: flex; flex-direction: column;  align-items: flex-start; justify-content: flex-start;width: 100%;">
                        <label for="title">Event Title:</label>
                        <input type="text" id="title" name="title" required>
                    </div>

                    <div style="display: flex; align-items: center; gap: 5px; width: 100%;">
                        <div
                            style="display: flex; flex-direction: column;  align-items: flex-start; justify-content: flex-start;width: 100%;">
                            <label for="start">Start Date:</label>
                            <input type="datetime-local" id="start" name="start" required>
                        </div>
                        <div
                            style="display: flex; flex-direction: column;  align-items: flex-start; justify-content: flex-start;width: 100%;">
                            <label for="end">End Date:</label>
                            <input type="datetime-local" id="end" name="end">
                        </div>
                    </div>
                    <button type="submit">Add Event</button>
                </form>

                <h3 style="margin-top: 10px; color:var(--primary-color);text-align: start">Upcoming Events</h3>
                <ul id="upcoming-events-list"></ul>
            </div>
        </div>

        <div id="edit-event-popup" class="event-popup">
            <div class="popup">
                <button id="close-edit-popup" class="close-btn">×</button>
                <h3>Edit Event</h3>
                <form id="edit-event-form">
                    <input type="hidden" id="edit-event-id">
                    <label for="edit-title">Event Title:</label>
                    <input type="text" id="edit-title" name="title" required>

                    <label for="edit-start">Start Date:</label>
                    <input type="datetime-local" id="edit-start" name="start" required>

                    <label for="edit-end">End Date:</label>
                    <input type="datetime-local" id="edit-end" name="end">

                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </div>


        <button id="theme-toggle" class="theme-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M22 12c0 5.523-4.477 10-10 10a10 10 0 0 1-3.321-.564A9 9 0 0 1 8 18a8.97 8.97 0 0 1 2.138-5.824A6.5 6.5 0 0 0 15.5 15a6.5 6.5 0 0 0 5.567-3.143c.24-.396.933-.32.933.143"
                    clip-rule="evenodd" opacity=".5" />
                <path
                    d="M2 12c0 4.359 2.789 8.066 6.679 9.435A9 9 0 0 1 8 18c0-2.221.805-4.254 2.138-5.824A6.47 6.47 0 0 1 9 8.5a6.5 6.5 0 0 1 3.143-5.567C12.54 2.693 12.463 2 12 2 6.477 2 2 6.477 2 12" />
            </svg>
        </button>

        <a href="{{ url('/settings') }}">
            <svg class="set-ico" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M14.279 2.152C13.909 2 13.439 2 12.5 2s-1.408 0-1.779.152a2 2 0 0 0-1.09 1.083c-.094.223-.13.484-.145.863a1.62 1.62 0 0 1-.796 1.353 1.64 1.64 0 0 1-1.579.008c-.338-.178-.583-.276-.825-.308a2.03 2.03 0 0 0-1.49.396c-.318.242-.553.646-1.022 1.453-.47.807-.704 1.21-.757 1.605-.07.526.074 1.058.4 1.479.148.192.357.353.68.555.477.297.783.803.783 1.361s-.306 1.064-.782 1.36c-.324.203-.533.364-.682.556a2 2 0 0 0-.399 1.479c.053.394.287.798.757 1.605s.704 1.21 1.022 1.453c.424.323.96.465 1.49.396.242-.032.487-.13.825-.308a1.64 1.64 0 0 1 1.58.008c.486.28.774.795.795 1.353.015.38.051.64.145.863.204.49.596.88 1.09 1.083.37.152.84.152 1.779.152s1.409 0 1.779-.152a2 2 0 0 0 1.09-1.083c.094-.223.13-.483.145-.863.02-.558.309-1.074.796-1.353a1.64 1.64 0 0 1 1.579-.008c.338.178.583.276.825.308.53.07 1.066-.073 1.49-.396.318-.242.553-.646 1.022-1.453.47-.807.704-1.21.757-1.605a2 2 0 0 0-.4-1.479c-.148-.192-.357-.353-.68-.555-.477-.297-.783-.803-.783-1.361s.306-1.064.782-1.36c.324-.203.533-.364.682-.556a2 2 0 0 0 .399-1.479c-.053-.394-.287-.798-.757-1.605s-.704-1.21-1.022-1.453a2.03 2.03 0 0 0-1.49-.396c-.242.032-.487.13-.825.308a1.64 1.64 0 0 1-1.58-.008 1.62 1.62 0 0 1-.795-1.353c-.015-.38-.051-.64-.145-.863a2 2 0 0 0-1.09-1.083"
                    clip-rule="evenodd" opacity=".5" />
                <path d="M15.523 12c0 1.657-1.354 3-3.023 3s-3.023-1.343-3.023-3S10.83 9 12.5 9s3.023 1.343 3.023 3" />
            </svg>
        </a>

        <div class="notification-container">
            <svg class="notf" onclick="toggleNotifications()" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path
                    d="M18.75 9v.704c0 .845.24 1.671.692 2.374l1.108 1.723c1.011 1.574.239 3.713-1.52 4.21a25.8 25.8 0 0 1-14.06 0c-1.759-.497-2.531-2.636-1.52-4.21l1.108-1.723a4.4 4.4 0 0 0 .693-2.374V9c0-3.866 3.022-7 6.749-7s6.75 3.134 6.75 7"
                    opacity=".5" />
                <path
                    d="M12.75 6a.75.75 0 0 0-1.5 0v4a.75.75 0 0 0 1.5 0zM7.243 18.545a5.002 5.002 0 0 0 9.513 0c-3.145.59-6.367.59-9.513 0" />
            </svg>

            <span id="notification-badge" class="notification-badge" style="display:none;">0</span>

            <div id="notification-box" class="notification-box">
                <div class="notification-box-header">
                    <h3>Notifications</h3>
                    <h3>X</h3>
                </div>
                <div id="notification-list">
                    <p>Loading notifications...</p>
                    <p id="no-notifications-message">No new notifications.</p>
                </div>
            </div>
        </div>

        <div id="profile" class="profile">
            <img src="{{ asset('storage/' . (Auth::user()->image ?? 'default-avatar.png')) }}"
                alt="{{ Auth::user()->name }}" style="max-width: 45px">
        </div>

        <div class="profile-setting" id="profile-setting">
            <p>Welcome {{ explode(' ', Auth::user()->name)[0] }}!</p>
            <a class="edit-profile" href="{{ route('users.profile') }}">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.5 7.063C16.5 10.258 14.57 13 12 13c-2.572 0-4.5-2.742-4.5-5.938C7.5 3.868 9.16 2 12 2s4.5 1.867 4.5 5.063M4.102 20.142C4.487 20.6 6.145 22 12 22s7.512-1.4 7.898-1.857a.42.42 0 0 0 .09-.317C19.9 18.944 19.106 15 12 15s-7.9 3.944-7.989 4.826a.42.42 0 0 0 .091.317z" />
                </svg>
                Profile
            </a>

            <a href="{{ url('/chat') }}" class="inbox">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 26" xml:space="preserve">
                    <path
                        d="M28.738 25.208c-1.73-.311-3.77-1.471-4.743-3.621C27.635 19.396 30 15.923 30 12c0-6.627-6.716-12-15-12S0 5.373 0 12s6.716 12 15 12c1.111 0 2.191-.104 3.232-.287 2.86 1.975 6.252 2.609 10.41 2.139.248-.02.356-.148.356-.326a.32.32 0 0 0-.26-.318M9 14a2 2 0 1 1 0-4 2 2 0 0 1 0 4m6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4m6 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4" />
                    <g />
                </svg>
                Chat
            </a>

            <a class="lock-screen" href="{{ route('users.lock') }}">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17 9V7c0-2.8-2.2-5-5-5S7 4.2 7 7v2c-1.7 0-3 1.3-3 3v7c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3v-7c0-1.7-1.3-3-3-3M9 7c0-1.7 1.3-3 3-3s3 1.3 3 3v2H9z" />
                </svg>
                Lock Screen
            </a>

            <span class="line" style="max-width: 200px;  top: 72%;"></span>
            <a href="#" class="logout"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none">
                    <path fill="#ef5f5f" fill-rule="evenodd"
                        d="M6 2a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3zm10.293 5.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414-1.414L18.586 13H10a1 1 0 1 1 0-2h8.586l-2.293-2.293a1 1 0 0 1 0-1.414"
                        clip-rule="evenodd" />
                </svg>
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>
</header>
