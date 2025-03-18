import "./bootstrap";

import Echo from "laravel-echo";
import Pusher from "pusher-js";
import { Notyf } from "notyf";
import "notyf/notyf.min.css";

const notyf = new Notyf({
    duration: 4000, // Notification duration (ms)
    position: {
        x: "right",
        y: "bottom",
    },
    types: [
        {
            type: "success",
            background: "green",
            icon: {
                className: "fas fa-check",
                tagName: "i",
                color: "white",
            },
        },
        {
            type: "error",
            background: "red",
            icon: {
                className: "fas fa-times",
                tagName: "i",
                color: "white",
            },
        },
        {
            type: "info",
            background: "blue",
            icon: {
                className: "fas fa-info-circle",
                tagName: "i",
                color: "white",
            },
        },
    ],
});

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "af2554685d6572313fbd", // Ensure this is correct
    cluster: "ap1", // Match your Pusher cluster
    wsHost: "ws-ap1.pusher.com", // Correct WebSocket URL
    wsPort: 443,
    wssPort: 443,
    forceTLS: true,
    disableStats: true,
    enabledTransports: ["ws", "wss"], // Ensure WebSockets work
});

window.Echo.channel("notifications").listen(".new-notification", (event) => {
    console.log("🔔 New Notification Received:", event.notification);

    const notificationBox = document.getElementById("notification-list");
    const notificationBadge = document.getElementById("notification-badge");
    const noNotificationsMessage = document.getElementById(
        "no-notifications-message"
    );

    if (!notificationBox || !notificationBadge) return;

    // Remove "No new notifications" message if present
    if (noNotificationsMessage) {
        noNotificationsMessage.remove();
    }

    // Extract notification details
    const { id, message, notified_at, user_image, type } = event.notification;

    // Create the notification HTML
    const notificationHTML = `
            <div class="notification-item-container" data-id="${id}">
                <img src="/storage/${user_image}" alt="Error"/>
                <div class="notification-item">
                    <p>${message}</p>
                    <div class="notification-item-bottom">
                        <small>${new Date(notified_at).toLocaleString()}</small>
                        <button data-id="${id}" class="mark-as-read">Read</button>
                    </div>
                </div>
            </div>
        `;

    // Insert notification into UI
    notificationBox.insertAdjacentHTML("afterbegin", notificationHTML);

    // Update badge count
    let currentBadgeCount = parseInt(notificationBadge.textContent) || 0;
    notificationBadge.textContent = currentBadgeCount + 1;
    notificationBadge.style.display = "block"; // Ensure it's visible

    // Show Notyf notification based on type
    if (type === "success") {
        notyf.success(message);
    } else if (type === "error") {
        notyf.error(message);
    } else {
        notyf.open({
            type: "success",
            message: message,
        });
    }
});
