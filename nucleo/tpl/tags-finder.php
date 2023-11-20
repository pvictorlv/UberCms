<?php
header('Content-Type: text/html; charset=UTF-8');
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $search_engine = true;
} else {
    $search_engine = false;
    $search = '';
}
?>
<div class="habblet-container ">
    <div class="cbb clearfix default ">

        <h2 class="title">Procurar etiquetas
        </h2>
        <div id="tag-search-habblet-container">
            <form name="tag_search" action="/tag" method="get" class="search-box">
                <input name="search" type="text" class="search-box-query" id="search_query" style="float: left"
                       value="<?php echo $search; ?>"/>
                <a onclick="$(this).up('form').submit(); return false;" href="#" class="new-button search-icon"
                   style="float: left"><b><span></span></b><i></i></a>
            </form>

            <?php
            if ($search_engine) {

                $getUsersId = db::query("SELECT id, tag, user_id FROM users_tags WHERE `tag` LIKE  ?", "%$search%");
                if ($getUsersId->rowCount() > 0) {
                    $result = '&nbsp;' . $getUsersId->rowCount() . ' resultados';
                } else {
                    $result = '&nbsp;0 resultados';
                }

                echo '<p class="search-result-count">' . $result . '</p> ';
                echo '<p class="search-result-divider"></p> ';

                if ($getUsersId->rowCount() > 0) {
                    $oe = 1;

                    while ($users = $getUsersId->fetch(2)) {
                        if ($oe == 2) {
                            $oe = 1;
                        } else {
                            $oe = 2;
                        }

                        $getUsersName = db::query("SELECT username,motto,look FROM users WHERE `id` = ?", $users['user_id']);
                        while ($usersName = $getUsersName->fetch(2)) {
                            echo '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="search-result"> 
        <tbody> 
            <tr class="' . (($oe == 2) ? 'odd' : 'even') . '"> 
                <td class="image" style="width:39px;"> 
                    <img src="https://habbo.city/habbo-imaging/avatarimage?figure=' . $usersName['look'] . '&direction=4&size=s" alt="" align="left"/> 
                </td> 
                <td class="text"> 
                    <a href="/home/' . $usersName['username'] . '" class="result-title">' . $usersName['username'] . '</a><br/> 
                    <span class="result-description">  ' . $usersName['motto'] . ' </span> 
 
    <ul class="tag-list">';
                            $getUserTags = db::query("SELECT tag, user_id FROM users_tags WHERE `user_id` =  '" . $users['user_id'] . "'");
                            while ($tags = $getUserTags->fetch(2)) {
                                echo '  <li><a href="%www%/tag/' . $tags['tag'] . '" class="tag" style="font-size:10px">' . $tags['tag'] . '</a> </li>' . "\n\r";
                            }
                            echo '</ul> 
                </td> 
            </tr> 
            </tbody>
            </table>
            <br />';
                        }

                    }
                }
            }

            ?>

        </div>


    </div>
</div>