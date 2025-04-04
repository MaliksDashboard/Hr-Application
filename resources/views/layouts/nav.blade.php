<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<section>

    @include('layouts.sections.sidebar')
    <div class="body">
        @include('layouts.sections.header')
    </div>

</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const burger = document.getElementById("burger-menu");
        const nav = document.getElementById("nav");

        burger.addEventListener("click", function() {
            nav.classList.toggle("show");
            burger.classList.toggle("active");
        });

        // Close menu when clicking outside
        document.addEventListener("click", function(event) {
            if (!nav.contains(event.target) && !burger.contains(event.target)) {
                nav.classList.remove("show");
                burger.classList.remove("active");
            }
        });
    });

    function toggleNav() {
        const nav = document.getElementById("nav");
        nav.classList.toggle("collapsed");
        localStorage.setItem("navState", nav.classList.contains("collapsed") ? "collapsed" : "expanded");
    }

    // Restore previous state
    document.addEventListener("DOMContentLoaded", () => {
        const nav = document.getElementById("nav");
        if (localStorage.getItem("navState") === "collapsed") {
            nav.classList.add("collapsed");
        }
    });


    function fetchNotifications() {

        fetch('/notifications')
            .then(response => response.json())
            .then(data => {

                const unreadNotifications = data.filter(n => !n.is_read);

                const notificationBox = document.getElementById("notification-list");
                const notificationBadge = document.getElementById("notification-badge");

                if (unreadNotifications.length === 0) {
                    notificationBox.innerHTML = "<p>No new notifications.</p>";
                    notificationBadge.style.display = "none";
                } else {
                    // Populate the notifications list
                    notificationBox.innerHTML = unreadNotifications.map(n => `
            <div class="notification-item-container" data-id="${n.id}">
                <img src="/storage/${n.user_image}" alt="Error"/>
                <div class="notification-item">
                    <p>${n.message}</p>
                    <div class="notification-item-bottom">
                        <small>${new Date(n.notified_at).toLocaleString()}</small>
                        <button data-id="${n.id}" class="mark-as-read">Read</button>
                    </div>
                </div>
            </div>
        `).join("");

                    notificationBadge.style.display = "block";
                    notificationBadge.textContent = unreadNotifications.length;
                }
            })
            .catch(error => console.error("Error fetching notifications:", error));
    }

    // Define notificationButton globally
    const notificationButton = document.getElementById("notification-button");

    function toggleNotifications() {
        const notificationBox = document.getElementById("notification-box");

        if (!notificationBox) {
            console.error("Notification box not found.");
            return;
        }

        // Open the notification box
        notificationBox.classList.toggle("show");

        // Stop the bell from ringing when the box is opened
        if (notificationBox.classList.contains("show") && notificationButton) {
            notificationButton.classList.remove('ring');
        }
    }

    // Close notification box if clicked outside of it
    document.addEventListener('click', function(event) {
        const notificationBox = document.getElementById('notification-box');
        const notificationButton = document.querySelector(
            '.notf'); // The SVG button that opens the notification box

        // If the click is outside the notification box and the notification button
        if (!notificationBox.contains(event.target) && !notificationButton.contains(event.target)) {
            notificationBox.classList.remove('show');
        }
    });

    //Light and dark mode:
    document.addEventListener("DOMContentLoaded", function() {
        const themeToggle = document.getElementById("theme-toggle");
        const body = document.body;

        // Check Local Storage for Theme
        if (localStorage.getItem("theme") === "dark") {
            body.classList.add("dark-mode");
        }

        themeToggle.addEventListener("click", function() {
            body.classList.toggle("dark-mode");

            // Save user preference
            if (body.classList.contains("dark-mode")) {
                localStorage.setItem("theme", "dark");
            } else {
                localStorage.setItem("theme", "light");
            }
        });
    });


    // Initialize Notyf instance for the popup notification
    const notyf = new Notyf({
        duration: 4000, // Notification duration (ms)
        position: {
            x: 'right',
            y: 'bottom'
        },
        types: [{
                type: 'success',
                background: 'green',
                icon: {
                    className: 'fas fa-check',
                    tagName: 'i',
                    color: 'white'
                }
            },
            {
                type: 'error',
                background: 'red',
                icon: {
                    className: 'fas fa-times',
                    tagName: 'i',
                    color: 'white'
                }
            },
            {
                type: 'info',
                background: 'blue',
                icon: {
                    className: 'fas fa-info-circle',
                    tagName: 'i',
                    color: 'white'
                }
            }
        ]
    });

    document.addEventListener('DOMContentLoaded', () => {
        const profile = document.getElementById('profile');
        const profileSetting = document.getElementById('profile-setting');

        profile.addEventListener('click', () => {
            profileSetting.style.display =
                profileSetting.style.display === 'flex' ? 'none' : 'flex';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!profile.contains(e.target) && !profileSetting.contains(e.target)) {
                profileSetting.style.display = 'none';
            }
        });
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('mark-as-read')) {
            const notificationId = event.target.getAttribute('data-id');
            const notificationItem = event.target.closest('.notification-item-container');
            const notificationBox = document.getElementById("notification-list");
            const notificationBadge = document.getElementById("notification-badge");

            console.log("📌 Marking notification as read:", notificationId);

            // Send AJAX request to mark notification as read
            fetch(`/notifications/${notificationId}/read`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        'is_read': true
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        notificationItem.classList.add('fade-out'); // Add fade-out animation
                        setTimeout(() => {
                            notificationItem.remove(); // Remove after animation

                            // Check if all notifications are read
                            if (notificationBox.children.length === 0) {
                                notificationBox.innerHTML =
                                    '<p id="no-notifications-message">No new notifications.</p>';
                            }
                        }, 500);

                        // Update badge count
                        let currentBadgeCount = parseInt(notificationBadge.textContent) || 0;
                        if (currentBadgeCount > 0) {
                            notificationBadge.textContent = currentBadgeCount - 1;
                        }

                        // Hide badge if no unread notifications left
                        if (parseInt(notificationBadge.textContent) === 0) {
                            notificationBadge.style.display = "none";
                        }
                    } else {
                        alert('❌ Failed to mark notification as read.');
                    }
                })
                .catch(error => console.error('❌ Error marking notification as read:', error));
        }
    });

    // Run fetchNotifications when the page loads
    document.addEventListener("DOMContentLoaded", fetchNotifications);
</script>
