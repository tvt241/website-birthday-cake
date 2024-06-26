import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
import { getItem } from './helpers/localStorageHelper';

window.Pusher = Pusher;
// Pusher.logToConsole = true; 

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
    wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
    wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    // authEndpoint: '/broadcasting/auth',
    auth: {
        headers: {
            Authorization: "Bearer " + getItem("token"),
            "X-Requested-With": "XMLHttpRequest"
        }
    }
});