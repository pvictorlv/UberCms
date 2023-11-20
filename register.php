<?php
include "global.php";
if (LOGGED_IN) {
    header('Location: ' . WWW . "/me");
    exit;
}


$tpl->SetParam('error-messages-holder', '');
$tpl->SetParam('post-name', '');
$tpl->SetParam('post-pass', '');
$tpl->SetParam('post-tos-check', '');
$tpl->SetParam('post-mail', '');

if (isset($_GET['doSubmit'])) {
    if (isset($_POST['checkNameOnly']) && $_POST['checkNameOnly'] == 'true') {
        $name = ($_POST['bean_avatarName']);

        echo '<div class="field field-habbo-name">
                  <label for="habbo-name">Nome de usuário</label>
                  <input type="text" id="habbo-name" size="32" value="' . clean($name) . '" name="bean.avatarName" class="text-field" maxlength="32"/>
                  <a href="#" class="new-button" id="check-name-btn"><b>Verificar</b><i></i></a> 
                  <input type="submit" name="checkNameOnly" id="check-name" value="Check"/>
                    <div id="name-suggestions">';

        if ($users->IsNameTaken($name)) {
            echo '<div class="taken"><p>O nome <strong>' . clean($name) . '</strong> esta em uso.</p></div>';
        } else if ($users->IsNameBlocked($name)) {
            echo '<div class="taken"><p>Esse nome esta reservado</p></div>';
        } else if (!$users->IsValidName($name)) {
            echo '<div class="taken"><p>Nome Habbo invalido. Tente outro.</p></div>';
        } else {
            echo '<div class="available"><p>O nome <strong>' . clean($name) . '</strong> esta disponivel.</p></div>';
        }

        echo '                    </div>              
                  <p class="help">Seu nome pode ter letras maiúsuclas, minúsculas, números e
                                            caracteres -=?!@:.,</p>
                </div>';

        exit;
    }

    if (isset($_POST['bean_avatarName'])) {
        $registerErrors = Array();

        $name = ($_POST['bean_avatarName']);
        $password = ($_POST['bean_password']);
        $password2 = ($_POST['bean_retypedPassword']);
        $email = ($_POST['bean_email']);
        $dob_day = ($_POST['bean_day']);
        $dob_month = ($_POST['bean_month']);
        $dob_year = ($_POST['bean_year']);

        $tpl->SetParam('post-name', $name);
        $tpl->SetParam('post-pass', $password);
        $tpl->SetParam('post-mail', $email);
        $name_len = strlen($name);
        if ($name_len < 1 || $name_len > 16) {
            $registerErrors[] = 'Seu nome de usuário deve ser 1-16 caracteres de comprimento';
        }

        if ($users->IsNameTaken($name)) {
            $registerErrors[] = 'Nome Habbo inválido. Tente outro';
        } else if ($users->IsNameBlocked($name)) {
            $registerErrors[] = 'Esse nome está reservado ou não é permitido';
        } else if (!$users->IsValidName($name)) {
            $registerErrors[] = 'Desculpe, esse nome é inválido. Seu nome pode conter letras minúsculas, maiúsculas e números';
        }

        if (strlen($password) < 6) {
            $registerErrors[] = 'Sua senha precisa ter no mínimo 6 caracteres';
        }

        if ($password != $password2) {
            $registerErrors[] = 'As senhas precisam ser iguais';
        }

        if (!$users->IsValidEmail($email)) {
            $registerErrors[] = 'Por favor, insira um e-mail válido';
        }

        if (!is_numeric($dob_day) || !is_numeric($dob_month) || !is_numeric($dob_year) || $dob_day <= 0 || $dob_day > 31 ||
            $dob_month <= 0 || $dob_month > 12 || $dob_year < 1900 || $dob_year > 2010
        ) {
            $registerErrors[] = 'Escolha um aniversário válido';
        } else {
            $tpl->SetParam('post-tos-check', 'checked');
        }

        if (isset($_POST['g-recaptcha-response'])) {
            $secret = '6Ld8ShAUAAAAAIw7whfmYKjtFBMmtWdHdhfi1pTX';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if (!$responseData->success)
                $registerErrors[] = 'Código inválido';
        } else {
            $registerErrors[] = 'Preencha todos os campos';
        }

        if (count($registerErrors) <= 0) {
            $users->Add($name, $password, $email, 1, 'hd-180-1.lg-270-1340.ha-1015-62.ch-210-1340.hr-802-61.sh-908-1340', 'M');
            $_SESSION['SHOW_WELCOME'] = true;
            $_SESSION['UBER_USER_N'] = $name;
            $_SESSION['UBER_USER_H'] = $password;
            $_SESSION['jjp']['login']['user'] = $_SESSION['UBER_USER_N'];
            $_SESSION['jjp']['login']['email'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'mail');
            $_SESSION['jjp']['login']['name'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'real_name');

            header("Location: /register/welcome");
            exit;
        }

        $errResult = '<div class="error-messages-holder"><h3>Por favor, corrija os erros e tente novamente.</h3><ul>';
        foreach ($registerErrors as $err) {
            $errResult .= '<li><p class="error-message">' . $err . '</p></li>';
        }

        $errResult .= '</ul></div>';

        $tpl->SetParam('error-messages-holder', $errResult);
    }
}

$tpl->Init();

$tpl->AddGeneric('head/head-init');
$tpl->AddGeneric('head/head-register');
$tpl->AddGeneric('head/head-bottom');
$tpl->AddGeneric('page-register');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Registre seu Habbo! ');

$tpl->Output();

?>
