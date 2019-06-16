<style type="text/css">

    #playground, #playground-outer {
        width: 922px;
        height: 1360px;
    }

</style>
<div id="mypage-wrapper" class="cbb blue">
    <div class="box-tabs-container box-tabs-left clearfix">

        <?php
        global $users, $qryId;

        if (isset($_SESSION['UBER_USER_N']) && !isset($_SESSION['startSessionEditHome'])) {
            if (USER_ID == $qryId) {
                echo '	<a href="/home/%habboname%/startSession/' . USER_ID . '" id="edit-button" class="new-button dark-button edit-icon" style="float:left"><b><span></span>Editar</b><i></i></a>';
            }
        }
        ?>

        <div class="myhabbo-view-tools">
        </div>
        <h2 class="page-owner">%home_title%</h2>
        <ul class="box-tabs"></ul>
    </div>
    <div id="mypage-content">
        <?php
        if (isset($_SESSION['startSessionEditHome'])) {
            if ($qryId == $_SESSION['startSessionEditHome']) {
                echo '		<div id="top-toolbar" class="clearfix">
	<ul>
		<li><a href="#" id="inventory-button">Inventario</a></li>
	</ul>
	
	<form action="#" method="get" style="width: 50%">
		<a id="cancel-button" class="new-button red-button cancel-icon" href="#"><b><span></span>Cancelar edição</b><i></i></a>
		<a id="save-button" class="new-button green-button save-icon" href="#"><b><span></span>Salvar</b><i></i></a>
	</form>
</div>';
            }
        }
        ?>

        <div id="mypage-bg"
             class="<?php $data = db::query("SELECT bgimage FROM homes WHERE home_id = '" . $qryId . "' LIMIT 1")->fetch(2);
             echo $data['bgimage']; ?>">
            <div id="playground">
                <?php
                global $homeData;
                foreach ($homeData->GetItems() as $item) {
                    echo $item->GetHtml();
                }

                ?>
            </div>
            <div id="mypage-ad">
                <div class="habblet ">

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    Event.observe(window, "load", observeAnim);
    document.observe("dom:loaded", function () {
        initDraggableDialogs();
        repositionInvalidItems();
    });
</script>
</div>

<div class="cbb topdialog" id="guestbook-form-dialog">
    <h2 class="title dialog-handle">Editar uma mensagem do livro</h2>

    <a class="topdialog-exit" href="#" id="guestbook-form-dialog-exit">X</a>
    <div class="topdialog-body" id="guestbook-form-dialog-body">
        <div id="guestbook-form-tab">
            <form method="post" id="guestbook-form">
                <p>
                    Nota: A mensagem só pode ter até 500 caracteres
                    <input type="hidden" name="ownerId" value="%qryId%"/>
                </p>
                <div>
                    <textarea cols="15" rows="5" name="message" id="guestbook-message"></textarea>
                    <script type="text/javascript">
                        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("guestbook-message");
                        bbcodeToolbar.toolbar.toolbar.id = "bbcode_toolbar";
                        var colors = {
                            "red": ["#d80000", "Rojo"],
                            "orange": ["#fe6301", "Naranja"],
                            "yellow": ["#ffce00", "Amarillo"],
                            "green": ["#6cc800", "Verde"],
                            "cyan": ["#00c6c4", "Cyan"],
                            "blue": ["#0070d7", "Azul"],
                            "gray": ["#828282", "Gris"],
                            "black": ["#000000", "Negro"]
                        };
                        bbcodeToolbar.addColorSelect("Color", colors, true);
                    </script>
                    <div id="linktool">
                        <div id="linktool-scope">
                            <label for="linktool-query-input">Crear link:</label>
                            <input type="radio" name="scope" class="linktool-scope" value="1" checked="checked"/>Habbo
                            <input type="radio" name="scope" class="linktool-scope" value="2"/>Salas
                            <input type="radio" name="scope" class="linktool-scope" value="3"/>Grupos
                        </div>
                        <input id="linktool-query" type="text" name="query" value=""/>
                        <a href="#" class="new-button" id="linktool-find"><b>Buscar</b><i></i></a>
                        <div class="clear" style="height: 0;"><!-- --></div>
                        <div id="linktool-results" style="display: none">
                        </div>
                        <script type="text/javascript">
                            linkTool = new LinkTool(bbcodeToolbar.textarea);
                        </script>
                    </div>
                </div>

                <div class="guestbook-toolbar clearfix">
                    <a href="#" class="new-button" id="guestbook-form-cancel"><b>Cancelar</b><i></i></a>
                    <a href="#" class="new-button" id="guestbook-form-preview"><b>Previa</b><i></i></a>
                </div>
            </form>
        </div>
        <div id="guestbook-preview-tab">&nbsp;</div>
    </div>
