export class MenuDrawer {
    static show() {
        MenuDrawer.getElement().show();
    }

    static hide() {
        MenuDrawer.getElement().hide();
    }

    static toggle() {
        const element = MenuDrawer.getElement();
        if (element.open) {
            element.hide();
        } else {
            element.show();
        }
    }

    static getElement() {
        return document.getElementById('menu-drawer');
    }
}
