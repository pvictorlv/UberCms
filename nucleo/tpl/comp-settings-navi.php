<div>
    <div class="content">
        <div class="habblet-container" style="float:left; width:210px;">
            <div class="cbb settings">

                <h2 class="title">Preferencias</h2>
                <div class="box-content">
                    <div id="settingsNavigation">
                        <ul>
                            <li <?php if (SUB_PAGE_ID == 4) {
                                echo 'class="selected"';
                            } ?>><a href="%www%/profile">Preferencias</a></li>
                            <li><a href="%www%/identity/password" target="_blank">Alterar Senha</a></li>
                            <li <?php if (SUB_PAGE_ID == 5) {
                                echo 'class="selected"';
                            } ?>><a href="%www%/identity/email">Alterar email</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <?php global $users;
            if (!$users->hasClub(USER_ID)) { ?>
                <div class="cbb habboclub-tryout">
                    <h2 class="title">Junte-se ao Habbo Clube!</h2>
                    <div class="box-content">
                        <div class="habboclub-banner-container habboclub-clothes-banner"></div>
                        <p class="habboclub-header">ClaN Habbo Club is our VIP members-only club: absolutely no
                            riff-raff admitted! Members enjoy a wide range of benefits, including exclusive clothes,
                            free gifts and an extended Friend List.</p>
                        <p class="habboclub-link"><a href="%www%/credits/uberclub">Check out Happo Club &gt;&gt;</a></p>
                    </div>
                </div>
            <?php } ?>

        </div>