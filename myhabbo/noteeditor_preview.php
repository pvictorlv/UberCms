<?php
require_once '../global.php';

if (!LOGGED_IN) {
    header('Location: ' . WWW . '/');
    die();
}

if (isset($_POST['maxlength']) && isset($_POST['skin']) && isset($_POST['noteText']) && isset($_POST['scope'])) {

    $skin = filter($_POST['skin']);
    $maxlenght = filter($_POST['maxlength']);
    $noteText = filter($_POST['noteText']);
    $scope = filter($_POST['scope']);

    switch ($_POST['skin']) {
        case 1:
            $skin = 'defaultskin';
            break;
        case 2:
            $skin = 'speechbubbleskin';
            break;
        case 3:
            $skin = 'metalskin';
            break;
        case 4:
            $skin = 'noteitskin';
            break;
        case 5:
            $skin = 'notepadskin';
            break;
        case 6:
            $skin = 'goldenskin';
            break;
        case 7:
            $skin = 'hc_machineskin';
            break;
        case 8:
            $skin = 'hc_pillowskin';
            break;
        default:
            $skin = '';
            break;
    }

    ?>
    <div id="webstore-notes-container">


        <div class="movable stickie n_skin_<?php echo $skin; ?>-c" style=" left: 0px; top: 0px; z-index: 1;"
             id="stickie--1">
            <div class="n_skin_<?php echo $skin; ?>">
                <div class="stickie-header">
                    <h3>
                        <img src="%www%/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18"
                             class="edit-button" id="stickie--1-edit"/>
                        <script type="text/javascript">
                            var editButtonCallback = function (e) {
                                openEditMenu(e, -1, "stickie", "stickie--1-edit");
                            };
                            Event.observe("stickie--1-edit", "click", editButtonCallback);
                            Event.observe("stickie--1-edit", "editButton:click", editButtonCallback);
                        </script>
                    </h3>
                    <div class="clear"></div>
                </div>
                <div class="stickie-body">
                    <div class="stickie-content">
                        <div
                            class="stickie-markup"><?php echo fixText($core->BBcode($noteText), false, false, true, false, true); ?></div>
                        <div class="stickie-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <p class="warning">Aviso! Você não poderá editar esse texto após colocar em sua página</p>

    <p>
        <a href="#" class="new-button" id="webstore-notes-edit"><b>Editar</b><i></i></a>
        <a href="#" class="new-button" id="webstore-notes-add"><b>Adicionar nota na página</b><i></i></a>
    </p>

    <div class="clear"></div>
    <?php
} else {
    echo 'error';
}
?>