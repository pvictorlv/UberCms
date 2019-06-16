<body id="embedpage">
<div id="overlay"></div>

<div id="container">

    <div id="select-avatar">

        <div class="select-avatar-container clearfix">

            <div class="title">

                <span class="habblet-close"></span>

                <h1>Selecione seu habbo</h1>

            </div>

            <div id="content">

                <div id="user-info">

                    <img src="%www%/images/default.png"/>

                    <div>

                        <div id="name"><?php echo $_SESSION['jjp']['login']['name']; ?></div>

                        <a href="%www%/account/logout" id="logout">Sair</a>

                        <a href="%www%/identity/settings" id="manage-account">Gerenciar E-mail</a>

                    </div>


                </div>

                %errors%

                <?php

                $result = db::query("SELECT `id`,`username`,`last_online`,`look`,`password` FROM `users` WHERE `mail` = ?", $_SESSION['jjp']['login']['email']);

                $i = 0;
                while ($row = $result->fetch(1)) {
                    ?>
                    <div id="first-avatar">

                        <img src="https://habbo.city/habbo-imaging/avatarimage?figure=<?php echo $row[3]; ?>"
                             width="64" height="110"/>

                        <div id="first-avatar-info">

                            <div class="first-avatar-name"><?php echo $row[1]; ?></div>

                            <div class="first-avatar-lastonline">Último login:
                                <span><?php echo substr($datum = $row[2], 0, strpos($datum, ' ')); ?></span></div>

                            <?php if ($row[4] <> $_SESSION['UBER_USER_H'])
                                echo "<div id='first-avatar-play-link' style='color: darkred;'>Você não pode usar esse habbo.</a></div>";
                            else { ?>
                            <a id="first-avatar-play-link"
                               href="%www%/identity/useOrCreateAvatar/<?php echo $row[0]; ?>">

                                    <div class="play-button-container">

                                        <div class="play-button">
                                            <div class="play-text">Jogar</div>
                                        </div>

                                        <div class="play-button-end"></div>

                                    </div>

                                </a><?php } ?>

                        </div>

                    </div>

                    <?php
                    $i++;
                }

                $over = 20 - $i;
                if ($over <> 0)
                    echo '<div id="link-new-avatar"><a class="new-button" href="' . WWW . '/identity/add_avatar"><b>+ Adicionar</b><i></i></a></div>';

                echo '<p style="margin: 5px 10px">Você ainda pode criar ' . $over . ' Habbos.</p>';

                ?>

                <div class="other-avatars">

                </div>

            </div>

        </div>

        <div class="select-avatar-container-bottom"></div>

    </div>