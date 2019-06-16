<div class="habblet-container " id="giftqueue">
    <div class="cbb clearfix rooms ">

        <h2 class="title">Seu próximo presente
            <span class="habblet-close" id="habblet-close-giftqueue"></span></h2>
        <div class="box-content" id="gift-container">

            <div class="gift-img"><img
                    src="<?php echo WWW; ?>/web-gallery/v2/images/welcome/newbie_furni/noob_stool_1.png"
                    alt="Banqueta"/></div>
            <div class="gift-content-container">
                <p class="gift-content">
                    Seu próximo presente grátis será uma
                    <strong>Banqueta laranja</strong>
                </p>

                <p>
                    <b>Recebera em:</b> <span id="gift-countdown"> 00:00:00</span>
                </p>

               <!-- <p class="last">
                    <a class="new-button green-button"
                       href="<?php /*echo PATH; */?>/client?forwardId=2&roomId=<?php /*echo $myrow['roomid']; */?>"
                       target="<?php /*echo $myrow['client_token']; */?>"
                       onclick="HabboClient.roomForward(this, '<?php /*echo $myrow['roomid']; */?>', 'private'); return false;"><b>Entrar
                            no quarto &gt;&gt;</b><i></i></a>
                </p>-->
                <br style="clear: both"/>
            </div>

            <script type="text/javascript">
                L10N.put("time.hours", "{0}h");
                L10N.put("time.minutes", "{0}min");
                L10N.put("time.seconds", "{0}s");
                GiftQueueHabblet.init(5000);
            </script>

        </div>
    </div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
        Rounder.init();
    }</script>