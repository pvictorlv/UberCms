<?php

if ($bypass == true) {
    $page = '1';
    $search = "";
} else {
    include '../global.php';
    $page = filter($_POST['pageNumber']);
    $search = filter($_POST['searchString']);
    $widgetid = filter($_POST['widgetId']);
}

if ($search == "") {

    $sql = db::query("SELECT userid FROM cms_homes_stickers WHERE id = '" . $widgetid . '\' LIMIT 1');
    $row1 = $sql->fetch(2);
    $user = $row1['userid'];
    $offset = $page - 1;
    $offset *= 20;
    $sql = db::query("SELECT * FROM messenger_friendships WHERE user_one_id = '" . $user . '\' OR user_two_id = \'' . $user . '\' LIMIT 20 OFFSET ' . $offset);
    ?>
    <div class="avatar-widget-list-container">
        <ul id="avatar-list-list" class="avatar-widget-list">
            <?php
            while ($friendrow = $sql->fetch(2)) {
                if ($friendrow['user_one_id'] == $user) {
                    $friendid = $friendrow['user_two_id'];
                } else {
                    $friendid = $friendrow['user_one_id'];
                }
                $friend = db::query("SELECT username,look,account_created FROM users WHERE id = '" . $friendid . '\' LIMIT 1')->fetch(2);
                ?>
                <li id="avatar-list-<?php echo $widgetid; ?>-<?php echo $friendid; ?>"
                    title="<?php echo $friend['username']; ?>">
                    <div class="avatar-list-open"><a href="#"
                                                     id="avatar-list-open-link-<?php echo $widgetid; ?>-<?php echo $friendid; ?>"
                                                     class="avatar-list-open-link"></a></div>
                    <div class="avatar-list-avatar"><img
                            src="http://avatar-retro.com/habbo-imaging/avatarimage?figure=<?php echo $friend['look']; ?>&size=s&direction=2&head_direction=2&gesture=sml"
                            alt=""/></div>
                    <h4>
                        <a href="<?php echo PATH; ?>/home/<?php echo $friend['username']; ?>"><?php echo $friend['username']; ?></a>
                    </h4>
                    <p class="avatar-list-birthday"><?php echo $friend['account_created']; ?></p>
                    <p>

                    </p></li>
            <?php } ?>
        </ul>

        <div id="avatar-list-info" class="avatar-list-info">
            <div class="avatar-list-info-close-container"><a href="#" class="avatar-list-info-close"></a></div>
            <div class="avatar-list-info-container"></div>
        </div>

    </div>

    <div id="avatar-list-paging">
        <?php
        $sql = db::query("SELECT * FROM messenger_friendships WHERE user_one_id = '" . $user . '\' OR user_two_id = \'' . $user . '\'');
        $count = $sql->rowCount();
        $at = $page - 1;
        $at *= 20;
        $at += 1;
        $to = $offset + 20;

        if ($to > $count) {
            $to = $count;
        }
        $totalpages = ceil($count / 20);
        ?>
        <?php echo $at; ?> - <?php echo $to; ?> / <?php echo $count; ?>
        <br/>
        <?php if ($page != 1) { ?>
            <a href="#" class="avatar-list-paging-link" id="avatarlist-search-first">Primero</a> |
            <a href="#" class="avatar-list-paging-link" id="avatarlist-search-previous">&lt;&lt;</a> |
        <?php } else { ?>
            Primeiros |
            &lt;&lt; |
        <?php } ?>
        <?php if ($page != $totalpages) { ?>
            <a href="#" class="avatar-list-paging-link" id="avatarlist-search-next">&gt;&gt;</a> |
            <a href="#" class="avatar-list-paging-link" id="avatarlist-search-last">Ultimo</a>
        <?php } else { ?>
            &gt;&gt; |
            Ultimo
        <?php } ?>
        <input type="hidden" id="pageNumber" value="<?php echo $page; ?>"/>
        <input type="hidden" id="totalPages" value="<?php echo $totalpages; ?>"/>
    </div>
<?php } else {

    $sql = db::query("SELECT userid FROM cms_homes_stickers WHERE id = '" . $widgetid . '\' LIMIT 1');
    $row1 = $sql->fetch(2);
    $user = $row1['userid'];
    $offset = $page - 1;
    $offset *= 10;
    $sql = db::query("SELECT users.id,users.username,users.look,users.account_created FROM users,messenger_friendships WHERE messenger_friendships.user_one_id = users.id AND messenger_friendships.user_two_id = '" . $user . '\' AND users.username LIKE \'%' . $search . "%' LIMIT 10 OFFSET " . $offset);
    $sql2 = db::query("SELECT users.id,users.username,users.look,users.account_created FROM users,messenger_friendships WHERE messenger_friendships.user_two_id = users.id AND messenger_friendships.user_one_id = '" . $user . '\' AND users.username LIKE \'%' . $search . "%' LIMIT 10 OFFSET " . $offset);
    ?>
    <div class="avatar-widget-list-container">
        <ul id="avatar-list-list" class="avatar-widget-list">
            <?php
            while ($friendrow = $sql->fetch(2)) {
                ?>
                <li id="avatar-list-<?php echo $widgetid; ?>-<?php echo $friendrow['id']; ?>"
                    title="<?php echo $friendrow['username']; ?>">
                    <div class="avatar-list-open"><a href="#"
                                                     id="avatar-list-open-link-<?php echo $widgetid; ?>-<?php echo $friendrow; ?>"
                                                     class="avatar-list-open-link"></a></div>
                    <div class="avatar-list-avatar"><img
                            src="http://www.habbo.com/habbo-imaging/avatarimage?figure=<?php echo $friendrow['look']; ?>&size=s&direction=2&head_direction=2&gesture=sml"
                            alt=""/></div>
                    <h4>
                        <a href="<?php echo PATH; ?>/home/<?php echo $friendrow['username']; ?>"><?php echo $friendrow['username']; ?></a>
                    </h4>
                    <p class="avatar-list-birthday"><?php echo $friendrow['account_created']; ?></p>
                    <p>

                    </p></li>

            <?php }
            while ($friendrow = $sql2->fetch(2)) { ?>
                <li id="avatar-list-<?php echo $widgetid; ?>-<?php echo $friendrow['id']; ?>"
                    title="<?php echo $friendrow['username']; ?>">
                    <div class="avatar-list-open"><a href="#"
                                                     id="avatar-list-open-link-<?php echo $widgetid; ?>-<?php echo $friendrow; ?>"
                                                     class="avatar-list-open-link"></a></div>
                    <div class="avatar-list-avatar"><img
                            src="http://avater-retro.com/habbo-imaging/avatarimage?figure=<?php echo $friendrow['look']; ?>&size=s&direction=2&head_direction=2&gesture=sml"
                            alt=""/></div>
                    <h4>
                        <a href="<?php echo PATH; ?>/home/<?php echo $friendrow['username']; ?>"><?php echo $friendrow['username']; ?></a>
                    </h4>
                    <p class="avatar-list-birthday"><?php echo $friendrow['account_created']; ?></p>
                    <p>

                    </p></li>

            <?php } ?>
        </ul>

        <div id="avatar-list-info" class="avatar-list-info">
            <div class="avatar-list-info-close-container"><a href="#" class="avatar-list-info-close"></a></div>
            <div class="avatar-list-info-container"></div>
        </div>

    </div>

    <div id="avatar-list-paging">
        <?php
        $count = $sql->rowCount() + $sql2->rowCount();
        $offset *= 2;
        $at = $page - 1;
        $at *= 20;
        ++$at;
        $to = $offset + 20;

        if ($to > $count) {
            $to = $count;
        }
        $totalpages = ceil($count / 20);
        ?>
        <?php echo $at; ?> - <?php echo $to; ?> / <?php echo $count; ?>
        <br/>
        <?php if ($page != 1) { ?>
            <a href="#" class="avatar-list-paging-link" id="avatarlist-search-first">Primeiro</a> |
            <a href="#" class="avatar-list-paging-link" id="avatarlist-search-previous">&lt;&lt;</a> |
        <?php } else { ?>
            Primeiro |
            &lt;&lt; |
        <?php } ?>
        <?php if ($page != $totalpages) { ?>
            <a href="#" class="avatar-list-paging-link" id="avatarlist-search-next">&gt;&gt;</a> |
            <a href="#" class="avatar-list-paging-link" id="avatarlist-search-last">Ultimo</a>
        <?php } else { ?>
            &gt;&gt; |
            Primeiro
        <?php } ?>
        <input type="hidden" id="pageNumber" value="<?php echo $page; ?>"/>
        <input type="hidden" id="totalPages" value="<?php echo $totalpages; ?>"/>
    </div>
<?php } ?>