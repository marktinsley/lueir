import {Notification} from "./Notification";

export class Clipboard {
    static copy(text) {
        navigator.clipboard.writeText(text)
            .then(() => Notification.success('Copied!'))
            .catch(() => Notification.error('Failed copying to your clipboard'))
    }
}
