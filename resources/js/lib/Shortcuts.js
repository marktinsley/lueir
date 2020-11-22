export class Shortcuts {
    static setupBindings() {
        [
            'e', // Switch to edit mode for the file we're currently editing.
            'f', // Create a new file in the current directory.
            'm', // Move a file or folder.
            'n', // Create a new folder in the current directory.
            'r', // Rename the current file or folder.
            's', // Open the side menu.
            'q', // Exit from edit mode.
            'x', // Exit from edit mode and save changes to the file.
            'w', // Save the file we're currently editing.
            'u', // Move up one directory
        ].forEach(keyCombination => {
            Mousetrap.bind(keyCombination, () => Livewire.emit('shortcutPressed', keyCombination));
        });

        Mousetrap.bindGlobal('ctrl+s', function (e) {
            // Save the file we're currently editing. Using bindGlobal so this will work in a text area as well.
            e.preventDefault();
            Livewire.emit('shortcutPressed', 'save');
        });
    }
}
