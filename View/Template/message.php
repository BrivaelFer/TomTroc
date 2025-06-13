<section class="background-1" id="messageri">
    <div class="background-2" id="messageri-users">
        <h2>Messagerie</h2>
        <?php 
            foreach ($messagesUsers as $key => $values) {
                $otherUser = $values['user'];
                $timeLastMessage = $values['time'] ?? 'N/A';
                $lastMessage = $values['lmContent'] ?? 'N/A';
                ?>
                <div class="messageri-user <?= ($selected == $key) ? 'background-3-desk': '' ?>"  data-user-id="<?= $otherUser->getId() ?>">
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
    <div id="messages" class="hidden-mob">
        <div class="message-retour hidden-desk">
            <span class="link-block"><img class="arrow-left" src="Asset/img/fleche.png" alt="">retour</span>
        </div>
        <?php 
            foreach ($messagesUsers as $key => $values) {
                $otherUser = $values['user'];
                $img = $otherUser->getUsrImg()?? "Asset/img/user/user-default.jpg"; 
                $messages = $values['messages'];
                ?>
                <div class="messages-user <?= ($selected == $key)? '': 'hidded'?>"  data-user-id="<?= $otherUser->getId() ?>">

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
                                        <div class="message-date">
                                            <?= ($out)? '<img class="little-profil-img" src="'. ($otherUser->getUsrImg() ?? 'Asset/img/user/user-default.jpg') . '" alt="">': '' ?>
                                            <span class="message-time color-gray"><?= $mTime ?></span>
                                        </div>
                                    <p class="message-content"><?= $message->getContent() ?></p>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                    <form class="message-form" action="index.php?page=addMessage&id=<?= $otherUser->getId() ?>" method="post">
                        <div class="input-container">
                            <input title="envoie" type="text" name="message">
                        </div>
                        <input class="button-green" type="submit" value="Envoyer">
                    </form>
                </div>
                <?php
                
            }
        ?>
    </div>
</section>
