<script src="/web-gallery/static/js/minimail.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/tooltip.css"/>

<div class="habblet-container ">

    <div id="new-personal-info"
         style="background-image:url(%www%/web-gallery/v2/images/personal_info/hotel_views/htlview_br.png)">
        <div class="enter-hotel-btn">
            <div class="open enter-btn">
                <a href="%www%/client" target="uberClientWnd" onclick="HabboClient.openOrFocus(this); return false;">Entrar
                    no %site_name%!<i></i></a>
                <b></b>
            </div>
        </div>


        <div id="habbo-plate">
            <a href="%www%/identity/avatars">
                <?php
                if (strtolower(USER_MOTTO) == "crikey") {
                    $image = '/web-gallery/images/personal_info/sticker_croco.gif';
                    echo '<img alt="%habboName%"
                     src="/web-gallery/images/personal_info/sticker_croco.gif" style="margin-top: 55px"/>';
                } else {
                    echo '<img alt="%habboName%"
                     src="http://avatar-retro.com/habbo-imaging/avatarimage?figure=' . USER_LOOK . '&size=b&action=stand&direction=2&head_direction=2&gesture=sml&action=wav&size=m"/>';
                }

                ?>
            </a>
        </div>

        <div id="habbo-info">
            <div id="motto-container" class="clearfix">
                <strong>%habboName%:</strong>
                <div>
                    <?php

                    echo '<span title="%motto%">%motto%</span>';
                    echo '<p style="display: none"><input type="text" maxlength="40" name="motto" value="%motto%"/></p>';

                    ?>


                </div>
            </div>
            <div id="motto-links" style="display: none"><a href="#" id="motto-cancel">Cancelar</a></div>
        </div>

        <ul id="link-bar" class="clearfix">
            <li class="credits">
                <a href="%www%/credits">%creditsBalance%</a> Moedas
            </li>

            <li class="club">
            <span id="clubdaysleft" style="display:none">
                <a href="%www%/credits/uberclub">0</a>
                HC
            </span>
                <span id="&uacute;nete al club">
                %clubStatus%
            </span>
            </li>
            <li class="activitypoints">
                <a href="%www%/credits/pixels">%pixelsBalance%</a> P&iacute;xels
            </li>
        </ul>

        <div id="habbo-feed">
            <ul id="feed-items">
                <?php
                $sql = dbquery("SELECT accept_trading FROM users WHERE id='" . USER_ID . "' ")->fetch_assoc()['accept_trading'];
                if ($sql == "1") {
                    echo
                    '<li class="small" id="feed-trading-enabled">Suas trocas estão ativas. <a href="%www%/profile">Clique aqui para mudar.</a></li>';
                } else {
                    echo
                    '<li class="small" id="feed-trading-disabled">Suas trocas estão inativas. <a href="%www%/profile">Clique aqui para mudar.</a> </li>';
                }
                ?>

                <!--<li id="feed-item-campaign" class="contributed">
                    <a href="#" name="feedItemIndex" class="remove-feed-item" title="Remove notification">Remover
                        Alerta</a>
                    <div>
                    </div>
                </li>
-->
                <?php
                global $users;
                if ($users->GetFriendCount(USER_ID, true) > 0) { ?>
                    <li id="feed-friends">
                        <strong><?php echo $users->GetFriendCount(USER_ID, true); ?></strong> de seus amigos estão
                        onlines
                        <span>
<?php
$result = dbquery("SELECT `user_two_id` FROM `messenger_friendships` WHERE `user_one_id` = '" . USER_ID . "'");
$num = $result->num_rows;
if ($num == 0) {

} else {
    $friends = array("online" => array(), "offline" => array());
    while ($row = $result->fetch_array()) {
        if ($users->Is_Online($row[0])) {
            $friends['online'][] = $users->Id2Name($row[0]);
        } else {
            $friends['offline'][] = $users->Id2Name($row[0]);
        }
    }


    if ($friends['online']) {
        echo "";
        echo "<span>";

        $oddeven = "even";

        foreach ($friends['online'] as $friend) {
            if ($oddeven == "even") {
                $oddeven = "odd";
            } else if ($oddeven == "odd") {
                $oddeven = "even";
            }
            echo "<a href='%www%/home/" . $friend . "'>" . $friend . "</a> ";
        }

        echo "</span>";
    }


}

?>
</span></li>
                <?php }; ?>
                <?php
                $freq = $users->GetFriendRequests(USER_ID);

                if ($freq) {
                    ?>
                    <li id="feed-notification"> Tem <a href="%www%/client" target="uberClientWnd"
                                                       onClick="HabboClient.openOrFocus(this); return false;"><?php echo $freq;
                            ?> Pedidos de amigos</a> em espera
                    </li>
                    <?php
                }
                ?>

                <?php
                $l_online = $users->GetUserVar(USER_ID, 'last_online');
                if (strtotime($l_online) == 0)
                    $l_online = date('d/m/Y h:m', time());
                ?>
                <li class="small" id="feed-lastlogin">
                    Última
                    conexão: <?php echo $l_online ?></li>


            </ul>
        </div>

        <p class="last"></p>
    </div>

    <script type="text/javascript">
        HabboView.add(function () {
            L10N.put("personal_info.motto_editor.spamming", "Sem spam!");
            PersonalInfo.init("");
        });
    </script>


</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
        Rounder.init();
    }</script>
