<?php

class uberCore
{
    public $config;
    public $execStart;

    public function __construct()
    {
        $this->execStart = microtime(true);
    }


    public static function CheckCookies()
    {
        if (LOGGED_IN) {
            return;
        }

        if (isset($_COOKIE['rememberme']) && $_COOKIE['rememberme'] == "true" && isset($_COOKIE['rememberme_token']) && isset($_COOKIE['rememberme_name'])) {
            $name = filter($_COOKIE['rememberme_name']);
            $token = filter($_COOKIE['rememberme_token']);
            $find = db::query("SELECT id,username FROM users WHERE username = '" . $name . "' AND password = '" . $token . "' LIMIT 1");

            if ($find->rowCount() > 0) {
                $data = $find->fetch(2);

                $_SESSION['UBER_USER_N'] = $data['username'];
                $_SESSION['UBER_USER_H'] = $token;
                $_SESSION['set_cookies'] = true;

                header("Location: " . WWW . "/security_check");
                exit;
            }
        }
    }

    public static function FormatDate()
    {
        return date('j F Y, h:i:s A');
    }

    public static function GenerateTicket($seed = ''): string
    {
        $ticket = "ST-";
        $ticket .= sha1($seed . 'UberCMS' . random_int(118, 283));
        $ticket .= '-' . random_int(100, 255);
        $ticket .= '-uber-fe' . random_int(0, 5);

        return $ticket;
    }

    public static function FilterInputString($strInput = ''): string
    {
        return stripslashes(trim($strInput));
    }

    public static function FilterSpecialChars($strInput, $allowLB = false)
    {
        $strInput = str_replace(array(chr(1), chr(2), chr(3), chr(9)), ' ', $strInput);

        if (!$allowLB) {
            $strInput = str_replace(chr(13), ' ', $strInput);
        }

        return $strInput;
    }

    public static function CleanStringForOutput($strInput = '', $ignoreHtml = false, $nl2br = false): string
    {
        $strInput = stripslashes(trim($strInput));

        if (!$ignoreHtml) {
            $strInput = htmlentities($strInput);
        }

        if ($nl2br) {
            $strInput = nl2br($strInput);
        }

        return $strInput;
    }

    public static function GetSystemStatusStringg($statsFig)
    {
        switch (self::GetSystemStatus()) {
            case 2:
            case 0:
                return 'O Hotel está offline.';
            case 1:
                if (!$statsFig) {
                    return self::GetUsersOnline() . ' usuário(s) online';
                }

                return '<span class="stats-fig">' . self::GetUsersOnline() . '</span> usuários online.';

            default:

                return "Unknown";
        }
    }

    public static function GetSystemStatus()
    {
        return (int)Db::DoQuery('SELECT status FROM server_status LIMIT 1')->fetchColumn();
    }

    public static function GetUsersOnline()
    {
        return (int)Db::DoQuery('SELECT users_online FROM server_status LIMIT 1')->fetchColumn();
    }

    public static function GetSystemStatusString($statsFig)
    {
        switch (self::getSystemStatus()) {
            case 2:
            case 0:

                return "O Hotel est� offline.";

            case 1:

                if (!$statsFig) {
                    return self::GetUsersOnline() . ' user(s) online';
                } else {
                    return '<span class="stats-fig">' . self::GetUsersOnline() . '</span> usuarios conectados.';
                }

            default:

                return "Unknown";
        }
    }

    public static function GetMaintenanceStatus()
    {
        return false;
    }

    public static function AddBan($type, $value, $reason, $expireTime, $addedBy, $blockAppeal)
    {
        db::query("INSERT INTO bans (id,bantype,value,reason,expire,added_by,added_date,appeal_state) VALUES (NULL,'" . $type . "','" . $value . "','" . $reason . "','" . $expireTime . "','" . $addedBy . "','" . date('d/m/Y H:i') . "','" . (($blockAppeal) ? '0' : '1') . "')");
    }

