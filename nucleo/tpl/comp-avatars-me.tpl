<?php

function GetDescr($level)
{
    switch ($level)
    {
        
    
        default:
        
            return '';
    }
}

$getGroups = db::query("SELECT id,name FROM ranks WHERE id = 1");

while ($group = mysql_fetch_assoc($getGroups))
{    
    echo '<div class="habblet-container ">        
                        <div class="cbb clearfix blue ">
    
                            <h2 class="title">Tous mes avatars
                            </h2>
                            <div id="avatar-selector-habblet">';
    $getMembers = db::query("SELECT `id`,`username`,`last_online`,`look`,`password` FROM `users` WHERE `mail` = '".$_SESSION['jjp']['login']['email']."'");
    
    echo'<ul>';
    
    if (mysql_num_rows($getMembers) > 0)
    {
        $oe = 1;
        
        while ($member = mysql_fetch_assoc($getMembers))
        {
            if ($oe == 2)
            {
                $oe = 1;
            }
            
            else
            {
                $oe = 2;
            }
            
            echo '<li' . (($oe == 2) ? ' class="even">' : '>') . '
                        <img class="avatar-image" src="http://www.habbo.fr/habbo-imaging/avatarimage?figure=' . $member['look'] . '&size=s"/>
                        <div class="avatar-info">
                        <div class="avatar-info-container">
                        <div class="avatar-name">' . clean($member['username']) . '</div>
                        <div class="avatar-lastonline">
                            Derni&egrave;re connexion: 
                            <span title ="' . clean($member['last_online']) . '">' . clean($member['last_online']) . '</span>
                        </div>
                    </div>
<div class="avatar-select"><a href="%www%/identity/useOrCreateAvatar/' . clean($member['id']) . '"><b>Jouer</b><i></i></a>
</div>
    </div>
</li>';

                    echo '';
        }
    }
    else
    {
        echo '<center><i>Tu n\'as pas d\'autres avatars</i></center>';
    }
    
    echo '</li>
    </ul>
    </div>
    </div>
    </div>
<script type="text/javascript">if (!$(document.body).hasClassName(\'process-template\')) { Rounder.init(); }</script> ';
}

?>