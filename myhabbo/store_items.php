<?php
require_once('../global.php');
$s = 0;
$categoryId = filter($_POST['categoryId']);
$subCategoryId = filter($_POST['subCategoryId']);

$getStickers = dbquery("SELECT * FROM site_shop_items WHERE categoryId = '" . $subCategoryId . "'");
?>
<ul id="webstore-item-list">
    <?php for ($n = 0; $n <= 20; $n++) {
        while ($row = $getStickers->fetch_assoc()) {
            $s++;
            $n++; ?>
            <li id="webstore-item-<?php echo $row['id']; ?>" title="<?php echo $row['ItemName']; ?>">
                <div class="webstore-item-preview <?php echo $row['skin']; ?> <?php echo $row['type']; ?>">
                    <div class="webstore-item-mask">
                        <?php if ($row['amount'] > 0) { ?>
                            <div class="webstore-item-count">
                            <div>x<?php echo $row['amount']; ?></div></div><?php } ?>
                    </div>
                </div>
            </li>
        <?php }
        if ($n <= 19) { ?>
            <li class="webstore-item-empty"></li>
        <?php }
    } ?>
</ul>