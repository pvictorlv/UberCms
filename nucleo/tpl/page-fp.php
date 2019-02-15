<body id="frontpage">
<div id="fp-container">
    <div id="header" class="clearfix">
        <h1><a href="%www%"></a></h1>

        <span class="login-register-link" style="color: #fff;">
            Novo por aqui?
            <a href="%www%/register">REGISTRE-SE DE GRAÇA</a>
        </span>

    </div>
    <div id="content">
        <div id="column1" class="column">

            <div class="habblet-container ">

                <div class="logincontainer">
                    %login_result%
                    <div class="cbb loginbox clearfix">
                        <h2 class="title">Sign in</h2>
                        <div class="box-content clearfix" id="login-habblet">
                            <form action="%www%/account/submit" method="post" class="login-habblet">

                                <ul>
                                    <li>
                                        <label for="login-username" class="login-text">Usuário</label>
                                        <input tabindex="1" type="text" class="login-field" name="credentials.username"
                                               id="login-username" value="%credentials_username%" maxlength="32"/>
                                    </li>
                                    <li>
                                        <label for="login-password" class="login-text">Senha</label>
                                        <input tabindex="2" type="password" class="login-field"
                                               name="credentials.password" id="login-password" maxlength="32"/>

                                        <input type="submit" value="Logar" class="submit new-button"
                                               id="login-submit-button" style="margin-left: 110px;"/>
                                        <input type="hidden" value="%csrf_token%" name="csrf_token">
                                        <a href="#" id="login-submit-new-button" class="new-button"><b>Entrar</b><i></i></a>


                                    </li>
                                    <li>
                                        <br/><br/>
                                    </li>


                                    <li id="remember-me" class="no-label">
                                        <input tabindex="4" type="checkbox" name="_login_remember_me"
                                               id="login-remember-me" value="true"/>
                                        <label for="login-remember-me">Lembrar-me</label>
                                    </li>
                                    <li id="register-link" class="no-label">
                                        <a href="%www%/register"
                                           class="login-register-link"><span>Registre-se de graça</span></a>
                                    </li>
                                    <li class="no-label">
                                        <a href="%www%/account/password/forgot" id="forgot-password"><span>Esqueci minha senha</span></a>
                                    </li>
                                </ul>
                                <div id="remember-me-notification" class="bottom-bubble" style="display: none;">
                                    <div class="bottom-bubble-t">
                                        <div></div>
                                    </div>
                                    <div class="bottom-bubble-c">
                                        Lembre-se: selecionando isso você não irá deslogar a menos que aperte "sair",
                                        portanto, apenas faça isso caso esteja em um computador pessoal
                                    </div>
                                    <div class="bottom-bubble-b">
                                        <div></div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    L10N.put("authentication.form.name", "Username");
                    L10N.put("authentication.form.password", "Password");
                    HabboView.add(function () {
                        LoginFormUI.init();
                    });
                    HabboView.add(function () {
                        window.setTimeout(function () {
                            RememberMeUI.init("newfrontpage");
                        }, 100)
                    });
                </script>


            </div>
            <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                    Rounder.init();
                }</script>
            
            <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                    Rounder.init();
                }</script>


            <div class="habblet-container ">

                <a href="%www%/register" id="frontpage-image"
                   style="background-image: url('%www%/images/front_page_hotel_with_habbos.png')">
                    <div id="partner-logo"></div>
                </a>
                <div style="width: 710px; margin: 0 auto;">


                    <div id="pretagline" class="roundedrect">
                        <span>No Habbo Hotel você pode fazer e encontrar amigos.</span></div>
                    <div id="spacer"></div>
                    <div id="tagline" class="roundedrect tagcloud"><?php include 'tagcloud2.php'; ?></div>

                </div>


                <div id="join-now-button-container">
                    <div id="join-now-button-wrapper">
                        <div class="join-now-button">
                            <a class="join-now-link" id="register-link" href="/register"
                               onclick="startRegistration(this); return false;">
                                <span class="join-now-text-big">ENTRE é</span>
                                <span class="join-now-text-small"><b>GRÁTIS</b></span>
                            </a>
                            <span class="close"></span>
                        </div>

                    </div>
                </div>
                <script type="text/javascript">if (!$(document.body).hasClassName('process-template')) {
                        Rounder.init();
                    }</script>

            </div>
        </div>
    </div>
</div>
