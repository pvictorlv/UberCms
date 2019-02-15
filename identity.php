<?php

require_once "global.php";
require_once "nucleo/recaptchalib.php";
if (!LOGGED_IN) {
    header("Location: " . WWW . "/");
    exit;
} else if ($users->GetUserVar(USER_ID, 'room_created') == "0") {
    header("Location: " . WWW . "/register/welcome");
    exit;
}
$tpl->Init();
$tpl->SetParam('errors', '');
if (isset($_GET['errors'])) {
    $error = '<div id="error-messages-container" style="margin: 5px; margin-top: 10px;">
            <div class="error-messages-holder">
                <h3>Change some information, And try again.</h3>
                <ul>
                    <li><p class="error-message">' . $_GET['errors'] . '.</p></li>
                </ul>
            </div>
            </div>';
    $tpl->SetParam('errors', $error);
}

$type = $_GET['type'];

// Initial variables
$tpl->SetParam('page_title', 'Avatares');

// Generate page header
$tpl->AddGeneric('head/head-init');
$tpl->AddIncludeSet('identity');

if ($type == "password" || $type == "email") {
    $tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/changepassword.css', 'stylesheet'));
    $tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/embeddedregistration.css', 'stylesheet'));
}
$tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/identity_settings.css', 'stylesheet'));
if ($type == "avatars" || $type == "add_avatar")
    $tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/avatarselection.css', 'stylesheet'));

$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head/head-bottom');

// Habbo name check
$tpl->AddGeneric('check-name');

switch ($type) {
    case "avatars":
        dbquery("UPDATE `users` SET `real_name` = '" . $_SESSION['jjp']['login']['name'] . "' WHERE `mail` = '" . $_SESSION['jjp']['login']['email'] . "'");
        $tpl->AddGeneric('identity-avatars');
        break;

    case "add_avatar":
        $tpl->AddIncludeFile(new IncludeFile('text/css', '%www%/web-gallery/v2/styles/avatarselection.css', 'stylesheet'));
        $tpl->AddGeneric('identity-add-avatars');
        break;

    case "add_avatar_add":
        $userP = $_SESSION['UBER_USER_H'];
        $userL = filter($_POST['bean_look']);
        $userN = filter($_POST['bean_avatarName']);
        $userE = $_SESSION['jjp']['login']['email'];
        $gender = filter($_POST['bean_gender']);

        if (strlen($userN) < 1 and strlen($userN) > 32) {
            $errors = "Your name must be between 1 and 32 characters";
        } else if ($users->IsNameTaken($userN)) {
            $errors = "This name is already in use";
        } else if ($users->IsNameBlocked($userN)) {
            $errors = "This name is blocked by habbo staff";
        } else if (!$users->IsValidName($userN)) {
            $errors = "This name is not valid";
        }

        if (!isset($errors)) {
            $userE = $_SESSION['jjp']['login']['email'];
            $users->Add($userN, $userP, $userE, 1, $userL, $gender);
            dbquery("UPDATE `users` SET `real_name` = '" . $_SESSION['jjp']['login']['user'] . "' WHERE `mail` = '" . $_SESSION['jjp']['login']['email'] . "'");

            $_SESSION['SHOW_WELCOME'] = true;
            $_SESSION['UBER_USER_N'] = $userN;

            $_SESSION['jjp']['login']['user'] = $_SESSION['UBER_USER_N'];
            $_SESSION['jjp']['login']['email'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'mail');
            $_SESSION['jjp']['login']['name'] = $users->GetUserVar($users->Name2id($_SESSION['jjp']['login']['user']), 'real_name');

            header("Location: " . WWW . "/register/welcome");
            exit;
        }

        header("Location: " . WWW . "/identity/add_avatar/error/" . $errors);
        exit;
        break;

    case "useOrCreateAvatar":
        if ($users->GetUserVar($_GET['param'], 'mail') == $_SESSION['jjp']['login']['email'] and $users->GetUserVar($_GET['param'], 'password') == $_SESSION['UBER_USER_H'])
            $_SESSION['UBER_USER_N'] = $users->GetUserVar($_GET['param'], 'username');
        else {
            header("Location: " . WWW . "/identity/avatars/error/You can't log-in on this account");
            exit;
        }

        header('Location: ' . WWW . '/');
        exit;

        break;

    case "settings":
        $tpl->AddGeneric('identity-settings');
        break;

    case "password":
        $tpl->SetParam('recaptcha_html', recaptcha_get_html("6Le-aQoAAAAAABnHRzXH_W-9-vx4B8oSP3_L5tb0"));
        $tpl->AddGeneric('identity-password');
        break;

    case "password_change":
        $userP = $_SESSION['UBER_USER_H'];
        $userE = $_SESSION['jjp']['login']['email'];
        $userCP = filter($_POST['currentPassword']);
        $userNP = filter($_POST['newPassword']);
        $userNPA = filter($_POST['retypedNewPassword']);

        $resp = recaptcha_check_answer('6Le-aQoAAAAAAKaqhlUT0lAQbjqokPqmj0F1uvQm', USER_IP, $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
        if (!$resp->is_valid) {
            $error = "Código captcha incorreto";
        } else if ($userP <> $userCP) {
            $error = "A senha digitada não é correta";
        } else if ($userNP <> $userNPA) {
            $error = "As senhas não conferem";
            exit;
        } else if (strlen($userNP) < 6) {
            $error = "Sua nova senha é muito curta";
        } else if (!isset($error)) {
            $newPass = $userNP;
            $result = dbquery("UPDATE `users` SET `password` = '" . $newPass . "' WHERE `mail` = '" . $userE . "'");
            if ($result) {
                $_SESSION['UBER_USER_H'] = $newPass;
                header("Location: " . WWW . "/identity/settings&passwordChanged=true");
            } else {
                $error = "Erro ao processar, tente novamente";
            }
        }

        header("Location: " . WWW . "/identity/password/error/" . $error);
        exit;

        break;

    case "email":
        $tpl->SetParam('recaptcha_html', recaptcha_get_html("6Le-aQoAAAAAABnHRzXH_W-9-vx4B8oSP3_L5tb0"));
        $tpl->AddGeneric('identity-email');
        break;

    case "add_email":
        $userP = $_SESSION['UBER_USER_H'];
        $userE = $_SESSION['jjp']['login']['email'];
        $userCP = filter($_POST['currentPassword']);
        $userNP = filter($_POST['newPassword']);
        $userNPA = filter($_POST['retypedNewPassword']);

        $resp = recaptcha_check_answer('6Le-aQoAAAAAAKaqhlUT0lAQbjqokPqmj0F1uvQm', USER_IP, $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
        if (!$resp->is_valid) {
            $error = "Captcha code is not valid";
        } else if ($userP <> $userCP) {
            $error = "Your password is not equal with your old password";
        } else if ($userNP <> $userNPA) {
            $error = "Your new password is not equal with your retype password";
            exit;
        } else if (strlen($userNP) < 6) {
            $error = "Your new password is too short";
        } else if (!isset($error)) {
            $newPass = $userNP;
            $result = dbquery("UPDATE `users` SET `password` = '" . $newPass . "' WHERE `mail` = '" . $userE . "'");
            if ($result) {
                $_SESSION['UBER_USER_H'] = $newPass;
                header("Location: " . WWW . "/identity/settings&passwordChanged=true");
            } else {
                $error = "Your password is not saved!";
            }
        }

        header("Location: " . WWW . "/identity/password/error/" . $error);
        exit;

        break;
}
$tpl->Output();