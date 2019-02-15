<?php
header('Content-Type: text/html; charset=UTF-8');
if (isset($_GET['search'])) {
    $search = filter($_GET['search']);
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

                $getUsersId = dbquery("SELECT id, tag, user_id FROM user_tags WHERE `tag` LIKE  '" . $search . "'");
                if ($getUsersId->num_rows > 0) {
                    $result = '&nbsp;' . $getUsersId->num_rows . ' resultados';
                } else {
                    $result = '&nbsp;0 resultados';
                }

                echo '<p class="search-result-count">' . $result . '</p> ';
                echo '<p class="search-result-divider"></p> ';

                if ($getUsersId->num_rows > 0) {
                    $oe = 1;

                    while ($users = $getUsersId->fetch_assoc()) {
                        if ($oe == 2) {
                            $oe = 1;
                        } else {
                            $oe = 2;
                        }

                        $getUsersName = dbquery("SELECT username,motto,look FROM users WHERE `id` = " . $users['user_id']);
                        while ($usersName = $getUsersName->fetch_assoc()) {
                            echo '<table border="0" cellpadding="0" cellspacing="0" width="100%" class="search-result"> 
        <tbody> 
            <tr class="' . (($oe == 2) ? 'odd' : 'even') . '"> 
                <td class="image" style="width:39px;"> 
                    <img src="http://avatar-retro.com/habbo-imaging/avatarimage?figure=' . $usersName['look'] . '&direction=4&size=s" alt="" align="left"/> 
                </td> 
                <td class="text"> 
                    <a href="/home/' . $usersName['username'] . '" class="result-title">' . $usersName['username'] . '</a><br/> 
                    <span class="result-description">  ' . $usersName['motto'] . ' </span> 
 
    <ul class="tag-list">';
                            $getUserTags = dbquery("SELECT tag, user_id FROM user_tags WHERE `user_id` =  '" . $users['user_id'] . "'");
                            while ($tags = $getUserTags->fetch_assoc()) {
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