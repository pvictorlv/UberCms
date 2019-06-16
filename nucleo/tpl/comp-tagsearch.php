<div class="habblet-container ">
    <div class="cbb clearfix notitle ">


        <div id="article-wrapper">

            <h2>Procurar Habbo Etiquetas</h2>


            <br/>
            <form method="post" action="tag?do=find">
                <input type="text" size="59" name="main">
                <p style="position: absolute; top: 40px; right: 170px;">
                    <INPUT TYPE="image" SRC="%www%/search.png" BORDER="0" ALT="Submit Form">
                </p>
            </form>


            <p class="summary">

                <?php
                if (!isset($_GET['do'])) {
                    $_GET['do'] = "undefine";
                }
                if ($_GET['do'] == "find") {
                    echo "Você proucou por: {$_POST['main']}";
                }
                ?>
            </p>

            <div class="article-body">

                <?php
                if ($_GET['do'] == "find" || isset($_GET['tag'])) {
                    if (isset($_POST['main'])) {
                        $entered = filter($_POST['main']);
                    } else {
                        $entered = filter($_GET['tag']);
                    }
                    $override = db::query("SELECT user_id FROM user_tags WHERE tag='$entered'");
                    while ($row = $override->fetch(2)) {
                        $test = db::query("SELECT username,look,last_online,motto FROM users WHERE id='{$row['user_id']}'");
                        while ($row = $test->fetch(2)) {
                            ?>
                            <table border="0" width="100%">
                                <tr>
                                    <td width="10%">
                                        <b><?php echo "<a href=/home/{$row['username']}>{$row['username']}</a>"; ?></b>
                                        <br/>
                                        <img src="http://avatar-retro.com/habbo-imaging/avatarimage?figure=<?php echo $row['look']; ?>&size=s">
                                        <br/>
                                    </td>
                                    <td>
                                        <b>Missao:</b><i>    <?php echo $row['motto']; ?></i><br/><b>Último
                                            acesso:</b> <?php echo $row['last_online']; ?>
                                        <br/><br/>

                                    </td>
                                </tr>

                            </table>
                            <?php
                        }
                    }


                }
                ?>
            </div>


        </div>

    </div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
        Rounder.init();
    }</script>
