import Noty from 'noty';

export class Notification {
    static success(message) {
        Notification.showMessage(message, 'success');
    }

    static warning(message) {
        Notification.showMessage(message, 'warning');
    }

    static error(message) {
        Notification.showMessage(message, 'error');
    }

    static showMessage(message, type) {
        new Noty({
            text: message,
            type,
            theme: 'relax',
        }).show();
    }
}
