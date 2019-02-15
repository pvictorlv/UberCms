<?php
include '../global.php';

if (isset($_POST['accountId']) && isset($_POST['tagId'])) {
    $tagid = filter($_POST['tagId']);
    if (is_numeric($tagid)) {
        $sql = dbquery("SELECT user_id FROM user_tags WHERE id = '" . $tagid . "' LIMIT 1");
        $data = $sql->fetch_assoc();

        if ($sql->num_rows > 0) {
            if ($data['user_id'] == USER_ID) {
                dbquery("DELETE FROM user_tags WHERE id = '" . $tagid . "' LIMIT 1");
                //echo "SUCCESS";
            } else {
                echo "ERROR";
            }
        } else {
            echo "ERROR";
        }
    } else {
        echo "ERROR";
    }
} else {
    echo "ERROR";
}
?>
<div id="profile-tags-container">
    <?php
    $accountId = filter($_POST['accountId']);
    $sql = dbquery("SELECT * FROM user_tags WHERE user_id = '" . $accountId . "'");
    if ($sql->num_rows > 0) {
        while ($data = $sql->fetch_assoc()) {

            ?>
            <span class="tag-search-rowholder">
        <a href="http://xukys-hotel.com/tag/<?php echo fixText($data['tag'], true, false, true, false, false); ?>"
           class="tag"><?php echo fixText($data['tag'], true, false, true, false, false); ?></a><div class="tag-id"
                                                                                                     style="display:none"><?php echo $data['id']; ?></div><?php if (USER_ID == $data['user_id']) { ?>
                    <img border="0" class="tag-delete-link"
                         onmouseover="this.src='<?php echo WWW; ?>/web-gallery/images/buttons/tags/tag_button_delete_hi.gif'"
                         onmouseout="this.src='<?php echo WWW; ?>/web-gallery/images/buttons/tags/tag_button_delete.gif'"
                         src="<?php echo WWW; ?>/web-gallery/images/buttons/tags/tag_button_delete.gif"><?php } ?>
    </span>
            <?php
            $query = dbquery("SELECT user_id FROM user_tags WHERE tag = '" . $data['tag'] . "' AND user_id = '" . USER_ID . "' AND user_id != '" . $data['user_id'] . "' LIMIT 1");
            if ($query->num_rows > 0) {

                ?>
                <img id="tag-img-added" border="0" class="tag-none-link"
                     src="<?php echo WWW; ?>/web-gallery/images/buttons/tags/tag_button_added.gif" style="display:none">
                <?php
            }
            ?>
            <?php
        }
    } else {
        echo "Nenhuma etiqueta encontrada";
    }
    ?>
</div>

<script type="text/javascript">

    TagHelper.setTexts({
        buttonText: "OK",
        tagLimitText: "Limite alcançado, remova alguns antes de continuar."
    });

</script>
