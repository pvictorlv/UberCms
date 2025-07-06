<?php
/*===================================================+
|| # HoloCMS - Website and Content Management System
|+===================================================+
|| # Copyright ? 2008 Meth0d. All rights reserved.
|| # http://www.meth0d.org
|+===================================================+
|| # HoloCMS is provided "as is" and comes without
|| # warrenty of any kind. HoloCMS is free software!
|+===================================================*/

require_once "../global.php";

// Sanitize and validate input
$groupId = filter_input(INPUT_POST, 'groupId', FILTER_VALIDATE_INT);
if (!$groupId) {
    exit('Invalid group ID');
}

$sql = Db::query("SELECT * FROM groups_details WHERE id = ? LIMIT 1", $groupId);
$row = $sql->fetch(PDO::FETCH_ASSOC);

if($row['topics'] == "1" || $row['topics'] == "0") {
$check = Db::query("SELECT * FROM groups_memberships WHERE userid = ? AND groupid = ? LIMIT 1", USER_ID, $groupId);
if($check->rowCount() > 0) { 
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="group-postlist-list" id="group-postlist-list">
<tbody><tr>
    <td class="post-header-link" valign="top" style="width: 148px;"></td>
    <td class="post-header-name" valign="top"></td>
    <td align="right">
</tr>
<tr>
	<td colspan="3" class="post-list-row-container"><div id="new-topic-preview"></div></td>
</tr>

<tr class="new-topic-entry-label" id="new-topic-entry-label">
	<td class="new-topic-entry-label">Asunto:</td>
	<td colspan="2">

		<table style="margin: 5px; width: 98%;" border="0" cellpadding="0" cellspacing="0">
		<tbody><tr>
		<td>
	    <div class="post-list-content-element"><input size="50" id="new-topic-name" value="" type="text"></div>
	    </td>
	    </tr>
	    </tbody></table>
    </td>
</tr>
<tr class="topic-name-error">
    <td></td>
    <td colspan="2">
        <div id="topic-name-error"></div>
    </td>
</tr>

<tr id="new-post-entry-message" style="display:none;">
	<td class="new-post-entry-label"><div class="new-post-entry-label" id="new-post-entry-label">Mensaje:</div></td>
	<td colspan="2">

		<table style="margin: 5px; width: 98%;" border="0" cellpadding="0" cellspacing="0">
		<tbody><tr>
		<td>
		<input id="edit-type" type="hidden">
		<input id="post-id" type="hidden">
        <a href="#" class="preview-post-link" id="topic-form-preview">Previa »</a>
        <input id="spam-message" value="¡Se ha detectado spam!" type="hidden">
		<textarea id="post-message" class="new-post-entry-message" rows="5" name="message" ></textarea>
    <script type="text/javascript">
        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("post-message");
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
        bbcodeToolbar.addColorSelect("Colores", colors, false);
    </script>
	    <br /><br/>
        <a class="new-button red-button cancel-icon" href="/groups/<?php echo $groupId; ?>/id/discussions"><b><span></span>Cancelar</b><i></i></a>
        <a id="topic-form-save" class="new-button green-button save-icon" href="#"><b><span></span>Guardar</b><i></i></a>
        </td>
        </tr>
        </table>
	</td>
</tr>

</table>
<div id="new-post-preview" style="display:none;">
</div>
<?php } }else if($row['topics'] == 2) {
$check = Db::query("SELECT * FROM groups_memberships WHERE userid = ? AND groupid = ? AND member_rank = ? LIMIT 1", USER_ID, $groupId, 2);
if($check->rowCount() > 0) { 
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="group-postlist-list" id="group-postlist-list">
<tr>
    <td class="post-header-link" valign="top" style="width: 148px;"></td>
    <td class="post-header-name" valign="top"></td>
    <td align="right">
</tr>
<tr>
	<td colspan="3" class="post-list-row-container"><div id="new-topic-preview"></div></td>
</tr>

<tr class="new-topic-entry-label" id="new-topic-entry-label">
	<td class="new-topic-entry-label">Asunto:</td>
	<td colspan="2">
		<table border="0" cellpadding="0" cellspacing="0" style="margin: 5px; width: 98%;">
		<tr>
		<td>
	    <div class="post-list-content-element"><input type="text" size="50" id="new-topic-name"/></div>
	    </td>
	    </tr>
	    </table>
    </td>
</tr>
<tr class="topic-name-error">
    <td></td>
    <td colspan="2">
        <div id="topic-name-error"></div>
    </td>
</tr>

<tr id="new-post-entry-message" style="display:none;">
	<td class="new-post-entry-label"><div class="new-post-entry-label" id="new-post-entry-label">Mensaje:</div></td>
	<td colspan="2">
		<table border="0" cellpadding="0" cellspacing="0" style="margin: 5px; width: 98%;">
		<tr>
		<td>
		<input type="hidden" id="edit-type"/>
		<input type="hidden" id="post-id"/>
        <a href="#" class="preview-post-link" id="topic-form-preview">Previa »</a>
        <input type="hidden" id="spam-message" value="¡Spam Detectado!"/>
		<textarea id="post-message" class="new-post-entry-message" rows="5" name="message" ></textarea>
    <script type="text/javascript">
        bbcodeToolbar = new Control.TextArea.ToolBar.BBCode("post-message");
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
        bbcodeToolbar.addColorSelect("Color", colors, false);
    </script>
	    <br /><br/>
        <a class="new-button red-button cancel-icon" href="/groups/<?php echo $groupId; ?>/id/discussions"><b><span></span>Cancelar</b><i></i></a>
        <a id="topic-form-save" class="new-button green-button save-icon" href="#"><b><span></span>Guardar</b><i></i></a>
        </td>
        </tr>
        </table>
	</td>
</tr>

</table>
<div id="new-post-preview" style="display:none;">
</div>
<?php } } ?>