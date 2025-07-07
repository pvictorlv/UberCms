<link rel="shortcut icon" href="%www%/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon" />

<link rel="stylesheet" href="%www%/web-gallery/static/styles/common.css" type="text/css"/>
<script src="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/js/libs2.js" type="text/javascript"></script>
<script src="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/js/common.js" type="text/javascript"></script>
<script src="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/js/fullcontent.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/styles/home.css" type="text/css"/>
<link rel="stylesheet" href="http://images.xukys-hotel.com/cs/styles/assets/other.css?v=cd4283662f0b704a80227001a33203ac" type="text/css"/>
<link rel="stylesheet" href="http://images.xukys-hotel.com/cs/styles/assets/backgrounds.css?v=cd3c3a223dfc37500c560a00c068fd95" type="text/css"/>
<link rel="stylesheet" href="http://images.xukys-hotel.com/cs/styles/assets/stickers.css?v=5a9f5cbe379ca65e6417720f48df0510" type="text/css"/>
<script src="%www%/web-gallery/static/js/homeview.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/styles/lightwindow.css" type="text/css"/>
<script src="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/js/homeauth.js" type="text/javascript"></script>
<link rel="stylesheet" href="http://images.xukys-hotel.com/habboweb/63_1dc60c6d6ea6e089c6893ab4e0541ee0/730/web-gallery/static/styles/group.css" type="text/css"/>

