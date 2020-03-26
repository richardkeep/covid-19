import 'alpinejs'
import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '1b082cdb1064df5a55c9',
});
