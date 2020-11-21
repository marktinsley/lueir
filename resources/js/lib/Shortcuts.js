export class Shortcuts {
    static setupBindings() {
        ['e', 'x', 'q', 'w'].forEach(keyCombination => {
            Mousetrap.bind(keyCombination, () => Livewire.emit('shortcutPressed', keyCombination));
        });

        Mousetrap.bindGlobal('ctrl+s', function (e) {
            e.preventDefault();
            Livewire.emit('shortcutPressed', 'save');
        });
    }
}
