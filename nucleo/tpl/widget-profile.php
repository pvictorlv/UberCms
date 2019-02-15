<?php
global $qryId;
$getUser = dbquery("SELECT id,username,online,account_created,look,motto FROM users WHERE id = '$qryId' LIMIT 1");
if ($getUser->num_rows <= 0) {
    return;
}
$userData = $getUser->fetch_assoc();
$status = 'offline';
if ($userData['online'] == "1") {
    $status = 'online';
}
?>
<div class="movable widget ProfileWidget" id="widget-%id%" style=" left: %pos-x%px; top: %pos-y%px; z-index: %pos-z%;">
    <div class="%skin%">
        <div class="widget-corner" id="widget-%id%-handle">
            <div class="widget-headline"><h3>
                    <?php
                    if (isset($_SESSION['startSessionEditHome'])) {
                        if ($_SESSION['startSessionEditHome'] == $user_id) {
                            echo '<img src="' . WWW . '/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="widget-%id%-edit">
<script type="text/javascript">
var editButtonCallback = function(e) { openEditMenu(e, %id%, "widget", "widget-%id%-edit"); };
Event.observe("widget-%id%-edit", "click", editButtonCallback);
Event.observe("widget-%id%-edit", "editButton:click", editButtonCallback); 
</script>';
                        } 
                    }
                    ?>
                    <span class="header-left">&nbsp;</span><span class="header-middle">Meu Perfil</span><span
                        class="header-right">&nbsp;</span></h3>
            </div>
        </div>
        <div class="widget-body">
            <div class="widget-content">
                <div class="profile-info">
                    <div class="name" style="float: left">
		<span class="name-text"><?php
            echo clean($userData['username']);
            ?></span>
                    </div>

                    <br class="clear"/>

                    <img alt="<?php
                    echo $status;
                    ?>" src="%www%/web-gallery/images/myhabbo/profile/habbo_<?php
                    echo $status;
                    ?>.gif"/>
                    <div class="birthday text">
                        Criado em:
                    </div>
                    <div class="birthday date">
                        <?php
                        echo clean($userData['account_created']);
                        ?>
                    </div>
                    <div>


                    </div>
                </div>
                <div class="profile-figure">
                    <img alt="<?php
                    echo clean($userData['username']);
                    ?>" src="http://avatar-retro.com/habbo-imaging/avatarimage.php?figure=<?php
                    echo clean($userData['look']);
                    ?>&direction=4"/>
                </div>
                <div class="profile-motto">
                    <?php
                    echo fixText($userData['motto'], true, false, true, false, false);
                    ?>
                    <img id="motto-<?php
                    echo $userData['id'];
                    ?>-report" class="report-button report-m" alt="report"
                         src="%www%/web-gallery/images/myhabbo/buttons/report_button.gif" style="display: none;">
                    <div class="clear"></div>
                </div>

                <br clear="all" style="display: block; height: 1px"/>

                <div id="profile-tags-panel">
                    <div id="profile-tag-list">
                        <div id="profile-tags-container">
                            <?php
                            $sql = dbquery("SELECT * FROM user_tags WHERE user_id = '" . $qryId . "'");
                            if ($sql->num_rows > 0) {
                                while ($data = $sql->fetch_assoc()) {
                                    ?>
                                    <span class="tag-search-rowholder">
                                    <a href="%www%/tag/<?php
                                    echo fixText($data['tag'], true, false, true, false, false);
                                    ?>" class="tag"><?php
                                        echo fixText($data['tag'], true, false, true, false, false);
                                        ?></a>
                                    <div class="tag-id" style="display:none"><?php
                                    echo $data['id'];
                                    ?></div><?php
                                    if (LOGGED_IN) {
                                        if (USER_ID == $data['user_id']) {
                                            ?><img border="0" class="tag-delete-link"
                                                   onmouseover="this.src='%www%/web-gallery/images/buttons/tags/tag_button_delete_hi.gif'"
                                                   onmouseout="this.src='%www%/web-gallery/images/buttons/tags/tag_button_delete.gif'"
                                                   src="%www%/web-gallery/images/buttons/tags/tag_button_delete.gif"/></span><?php
                                        } //USER_ID == $data['user_id']
                                    } //LOGGED_IN
                                    ?>
                                    <?php
                                    if (LOGGED_IN) {
                                        $query = dbquery("SELECT user_id FROM user_tags WHERE tag = '" . $data['tag'] . "' AND user_id = '" . USER_ID . "' AND user_id != '" . $data['user_id'] . "' LIMIT 1");
                                        if ($query->num_rows > 0) {
                                            ?>
                                            <img id="tag-img-added" border="0" class="tag-none-link"
                                                 src="%www%/web-gallery/images/buttons/tags/tag_button_added.gif"/></span>
                                            <?php
                                        } //mysql_num_rows($query) > 0
                                        elseif (dbquery("SELECT user_id FROM user_tags WHERE tag = '" . $data['tag'] . "' AND user_id != '" . USER_ID . "' AND user_id = '" . $data['user_id'] . "' LIMIT 1")->num_rows > 0) {
                                            ?>
                                            <img border="0" class="tag-add-link"
                                                 onmouseover="this.src='%www%/web-gallery/images/buttons/tags/tag_button_add_hi.gif'"
                                                 onmouseout="this.src='%www%/web-gallery/images/buttons/tags/tag_button_add.gif'"
                                                 src="%www%/web-gallery/images/buttons/tags/tag_button_add.gif"/></span>
                                            <?php
                                        } //mysql_num_rows(dbquery("SELECT user_id FROM user_tags WHERE tag = '" . $data['tag'] . "' AND user_id != '" . USER_ID . "' AND user_id = '" . $data['user_id'] . "' LIMIT 1")) > 0
                                    } //LOGGED_IN
                                    else {
                                        ?>
                                        <img border="0" class="tag-none-link"
                                             src="%www%/web-gallery/images/buttons/tags/tag_button_dim.gif"></span>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                } //$data = mysql_fetch_array($sql)
                            } //mysql_num_rows($sql) > 0
                            else {
                                echo 'Ainda não tem nenhuma etiqueta';
                            }
                            ?>
                            <img id="tag-img-added" border="0" class="tag-none-link"
                                 src="%www%/web-gallery/images/buttons/tags/tag_button_added.gif" style="display:none"/>
                        </div>

                        <script type="text/javascript">
                            document.observe("dom:loaded", function () {
                                TagHelper.setTexts({
                                    buttonText: "OK",
                                    tagLimitText: "Você alcançou o limite de etiquetas, remova algumas antes de continuar."
                                });
                            });
                        </script>
                    </div>
                    <div id="profile-tags-status-field">
                        <div style="display: block;">
                            <div class="content-red">
                                <div class="content-red-body">
                                    <span id="tag-limit-message"><img
                                            src="%www%/web-gallery/images/register/icon_error.gif"> Você alcançou o limite de etiquetas, remova algumas antes de continuar.</span>
                                    <span id="tag-invalid-message"><img
                                            src="%www%/web-gallery/images/register/icon_error.gif"> Etiqueta inválida</span>
                                </div>
                            </div>
                            <div class="content-red-bottom">
                                <div class="content-red-bottom-body"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (LOGGED_IN) {
                        if (USER_ID == $qryId) {
                            ?>
                            <div class="profile-add-tag">
                                <input type="text" id="profile-add-tag-input" maxlength="30"/><br clear="all"/>
                                <a href="#" class="new-button" style="float:left;margin:5px 0 0 0;"
                                   id="profile-add-tag"><b>Adicionar</b><i></i></a>
                            </div>
                            <?php
                        } //USER_ID == $user_id
                    } //LOGGED_IN
                    ?>
                </div>


                <script type="text/javascript">
                    document.observe("dom:loaded", function () {
                        new ProfileWidget('<?php
                            echo $userData['id'];
                            ?>', '<?php
                            echo USER_ID;
                            ?>', {
                            headerText: "Tem certeza?",
                            messageText: "Tem certeza de que quer que <strong\><?php
                                echo fixText($userData['username'], true, false, true, false, false);
                                ?></strong\> Seja seu amigo? Pense duas vezes antes de continuar!",
                            loginText: "Deve se registrar antes de enviar pedidos!",
                            buttonText: "OK",
                            cancelButtonText: "Cancelar"
                        });
                    });
                </script>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div> 