</div>
<div class="cbb topdialog" id="guestbook-delete-dialog">
    <h2 class="title dialog-handle">Deletar mensagem</h2>

    <a class="topdialog-exit" href="#" id="guestbook-delete-dialog-exit">X</a>
    <div class="topdialog-body" id="guestbook-delete-dialog-body">
        <form method="post" id="guestbook-delete-form">
            <input type="hidden" name="entryId" id="guestbook-delete-id" value=""/>
            <p>Tem certeza que deseja deletar?</p>
            <p>
                <a href="#" id="guestbook-delete-cancel" class="new-button"><b>Cancelar</b><i></i></a>
                <a href="#" id="guestbook-delete" class="new-button"><b>Deletar</b><i></i></a>
            </p>
        </form>
    </div>
</div>


<div id="edit-menu" class="menu" style="top: 222px; left: -1500px; ">
    <div class="menu-header">
        <div class="menu-exit" id="edit-menu-exit"><img src="%www%/web-gallery/images/dialogs/menu-exit.gif" alt=""
                                                        width="11" height="11"></div>
        <h3>Editar</h3>
    </div>
    <div class="menu-body">
        <div class="menu-content">
            <form action="#" onsubmit="return false;">
                <div id="edit-menu-skins" style="display: block; ">
                    <select id="edit-menu-skins-select">
                        <option value="8" id="edit-menu-skins-select-hc_pillowskin">Almofada</option>
                        <option value="5" id="edit-menu-skins-select-notepadskin">Bloco de notas</option>
                        <option value="2" id="edit-menu-skins-select-speechbubbleskin">Caixa de dialogo</option>
                        <option value="6" id="edit-menu-skins-select-goldenskin">Dourado</option>
                        <option value="3" id="edit-menu-skins-select-metalskin">Metal</option>
                        <option value="7" id="edit-menu-skins-select-hc_machineskin">HC</option>
                        <option value="4" id="edit-menu-skins-select-noteitskin">Post-it</option>
                        <option value="1" id="edit-menu-skins-select-defaultskin">Padrão</option>
                    </select>
                </div>
                <div id="edit-menu-stickie" style="display: none; ">
                    <p>Atenção! Ao clicar em remover, sua nota será apagada para sempre!</p>
                </div>
                <div id="rating-edit-menu" style="display: none; ">
                    <input type="button" id="ratings-reset-link" value="Reiniciar los votos">
                </div>
                <div id="highscorelist-edit-menu" style="display:none">
                    <select id="highscorelist-game">
                        <option value="">Escolha o jogo</option>
                        <option value="1">Battle Ball: Rebound!</option>
                        <option value="2">SnowStorm</option>
                        <option value="0">Wobble Squabble</option>
                    </select>
                </div>
                <div id="edit-menu-remove-group-warning" style="display: none; ">
                    <p>Essa Etiqueta pertenece a outro usuario. Se remover, voltará a seu inventário</p>
                </div>
                <div id="edit-menu-gb-availability" style="display: none; ">
                    <select id="guestbook-privacy-options">
                        <option value="private">Apenas amigos</option>
                        <option value="public">Público</option>
                    </select>
                </div>
                <div id="edit-menu-trax-select" style="display: none; ">
                    <select id="trax-select-options"></select>
                </div>
                <div id="edit-menu-remove" style="display: block; ">
                    <input type="button" id="edit-menu-remove-button" value="Remover">
                </div>
            </form>
            <div class="clear"></div>
        </div>
    </div>
    <div class="menu-bottom"></div>
</div>

<?php
if (isset($_SESSION['startSessionEditHome'])) {
    ?>
    <script language="JavaScript" type="text/javascript">
        initEditToolbar();
        initMovableItems();
        document.observe("dom:loaded", initDraggableDialogs);
        Utils.setAllEmbededObjectsVisibility('hidden');
        Pinger.start();
    </script>
    <div id="edit-save" style="display:none;"></div>
    <script language="JavaScript" type="text/javascript">
        Event.observe(window, "resize", function () {
            if (editMenuOpen) closeEditMenu();
        }, false);
        Event.observe(document, "click", function () {
            if (editMenuOpen) closeEditMenu();
        }, false);
        Event.observe("edit-menu", "click", Event.stop, false);
        Event.observe("edit-menu-exit", "click", function () {
            closeEditMenu();
        }, false);
        Event.observe("edit-menu-remove-button", "click", handleEditRemove, false);
        Event.observe("edit-menu-skins-select", "click", Event.stop, false);
        Event.observe("edit-menu-skins-select", "change", handleEditSkinChange, false);
        Event.observe("guestbook-privacy-options", "click", Event.stop, false);
        Event.observe("guestbook-privacy-options", "change", handleGuestbookPrivacySettings, false);
        Event.observe("trax-select-options", "click", Event.stop, false);
        Event.observe("trax-select-options", "change", handleTraxplayerTrackChange, false);
    </script>
    <?php
}
?>
<script type="text/javascript">
    HabboView.run();
</script> 	
