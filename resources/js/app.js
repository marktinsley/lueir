require('./bootstrap');

window.Lueir = {};
window.Lueir.Clipboard = require('./lib/Clipboard').Clipboard;
window.Lueir.MenuDrawer = require('./lib/MenuDrawer').MenuDrawer;
window.Lueir.Notification = require('./lib/Notification').Notification;
window.Lueir.Shortcuts = require('./lib/Shortcuts').Shortcuts;

window.Lueir.Shortcuts.setupBindings();

Livewire.on('notify', (type, message) => {
    window.Lueir.Notification.showMessage(message, type)
});

Livewire.on('shortcutPressed', shortcut => shortcut === 's' && window.Lueir.MenuDrawer.toggle());
