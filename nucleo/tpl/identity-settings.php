<link rel="shortcut icon" href="%www%/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon"/>
<script src="%www%/js/oodomimagerollover.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/visual.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/common.js" type="text/javascript"></script>

<link rel="stylesheet" href="%www%/web-gallery/styles/buttons.css" type="text/css"/>
<link rel="stylesheet" href="%www%/web-gallery/styles/tooltips.css" type="text/css"/>
<script src="%www%/web-gallery/static/js/simpleregistration.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/libs2.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/libs.js" type="text/javascript"></script>
<script src="%www%/web-gallery/static/js/fullcontent.js" type="text/javascript"></script>
<link rel="stylesheet" href="%www%/web-gallery/v2/styles/process.css" type="text/css"/>
<body id="embedpage">
<div id="overlay"></div>


<div id="container">

    <div class="settings-container clearfix">

        <h1>Gerenciar emails</h1>

        <div id="back-link">

            <a href="%www%/identity/avatars">Meus avatares</a> &raquo; Gerenciar emails

        </div>


        <div style="padding: 0 10px">


            <h3>E-mail:</h3>

            <div class="opt-email">

                <span><?php echo $_SESSION['jjp']['login']['email']; ?></span>

                 <a id="manage-email" class="new-button" href="%www%/identity/email"><b>Mudar email</b><i></i></a>

        </div>

        <br clear="all"/>



        <h3>Meios de login:</h3>

        <p>Aqui você pode ver os meios de login que você pode utilizar no habbo</p>

        <div class="opt-auth-providers clearfix settings-auth" style="float: none; width: auto">        

                <p>

                	<img src="%www%/web-gallery/v2/images/rpx/icon_habbo_big.png" style="vertical-align: middle" title="habbo"/>

                	<?php echo $_SESSION['jjp']['login']['email']; ?>

		 			<span class="last-access-time">

					    Last used: *****

					</span>

                </p>

        <p>

        </p>

        </div>

        <br clear="all"/>

                

        <h3>Senha:</h3>
				<?php if (isset($_GET['passwordChanged'])) { ?><p class="confirmation">Senha trocada com sucesso!</p><?php } ?>
        <div class="opt-password">

            <span>**************</span>

            <a id="manage-password" class="new-button" href="%www%/identity/password"><b>Trocar</b><i></i></a>

        </div>



        </div>

    </div>

    <div class="settings-container-bottom">
   
   </div>