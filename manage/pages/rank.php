<?php
$pagename = "Cargos";
if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin')) {
    exit;
}

$data = null;
$u = 0;

if (isset($_POST['rank'])) {
    global $users;
    $user = filter($_POST['user']);
    $rank = filter($_POST['rank']);
    $q = $users->Name2id($user);
    if ($q == null) {
        $msg = "Usuário não encontrado!";
    } else {
        $users->SetUserVar($q, 'rank', $rank);
        $msg = "Alterado com sucesso!";
    }
}

require_once "top.php";

$GetRangos = db::query("SELECT * FROM ranks ORDER BY id");
?>
    <h2 class="title"><?php echo $pagename; ?></h2>
    <div class="box-content">
        <?php if (isset($msg)) { ?><?php echo $msg; ?><?php } ?><br>

        <form method='post' name='rank' action='index.php?_cmd=rank&do=give'>

            Usuario:<br/>
            <input type="text" name="user"><br/>
            <br/>
            Rango:<br/>
            <select name='rank' class='dropdown'>

                <?php while ($Rangos = $GetRangos->fetch(2)) {

                    echo '
<option value="' . $Rangos['id'] . '">' . $Rangos['name'] . '</option> ';

                } ?>

            </select><br/>
            <br/>
            <input type="submit" value="Dar Rango">
        </form>


    </div>

<?php

require_once "bottom.php";

?>