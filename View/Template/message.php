<section class="background-1" id="messageri">
    <div class="background-2" id="messageri-users">
        <h2>Messageri</h2>
        <?php 
            foreach ($messagesUsers as $key => $values) {
                $otherUser = $values['user'];
                $timeLastMessage = $values['time'] ?? 'N/A';
                $lastMessage = $values['lmContent'] ?? 'N/A';
                ?>
                <div class="messageri-user <?= ($selected == $key) ? 'background-3': '' ?>"  user-id="<?= $otherUser->getId() ?>">
                    <img class="medium-profil-img" src="<?= $otherUser->getUsrImg() ?? 'Asset/img/user/user-default.jpg' ?>" alt="">
                    <div>
                        <div>
                            <span><?= $otherUser->getName() ?></span>
                            <span><?= $timeLastMessage ?></span>
                        </div>
                        <span class="color-gray last-message"><?= $lastMessage ?></span>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    <div id="messages">
        <?php 
            foreach ($messagesUsers as $key => $values) {
                $otherUser = $values['user'];
                $img = $otherUser->getUsrImg()?? "Asset/img/user/user-default.jpg"; 
                $messages = $values['messages'];
                ?>
                <div class="messages-user <?= ($selected == $key)? '': 'hidded'?>"  user-id="<?= $otherUser->getId() ?>">

                    <div class="user-i background-1">
                        <img class="medium-profil-img" src="<?= $otherUser->getUsrImg() ?? 'Asset/img/user/user-default.jpg' ?>" alt="">
                        <h3><?= $otherUser->getName() ?></h3>
                    </div>
                    <div class="messages-list">
                        <?php
                            foreach($messages as $message)
                            {
                                $mTime = $message->getPublication()->format('d.m H.i');
                                $out = ($user->getId() != $message->getWriterId());
                                ?>
                                <div class="message<?= ($out)? '-left': '-right' ?>">
                                    <?= ($out)? '<img class="little-profil-img" src="'. ($otherUser->getUsrImg() ?? 'Asset/img/user/user-default.jpg') . '" alt="">': '' ?>
                                    <p class="message-time color-gray"><?= $mTime ?></p>
                                    <p class="message-content"><?= $message->getContent() ?></p>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    <form class="message-form" action="index.php?page=addMessage&id=<?= $otherUser->getId() ?>" method="post">
                        <div class="input-container">
                            <input type="text" id="message" name="message">
                        </div>
                        <input class="button-green" type="submit" value="Envoyer">
                    </form>
                </div>
                <?php
                
            }
        ?>
    </div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const userItems = document.querySelectorAll('.messageri-user');
    const messageBlocks = document.querySelectorAll('#messages > div');

    userItems.forEach(item => {
        item.addEventListener('click', function () {
            const selectedUserId = this.getAttribute('user-id');

            // Changer le fond du bloc sélectionné
            userItems.forEach(el => el.classList.remove('background-3'));
            this.classList.add('background-3');

            // Afficher les messages correspondants
            messageBlocks.forEach(block => {
                if (block.getAttribute('user-id') === selectedUserId) {
                    block.classList.remove('hidded');
                } else {
                    block.classList.add('hidded');
                }
            });
        });
    });
});
</script>
