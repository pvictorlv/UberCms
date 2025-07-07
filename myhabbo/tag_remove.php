<?php
include '../global.php';

if (isset($_POST['accountId']) && isset($_POST['tagId'])) {
    $tagid = filter($_POST['tagId']);
    db::query("DELETE FROM users_tags WHERE id = ? AND user_id = ?", $tagid, USER_ID);

} else {
    echo "ERROR";
}
?>


<script type="text/javascript">

    TagHelper.setTexts({
        tagLimitText: "Limite de etiquetas atingido, remova alguma antes de continuar.",
        invalidTagText: "Etiqueta inválida.",
        buttonText: "OK"
    });
    TagHelper.bindEventsToTagLists();
</script>
