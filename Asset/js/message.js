document.addEventListener("DOMContentLoaded", function () {
    const usersMenu = document.getElementById('messageri-users');
    const messagesInterface = document.getElementById('messages');
    const userItems = document.querySelectorAll('.messageri-user');
    const messageBlocks = document.querySelectorAll('#messages > .messages-user');
    const messageRetour = document.querySelectorAll('.message-retour');

    userItems.forEach(item => {
        item.addEventListener('click', function () {
            const selectedUserId = this.getAttribute('user-id');

            // Changer le fond du bloc sélectionné
            userItems.forEach(el => el.classList.remove('background-3-desk'));
            this.classList.add('background-3-desk');

            // Afficher les messages correspondants
            messageBlocks.forEach(block => {
                if (block.getAttribute('user-id') === selectedUserId) {
                    block.classList.remove('hidded');
                } else {
                    block.classList.add('hidded');
                }
            });
            messagesInterface.classList.remove('hidden-mob');
            usersMenu.classList.add('hidden-mob')
        });
    });
    messageRetour.forEach(item => {
        item.addEventListener('click', function () {
            messagesInterface.classList.add('hidden-mob');
            usersMenu.classList.remove('hidden-mob')
            document.querySelectorAll('.messages-list').forEach(list => {
                list.scrollTop = list.scrollHeight;
            });
        });
    });
});