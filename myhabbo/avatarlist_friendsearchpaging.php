<?php
global  $qryId;

if ($bypass == true) {
    $page = '1';
    $search = "";
} else {
    include '../global.php';
    $page = intval($_POST['pageNumber']);
    $search = filter($_POST['searchString']);
    $widgetid = intval($_POST['widgetId']);
}

if ($search == "") {

    $sql = db::query("SELECT owner_id FROM homes_items WHERE id = ? LIMIT 1", $widgetid);
    $row1 = $sql->fetch(2);
    $user = $row1['owner_id'];
    $offset = $page - 1;
    $offset *= 20;
    $sql = db::query("SELECT * FROM messenger_friendships WHERE user_one_id = ? OR user_two_id = ? LIMIT 20 OFFSET " . $offset, $qryId, $qryId);
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
                $friend = db::query("SELECT username,look,motto FROM users WHERE id = '" . $friendid . '\' LIMIT 1')->fetch(2);
                ?>
                <li id="avatar-list-<?php echo $widgetid; ?>-<?php echo $friendid; ?>"
                    title="<?php echo $friend['username']; ?>">
                    <div class="avatar-list-open"><a href="#"
                                                     id="avatar-list-open-link-<?php echo $widgetid; ?>-<?php echo $friendid; ?>"
                                                     class="avatar-list-open-link"></a></div>
                    <div class="avatar-list-avatar"><img
                            src="https://habbo.city/habbo-imaging/avatarimage?figure=<?php echo $friend['look']; ?>&size=s&direction=2&head_direction=2&gesture=sml"
                            alt=""/></div>
                    <h4>
                        <a href="<?php echo WWW; ?>/home/<?php echo $friend['username']; ?>"><?php echo $friend['username']; ?></a>
                    </h4>
                    <p class="avatar-list-birthday"><?php echo $friend['motto']; ?></p>
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
        $sql = db::query("SELECT * FROM messenger_friendships WHERE user_one_id = ? OR user_two_id = ?", $user, $user);
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

    $sql = db::query("SELECT owner_id FROM homes_items WHERE id = ? LIMIT 1", $widgetid);
    $row1 = $sql->fetch(2);
    $user = $row1['owner_id'];
    $offset = $page - 1;
    $offset *= 10;
    $sql = db::query("SELECT users.id,users.username,users.look,users.motto FROM users,messenger_friendships WHERE messenger_friendships.user_one_id = users.id AND (messenger_friendships.user_two_id = ? OR messenger_friendships.user_one_id = ?) AND users.username LIKE ? LIMIT 10 OFFSET " . $offset, $user, $user, '%' . $search . '%');

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
                            src="https://habbo.city/habbo-imaging/avatarimage?figure=<?php echo $friendrow['look']; ?>&size=s&direction=2&head_direction=2&gesture=sml"
                            alt=""/></div>
                    <h4>
                        <a href="<?php echo WWW; ?>/home/<?php echo $friendrow['username']; ?>"><?php echo $friendrow['username']; ?></a>
                    </h4>
                    <p class="avatar-list-birthday"><?php echo $friendrow['motto']; ?></p>
                    <p>

                    </p></li>

            <?php }
           ?>
        </ul>

        <div id="avatar-list-info" class="avatar-list-info">
            <div class="avatar-list-info-close-container"><a href="#" class="avatar-list-info-close"></a></div>
            <div class="avatar-list-info-container"></div>
        </div>

    </div>

    <div id="avatar-list-paging">
        <?php
        $count = $sql->rowCount();
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