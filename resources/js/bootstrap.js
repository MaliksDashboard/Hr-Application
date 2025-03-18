import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'af2554685d6572313fbd',
    cluster: 'ap1',
    forceTLS: true
});

window.Echo.channel('notifications')
    .listen('new-notification', (e) => {
        console.log(e.data);
    });