<?php if(isset($_SESSION['group_edit']) && $_SESSION['group_edit'] == true && $is_member == true && $member_rank > 1)
{
	$edit_mode = true;
	$body_id = "editmode";
}
else
{
	$edit_mode = false;
	$body_id = "viewmode";
}
?>
<?php
$rango = db::query("SELECT * FROM users WHERE id = '".USER_ID."'");
$user_rank = $rango->fetch(2);
?>
<?php if($edit_mode){ ?>

<div id="edit-menu" class="menu">
	<div class="menu-header">
		<div class="menu-exit" id="edit-menu-exit"><img src="./web-gallery/images/dialogs/menu-exit.gif" alt="" width="11" height="11" /></div>
		<h3>Editar</h3>
	</div>
	<div class="menu-body">
		<div class="menu-content">
			<form action="#" onsubmit="return false;">
				<div id="edit-menu-skins">
	<select id="edit-menu-skins-select">
			<option value="1" id="edit-menu-skins-select-defaultskin">Por defecto</option>
			<option value="6" id="edit-menu-skins-select-goldenskin">Dorado</option>
			<option value="3" id="edit-menu-skins-select-metalskin">Metal</option>
			<option value="5" id="edit-menu-skins-select-notepadskin">Bloc de Notas</option>
			<option value="2" id="edit-menu-skins-select-speechbubbleskin">Bocadillo de Di�logo</option>
			<option value="4" id="edit-menu-skins-select-noteitskin">Nota-etiqueta</option>
<?php if(getHC(USER_ID)){ ?>
			<option value="8" id="edit-menu-skins-select-hc_pillowskin">HC Bling</option>
			<option value="7" id="edit-menu-skins-select-hc_machineskin">HC Scifi</option>
<?php } ?>
<?php if($user_rank['member_rank'] > 5){ ?>
			<option value="9" id="edit-menu-skins-select-nakedskin">Transparente</option>
<?php } ?>
	</select>
				</div>
				<div id="edit-menu-stickie">
					<p>�Atenci�n! Si pinchas en 'Quitar', tu nota ser� eliminada para siempre.</p>
				</div>
				<div id="rating-edit-menu">
					<input type="button" id="ratings-reset-link"
						value="Reset rating" />
				</div>
				<div id="highscorelist-edit-menu" style="display:none">
					<select id="highscorelist-game">
						<option value="">Select game</option>
						<option value="1">Battle Ball: Rebound!</option>
						<option value="2">SnowStorm</option>
						<option value="0">Wobble Squabble</option>
					</select>
				</div>
				<div id="edit-menu-remove-group-warning">
					<p>Este elemento se pondra en segundo plano.</p>
				</div>
				<div id="edit-menu-gb-availability">
					<select id="guestbook-privacy-options">
						<option value="private">S�lo amigos</option>
						<option value="public">Publico</option>
					</select>
				</div>
				<div id="edit-menu-trax-select">
					<select id="trax-select-options"></select>
				</div>
				<div id="edit-menu-remove">
					<input type="button" id="edit-menu-remove-button" value="Remove" />
				</div>
			</form>
			<div class="clear"></div>
		</div>
	</div>
	<div class="menu-bottom"></div>
</div>
<script language="JavaScript" type="text/javascript">
Event.observe(window, "resize", function() { if (editMenuOpen) closeEditMenu(); }, false);
Event.observe(document, "click", function() { if (editMenuOpen) closeEditMenu(); }, false);
Event.observe("edit-menu", "click", Event.stop, false);
Event.observe("edit-menu-exit", "click", function() { closeEditMenu(); }, false);
Event.observe("edit-menu-remove-button", "click", handleEditRemove, false);
Event.observe("edit-menu-skins-select", "click", Event.stop, false);
Event.observe("edit-menu-skins-select", "change", handleEditSkinChange, false);
Event.observe("guestbook-privacy-options", "click", Event.stop, false);
Event.observe("guestbook-privacy-options", "change", handleGuestbookPrivacySettings, false);
Event.observe("trax-select-options", "click", Event.stop, false);
Event.observe("trax-select-options", "change", handleTraxplayerTrackChange, false);
</script>
<?php } else { ?>
<div class="cbb topdialog" id="guestbook-form-dialog">
	<h2 class="title dialog-handle">Editar un mensaje en el Libro</h2>
	
	<a class="topdialog-exit" href="#" id="guestbook-form-dialog-exit">X</a>
	<div class="topdialog-body" id="guestbook-form-dialog-body">

<div id="guestbook-form-tab">
<form method="post" id="guestbook-form">
    <p>
        Nota: el mensaje no puede superar los 500 caracteres
        <input type="hidden" name="ownerId" value=""'.USER_ID.'"" />
	</p>
	<div>
	    <textarea cols="15" rows="5" name="message" id="guestbook-message"></textarea>
    <script type="text/javascript">
        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("guestbook-message");
        bbcodeToolbar.toolbar.toolbar.id = "bbcode_toolbar";
        var colors = { "red" : ["#d80000", "Rojo"],
            "orange" : ["#fe6301", "Naranja"],
            "yellow" : ["#ffce00", "Amarillo"],
            "green" : ["#6cc800", "Verde"],
            "cyan" : ["#00c6c4", "Cyan"],
            "blue" : ["#0070d7", "Azul"],
            "gray" : ["#828282", "Gris"],
            "black" : ["#000000", "Negro"]
        };
        bbcodeToolbar.addColorSelect("Color", colors, true);
    </script>

<div id="linktool">
    <div id="linktool-scope">
        <label for="linktool-query-input">Crear link:</label>
        <input type="radio" name="scope" class="linktool-scope" value="1" checked="checked"/>Habbos
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
	<h2 class="title dialog-handle">Eliminar mensaje</h2>
	
	<a class="topdialog-exit" href="#" id="guestbook-delete-dialog-exit">X</a>
	<div class="topdialog-body" id="guestbook-delete-dialog-body">
<form method="post" id="guestbook-delete-form">
	<input type="hidden" name="entryId" id="guestbook-delete-id" value="" />

	<p>�Seguro que lo quieres eliminar?</p>
	<p>
		<a href="#" id="guestbook-delete-cancel" class="new-button"><b>Cancelar</b><i></i></a>
		<a href="#" id="guestbook-delete" class="new-button"><b>Eliminar</b><i></i></a>
	</p>
</form>
	</div>
</div>	

<div id="group-tools" class="bottom-bubble">
	<div class="bottom-bubble-t"><div></div></div>
	<div class="bottom-bubble-c">
<h3>Editar Grupo</h3>

<ul>
	<li><a href="/groups/<?php echo $groupid; ?>/id/edit" id="group-tools-style">Modificar p�gina</a></li>
	<?php if($ownerid == "'USER_ID'"){ ?><li><a href="#" id="group-tools-settings">Ajustes</a></li><?php } ?>
	<li><a href="#" id="group-tools-badge">Placa</a></li>
	<li><a href="#" id="group-tools-members">Miembros</a></li>
</ul>

	</div>
	<div class="bottom-bubble-b"><div></div></div>
</div>

<div class="cbb topdialog black" id="dialog-group-settings">

	<div class="box-tabs-container">
<ul class="box-tabs">
	<li class="selected" id="group-settings-link-group"><a href="#">Grupo</a><span class="tab-spacer"></span></li>
	<li id="group-settings-link-forum"><a href="#">Foro de Discusi�n</a><span class="tab-spacer"></span></li>
	<li id="group-settings-link-room"><a href="#">Salas</a><span class="tab-spacer"></span></li>
</ul>
</div>

	<a class="topdialog-exit" href="#" id="dialog-group-settings-exit">X</a>
	<div class="topdialog-body" id="dialog-group-settings-body">
<p style="text-align:center"><img src="./web-gallery/images/progress_bubbles.gif" alt="" width="29" height="6" /></p>
	</div>
</div>

<script language="JavaScript" type="text/javascript">
Event.observe("dialog-group-settings-exit", "click", function(e) {
    Event.stop(e);
    closeGroupSettings();
}, false);
</script><div class="cbb topdialog black" id="group-memberlist">

	<div class="box-tabs-container">
<ul class="box-tabs">
	<li class="selected" id="group-memberlist-link-members"><a href="#">Miembros</a><span class="tab-spacer"></span></li>
	<li id="group-memberlist-link-pending"><a href="#">Miembros pendientes</a><span class="tab-spacer"></span></li>
</ul>
</div>

	<a class="topdialog-exit" href="#" id="group-memberlist-exit">X</a>
	<div class="topdialog-body" id="group-memberlist-body">
<div id="group-memberlist-members-search" class="clearfix" style="display:none">

    <a id="group-memberlist-members-search-button" href="#" class="new-button"><b>Buscar</b><i></i></a>
    <input type="text" id="group-memberlist-members-search-string"/>
</div>
<div id="group-memberlist-members" style="clear: both"></div>
<div id="group-memberlist-members-buttons" class="clearfix">
	<a href="#" class="new-button group-memberlist-button-disabled" id="group-memberlist-button-give-rights"><b>Dar Derechos</b><i></i></a>
	<a href="#" class="new-button group-memberlist-button-disabled" id="group-memberlist-button-revoke-rights"><b>Remover Derechos</b><i></i></a>
	<a href="#" class="new-button group-memberlist-button-disabled" id="group-memberlist-button-remove"><b>Remover</b><i></i></a>
	<a href="#" class="new-button group-memberlist-button" id="group-memberlist-button-close"><b>Cerrar</b><i></i></a>
</div>
<div id="group-memberlist-pending" style="clear: both"></div>
<div id="group-memberlist-pending-buttons" class="clearfix">
	<a href="#" class="new-button group-memberlist-button-disabled" id="group-memberlist-button-accept"><b>Aceptar</b><i></i></a>
	<a href="#" class="new-button group-memberlist-button-disabled" id="group-memberlist-button-decline"><b>Rechazar</b><i></i></a>
	<a href="#" class="new-button group-memberlist-button" id="group-memberlist-button-close2"><b>Cerrar</b><i></i></a>
</div>
	</div>
</div>
<?php } ?>