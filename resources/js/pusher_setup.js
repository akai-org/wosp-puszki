import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    wsHost: process.env.MIX_PUSHER_WS_HOST,
    wsPort: 6001,
    forceTLS: true,
    encrypted: false,
    enabledTransports: ['ws', 'wss'],
});