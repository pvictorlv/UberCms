<?php

if (!defined('IN_HK') || !IN_HK) {
    exit;
}

if (HK_LOGGED_IN) {
    exit;
}

if (isset($_POST['usr']) && isset($_POST['pwd'])) {
    $username = filter($_POST['usr']);
    $password = filter($_POST['pwd']);

    if ($users->validateUser($username, $password)) {
        $hkId = $users->name2id($username);

        if ($users->hasFuse($hkId, 'fuse_housekeeping_login')) {
            session_destroy();
            session_start();

            $_SESSION['UBER_USER_N'] = $users->getUserVar($hkId, 'username');
            $_SESSION['UBER_USER_H'] = $password;
            $_SESSION['UBER_HK_USER_N'] = $_SESSION['UBER_USER_N'];
            $_SESSION['UBER_HK_USER_H'] = $_SESSION['UBER_USER_H'];

            header("Location: " . HK_WWW . "/index.php?_cmd=main");

            exit;
        }

        $_SESSION['HK_LOGIN_ERROR'] = "Você não tem permissão de acesso!";
    } else {
        $_SESSION['HK_LOGIN_ERROR'] = 'Detalhes inválidos';
    }
}

?>
<html>
<head>
    <title>Housekeeping: Entrar</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
            font-size: 75%;
            background-image: url(../images/bg.png);
            color: #000;
        }

        #text {
            display: block;
            padding-top: 100px;
            padding-bottom: 10px;
            margin: 0 auto;
            text-align: right;
            width: 420px;
        }

        #loginblock {
            display: block;
            margin: 10px auto;
            border: 1px solid #000;
            width: 400px;
            padding: 5px 15px 10px 15px;
        }

        #loginblock .info {
            padding-bottom: 2px;
            margin-bottom: 5px;
        }

        input.biginput {
            width: 100%;
            font-size: 2em;
            text-align: center;
            padding: 3px;
        }
    </style>
</head>
<body>


<div id="loginblock">

    <div class="info">
        <p align="center"><img src="images/ubermanage.png"></p>


    </div>

    <form method="post">

        <input style="font-family:Comic sans ms;" type="text" name="usr" class="biginput" placeholder="Usuário" value="<?php if (LOGGED_IN) {
            echo USER_NAME;
        } ?>"><br/>
        <br/>
        <input style="font-family:Comic sans ms;" type="password" name="pwd" placeholder="*****" class="biginput" value=""><br/>
        <br/>
        <input style="font-family:Comic sans ms;" type="submit" class="biginput" value="Entrar">
        <input style="font-family:Comic sans ms;" type="button" onClick="document.location = '/';" class="biginput"
               value="Voltar ao hotel">

    </form>

    <?php

    if (isset($_SESSION['HK_LOGIN_ERROR'])) {
        echo '<b style="color: darkred;">' . $_SESSION['HK_LOGIN_ERROR'] . '</b>';
        unset($_SESSION['HK_LOGIN_ERROR']);
    }

    ?>

    <?php if (LOGGED_IN) { ?>
        <p>
            <font color="#FFFFFF" face="Comic Sans MS">Está logado como: <b><?php echo USER_NAME; ?>
            </font></b>.
        </p>
    <?php } ?>

</div>

</body>
</html>