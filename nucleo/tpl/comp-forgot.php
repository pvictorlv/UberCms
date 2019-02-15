<head>
    <style type="text/css">
        div.left-column {
            float: left;
            width: 48%
        }

        div.right-column {
            float: right;
            width: 47%
        }

        label {
            display: block
        }

        input {
            width: 98%
        }

        input.process-button {
            width: auto;
            float: right
        }

        div.box-content {
            padding: 15px 8px;
        }

        div.right-column p {
            color: gray;
        }

        div.divider {
            background: transparent url(%www%/images/line_gray.png) repeat-y;
            width: 1px;
            height: 130px;
            float: left;
            margin: 1px 15px 20px;
        }
    </style>
    <link rel="shortcut icon" href="%www%/favicon.ico">

    <div id="process-content">
        <div class="cbb clearfix">

            <h2 class="title">Você esqueceu a sua senha?</h2>
            <div class="box-content">
                <div class="left-column">

                    <p>Não entre em panico! Escreva os seus dados abaixo e nós lhe enviaremos um e-mail com sua nova
                        senha.</p>

                    <div class="clear"></div>

                    <form method="post" name="forgot_pass_name" id="forgottenpw-form">

                        <p>
                            <label for="forgottenpw-username">Nome Habbo</label>
                            <input type="text" name="username" id="forgottenpw-username" value="" required/>
                        </p>

                        <p>
                            <input type="hidden" value="<?php echo $_SESSION['csrf_token'] ?>" name="csrf_token"/>
                            <input type="submit" value="Enviar minha senha" name="submit" class="submit process-button"
                                   id="forgottenpw-submit"/>
                        </p>
                    </form>
                    <br>
                    <form method="post" name="forgot_pass_mail" id="forgottenpw-form">

                        <p>
                            <label for="forgottenpw-username">Email</label>
                            <input type="email" name="email" id="forgottenpw-username" value="" required/>
                        </p>

                        <p>
                            <input type="hidden" value="<?php echo $_SESSION['csrf_token'] ?>" name="csrf_token"/>
                            <input type="submit" value="Enviar minha senha" name="submit" class="submit process-button"
                                   id="forgottenpw-submit"/>
                        </p>
                    </form>
                </div>
                <div class="divider"></div>

                <div class="right-column">
                    <p><b>Como mudar a senha?</b></p>
                    <p>Aqui você pode recuperar a senha associada a um determinado Habbo. Será enviado um email onde
                        você terá as instruções necessárias para recuperar sua senha.</p>
                </div>
            </div>
        </div>


        <p><a href="%www%/">Retornar ao hotel &raquo;</a></p>
        <div class="clear"></div>