    public static function fixText($str, $quotes = true, $clean = false, $ltgt = false, $transform = false, $guestbook = false)
    {
        $str = str_replace("&Acirc;", "�", $str);
        $str = str_replace("¡", "�", $str);
        $str = str_replace("¿", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("ñ", "�", $str);
        $str = str_replace("�?", "�", $str);
        $str = str_replace("á", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("é", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("ó", "�", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace("ú", "�", $str);
        $str = str_replace("�?", "�", $str);
        $str = str_replace("ä", "�", $str);
        $str = str_replace("�", "", $str);
        $str = str_replace("�", "�", $str);
        $str = str_replace(")", "&#x29;", $str);
        $str = str_replace("(", "&#x28;", $str);
        $str = str_replace("¥", "�", $str);
        $str = str_replace("\\\\r\\\\n", "<br />", $str);
        $str = str_replace("\\\\\\\\r\\\\\\\\n", "<br />", $str);
        $str = str_replace("\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\'", "&apos;", $str);
        $str = str_replace("\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\&quot;", "&#x22;", $str);
        $str = str_replace("\'", "'", $str);
        $str = str_replace('\"', '"', $str);
        $str = str_replace("\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\"", "&#x22;", $str);
        $str = str_replace("\\\\\\\\\\\\\\\\r\\\\\\\\\\\\\\\\n", "<br />", $str);
        $str = str_replace('\\\\n', "<br />", $str);
        $str = str_replace('\\\\\\\\\\\\"', '"', $str);
        $str = str_replace('\\\\r\\\\n', "<br />", $str);
        $str = str_replace('\\\\\\\\r\\\\\\\\n', "<br />", $str);
        $str = str_replace('\r\n', "<br />", $str);
        $str = str_replace('\\', "", $str);

        if ($quotes) {
            $str = str_replace('"', "&#x22;", $str);
            $str = str_replace("'", "&apos;", $str);
        }


        if ($clean) {
            $str = str_replace(["�", "�", '�', "�", "�", "�", "�", "�", "�", "�", "�", "�"], array("N", "n", "A", "a", "E", "e", "O", "o", "U", "u", "I", "i"), $str);
        }

        if ($ltgt) {
            $str = str_replace(["<", ">"], array("&lt;", "&gt;"), $str);
        }

        if ($transform) {
            $str = str_replace("'", '"', $str);
        }

        if ($guestbook) {
            $str = str_replace(["&lt;br /&gt;", "&lt;b&gt;", "&lt;/b&gt;", "&lt;u&gt;", "&lt;/u&gt;", "&lt;i&gt;", "&lt;/i&gt;", "&lt;/i&gt;"], array('<br />', '<b>', '</b>', '<u>', '</u>', '<i>', '</i>', '<br />'), $str);
            $str = preg_replace("/\&lt;a href=\"(.*?)\"\&gt;(.*?)\&lt;\/a&gt;/is", "<a href=\"$1\" target=\"_blank\">$2</a>", $str);
            $str = preg_replace("/\&lt;div class=\"bbcode-quote\"\&gt;(.*?)\&lt;\/div&gt;/is", "<div class=\"bbcode-quote\">$1</div>", $str);
            $str = preg_replace("/\&lt;span style=\"(.*?)\"\&gt;(.*?)\&lt;\/span&gt;/is", '<span style="$1">$2</span>', $str);
            $str = preg_replace("/\&lt;span style=\"font-size: 14px\"\&gt;(.*?)\&lt;\/span&gt;/is", "<span style=\"font-size: 14px\">$1</span>", $str);
        }


        return $str;
    }

    public static function CheckComment($comment = '')
    {
        $comment = strtolower($comment);

        $denied = array(
            'puto',
            'puta',
            'mierda',
            'aaaaaaaaaaaaaaaaaaaaaaaa',
            'cabrones',
            'http',
            '.com',
            '.org',
            '.net',
            '.info'
        ); //partes de comentarios denegados
        $allowed = array(
            'youtube',
            'facebook',
            'xukys',
            'google'
        ); //Partes de comentarios aceptados por ejemplo: Si el usuario escribe youtube.com se acepta el comentario. - Todos los comentarios que no est�n aceptados ni denegados ser�n aceptados

        foreach ($denied as $deny) {
            if (strstr($comment, $deny)) {
                foreach ($allowed as $allow) {
                    if (strstr($comment, $allow)) {
                        return true;
                    }
                }

                //A�adir banneo, y no proceder con el comentario.
                self::AddPermBan('user', $_SESSION['UBER_USER_N'], $comment);
                return false;
            }

        }

        return true;
    }

    public static function GenRandom()
    {
        return substr(md5(uniqid(mt_rand(), true)), 0, 15);
    }

    public static function BBcode($texto)
    {
        $texto = htmlentities($texto);
        $a = array(
            "/\[i\](.*?)\[\/i\]/is",
            "/\[b\](.*?)\[\/b\]/is",
            "/\[u\](.*?)\[\/u\]/is",
            "/\[quote\](.*?)\[\/quote\]/is",
            "/\[url=(.*?)\](.*?)\[\/url\]/is",
            "/\[color=red\](.*?)\[\/color\]/is",
            "/\[color=orange\](.*?)\[\/color\]/is",
            "/\[color=yellow\](.*?)\[\/color\]/is",
            "/\[color=green\](.*?)\[\/color\]/is",
            "/\[color=cyan\](.*?)\[\/color\]/is",
            "/\[color=blue\](.*?)\[\/color\]/is",
            "/\[color=gray\](.*?)\[\/color\]/is",
            "/\[color=black\](.*?)\[\/color\]/is",
            "/\[size=large\](.*?)\[\/size\]/is",
            "/\[size=small\](.*?)\[\/size\]/is"
        );
        $b = array(
            "<i>$1</i>",
            "<b>$1</b>",
            "<u>$1</u>",
            "<div class=\"bbcode-quote\">$1</div>",
            "<a href=\"$1\" target=\"_blank\">$2</a>",
            "<span style=\"color: #d80000\">$1</span>",
            "<span style=\"color: #fe6301\">$1</span>",
            "<span style=\"color: #ffce00\">$1</span>",
            "<span style=\"color: #6cc800\">$1</span>",
            "<span style=\"color: #00c6c4\">$1</span>",
            "<span style=\"color: #0070d7\">$1</span>",
            "<span style=\"color: #828282\">$1</span>",
            "<span style=\"color: #000000\">$1</span>",
            "<span style=\"font-size: 14px\">$1</span>",
            "<span style=\"font-size: 9px\">$1</span>"
        );
        $texto = preg_replace($a, $b, $texto);
        $texto = nl2br($texto);
        return $texto;
    }

    public static function GenerateRandom($length = 0, $letters = true, $numbers = false, $other = false)
    {
        $data = "";
        $possible = "";
        $i = 0;

        if ($letters) {
            $possible .= "abcdefhijkl";
        }

        if ($numbers) {
            $possible .= "0123456789";
        }

        if ($other) {
            $possible .= "ABCDEFHIJKL@%&^*/(){}";
        }

        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            $data .= $char;
            $i++;
        }
        return $data;
    }

    public function UberHash($input = '')
    {
        return $input;
    }

    public function ParseConfig()
    {
        $configPath = INCLUDES . 'inc.config.php';

        if (!file_exists($configPath)) {
            static::SystemError('Setting error', 'File not found in' . $configPath);
        }

        global $config;
        require_once $configPath;

        $this->config = $config;

        define('WWW', $this->config['Site']['www']);
        define('path', $this->config['Site']['www']);
    }

    public static function SystemError($title, $text): void
    {
        echo '<title>System Error.</title>';
        echo '<div style="width: 80%; padding: 15px 15px 15px 15px; margin: 50px auto; background-color: #FF0000; font-family: verdana; font-size: 12px; color: #000000; border: 1px solid #FF0000;">';
        echo '<br><div style="text-align: center;"><b>' . $title . '</b><br /></div>';
        echo '<div style="text-align: center;">&nbsp;' . $text;
        echo '</b><hr size="1" style="width: 100%; margin: 15px 0px 15px 0px;" /></center>';
        echo '<div style="font-family: verdana; text-align: center;">Error directory: <b>/nucleo/tpl/</b></div><br>';
        echo '</div>';
        exit;
    }

    public function Mus($header, $data = '')
    {
        if ($this->config['MUS']['enabled'] == false || self::GetSystemStatus() == "0") {
            return;
        }

        $musData = $header . chr(1) . $data;

        $sock = socket_create(AF_INET, SOCK_STREAM, getprotobyname('tcp'));
        socket_connect($sock, $this->config['MUS']['ip'], (int)$this->config['MUS']['port']);
        socket_send($sock, $musData, strlen($musData), MSG_DONTROUTE);
        socket_close($sock);
    }
}


?>