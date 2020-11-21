require('./bootstrap');

window.Lueir = {};
window.Lueir.Clipboard = require('./lib/Clipboard').Clipboard;
window.Lueir.MenuDrawer = require('./lib/MenuDrawer').MenuDrawer;
window.Lueir.Notification = require('./lib/Notification').Notification;

Livewire.on('notify', (type, message) => {
    window.Lueir.Notification.showMessage(message, type)
});
