<?php
if(isset($_POST['forgot_pass'])){
        $login = filter($_POST['login']);
$result = dbquery("SELECT * FROM users WHERE username='$login'");
while($l = mysql_fetch_array($result)) {
        $login = $l['username'];
        $senha = $l['password'];
        $email = $l['mail'];
}
require_once "/comandos/api/class.phpmailer.php";
$mail = new PHPMailer();
$mail->IsSMTP();                                     // set mailer to use SMTP
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Host = "smtp.zoho.com";  // specify main and backup server
        $mail->Port = 465;
        $mail->Username   = "contato@crazzyhost.com"; // GMAIL username
        $mail->Password   = "poque12345"; // GMAIL password
        $mail->AddReplyTo("contato@crazzyhost.com","CrazzyPan - CrazzyHost.com"); // Reply email address
        $mail->From = "contato@crazzyhost.com";
        $mail->SMTPSecure = 'ssl';
        $mail->FromName = "Recuperar senha - CrazzyHost.com"; // Name to appear once the email is sent
        $mail->Subject = "Recuperar Senha - CrazzyPan"; // Email's subject
        $mail->AltBody = "Habilite o suporte html do seu e-mail"; // optional, comment out and test
        $mail->WordWrap = 50; // set word wrap
        $body = "
        <br>
<strong>Ol&aacute;, $login</strong>
<div><br />
</div>
<div>Você esqueceu sua senha? Segue os Dados de acesso novamente:</div>
<div><br />
</div>
<div><strong>Seus dados de acesso ao painel s&atilde;o:</strong></div>
<div><br />
</div>
<div>Login: $login</div>
<div>Senha: $senha</div>
<div><br />
</div>
<div>* Você recebeu esse email pois pediu o reenvio de seus dados através do painel. Caso não se recorde de ter pedido, desconsidere esse email!</div>
<div><br />
</div>

<div><strong>CrazzyPan - Painel de Gerenciamento Habbo</strong></div>
<div><strong><br />
</strong></div>
<div><strong>Esse email &eacute; autom&aacute;tico, n&atilde;o o responda .</strong></div>
        ";
        $mail->MsgHTML($body); // [optional] Send body email as HTML
        $mail->AddAddress("$email", "Solicitante");  // email address of recipient
        $mail->IsHTML(true); // [optional] send as HTML
        if(!$mail->Send()) {echo "<script>alert('Oops, houve um problema com nosso servidor, tente novamente mais tarde!')</script>";}
        echo "<div class=\"alert alert-success\"><strong>Sucesso:</strong> Email de recupera&ccedil;&atilde;o enviado com sucesso.</div>";
    }
    ?>