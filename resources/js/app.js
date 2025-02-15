import './bootstrap';

import Alpine from 'alpinejs';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

const echo = new Echo({
    broadcaster: 'pusher',
    key: '91d994226c8aaf7a5ea3',
    cluster: 'dacd0c8fe237cd5ceae0',
    encrypted: true
});

echo.channel('reminder-channel')
    .listen('ReminderEvent', (event) => {
        console.log(event);
    });

window.Alpine = Alpine;

Alpine.start();
