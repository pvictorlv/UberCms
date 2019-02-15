<?php
require_once('../global.php');

if (!LOGGED_IN) {
    header('Location: ' . WWW . '/');
}
?>
<ul id="inventory-item-list">
    <?php
    $sql = dbquery("SELECT id,skin,type FROM site_inventory_items WHERE type = 'Notes' AND userId = '" . USER_ID . "'");
    $data = $sql->fetch_assoc();
    $count = $sql->num_rows;

    if ($count > 0) {
        ?>
        <li id="inventory-item-<?php echo $data['id']; ?>" title="Notas" class="selected">
            <div class="webstore-item-preview <?php echo $data['skin']; ?> <?php echo $data['type']; ?>">
                <div class="webstore-item-mask">
                    <div class="webstore-item-count">
                        <div>x<?php echo $count; ?></div>
                    </div>
                </div>
            </div>
        </li>
        <?php
    } else {
        ?>
        <li class="webstore-item-empty"></li>
        <?php
    }
    ?>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
    <li class="webstore-item-empty"></li>
</ul>
