<?php
include "global.php";

if (LOGGED_IN) {
    header('Location: ' . WWW . '/me');
    exit;
}

$tpl->Init();
$tpl->SetParam('page_title', 'Crie seu habbo, construa seu quarto, converse e faça novos amigos.');

$tpl->AddGeneric('head/head-init');
$tpl->AddGeneric('head/head-fp');
$tpl->AddGeneric('head/head-overrides-fp');
$tpl->AddGeneric('head/head-bottom');

$frontpage = new Template('page-fp');
$frontpage->SetParam('login_result', '');
$tpl->SetParam('csrf_token', $_SESSION['csrf_token']);
$credUser = null;
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['csrf_token']) {
    $credUser = filter($_POST['credentials_username']);
    $credPass = filter($_POST['credentials_password']);
    $errors = null;

    if (strlen($_POST['credentials_username']) < 1) {
        $errors[] = 'Por favor, digite seu usuário';
    }

    if (strlen($_POST['credentials_password']) < 1) {
        $errors[] = 'Por favor, digite sua senha';
    }

    if (count($errors) == 0) {
        $check = $users->ValidateLogin($credUser, $credPass);
        if ($check[0]) {
            if (isset($_POST['page'])) {
                $reqPage = filter($_POST['page']);
                $pos = strrpos($reqPage, WWW);

                if ($pos === false || $pos != 0) {
                    die("<b>Security warning!</b> A malicious request was detected that tried redirecting you to an external site. Please proceed with caution, this may have been an attempt to steal your login details. <a href='" . WWW . "'>Return to site</a>");
                } else {
                    $_SESSION['page-redirect'] = $reqPage;
                }
            }

            if (!$check[1])
                $_SESSION['UBER_USER_N'] = $users->GetUserVar($users->Name2id($credUser), 'username');
            else {
                $_SESSION['UBER_USER_N'] = $users->GetUserVar($users->Email2id($credUser), 'username');
                if ($check[2] > 1)
                    $_SESSION['page-redirect'] = "identity/avatars";
            }
            $_SESSION['UBER_USER_H'] = $credPass;

            if (isset($_POST['_login_remember_me'])) {
                $_SESSION['set_cookies'] = true;
            }

            $_SESSION['jjp']['login']['user'] = $_SESSION['UBER_USER_N'];
            $_SESSION['jjp']['login']['email'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'mail');
            $_SESSION['jjp']['login']['name'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'real_name');

            header("Location: " . WWW . "/security_check.php");
            exit;
        } else {
            $errors[] = 'Usuário ou senha incorreto';
        }
    }

    if (count($errors) > 0) {
        $loginResult = '<div style="text-align: center;"><div class="action-error flash-message"><div class="rounded"><ul>';
        foreach ($errors as $err) {
            $loginResult .= '<li>' . $err . '</li>';
        }
        $loginResult .= '</ul></div></div></center>';

        $frontpage->SetParam('login_result', $loginResult);
    }
}
$frontpage->SetParam('credentials_username', $credUser);


$tpl->AddTemplate($frontpage);
$tpl->AddGeneric('footerindex');

$tpl->Output();

?>