<div class="habblet-container ">
    <div class="cbb clearfix darkgray ">


        <div id="redeem-habblet">
            <div class="redeem-balance">
                <p class="redeem-balance-username">%habboName%</p>
                <p class="redeem-balance-text">Carteira:</p>
                <p><span class="redeem-balance-amount">%creditsBalance%</span></p>
            </div>

            <div class="redeem-redeeming-text"><p class="redeeming-text">Insira seu código</p></div>

            <div class="redeem-form-container clearfix">
                <form method="post" action="%www%/credits" id="voucher-form">
                    <div class="redeem-redeeming">
                        <div><input type="text" name="voucherCode" value="" class="redeemcode" size="8"/></div>

                        <div class="redeem-redeeming-button"><a href="#"
                                                                class="new-button green-button redeem-submit"><b><span></span>Continuar</b><i></i></a>
                        </div>

                    </div>
                </form>

            </div>

        </div>

        <script type="text/javascript">
            document.observe("dom:loaded", function () {
                new NewRedeemHabblet();
            });
        </script>


    </div>
</div>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
        Rounder.init();
    }</script>