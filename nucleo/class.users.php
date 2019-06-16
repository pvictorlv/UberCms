<?php

class uberUsers
{
    private $blockedNames = Array('roy', 'meth0d', 'method', 'graph1x', 'graphix', 'admin', 'administrator',
        'mod', 'moderator', 'guest', 'undefined');
    private $blockedNameParts = Array('moderate', 'staff', 'manage', 'system', 'admin', 'uber');

    /**************************************************************************************************/

    public static function IsUserBanned($name)
    {
        if (uberUsers::GetBan('user', $name, true) != null) {
            return true;
        }

        return false;
    }

    public static function GetBan($type, $value, $mustNotBeExpired = false)
    {
        $q = "SELECT * FROM bans WHERE bantype = '" . $type . "' AND value = '" . $value . "' ";

        if ($mustNotBeExpired) {
            $q .= "AND expire > " . time() . " ";
        }

        $q .= "LIMIT 1";

        $get = Db::query($q)->fetch(2);

        if (!$get) {
            return null;
        }
        return $get;
    }

    public static function IsIpBanned($ip)
    {
        return self::GetBan('ip', $ip, true) !== null;
    }

    public static function GetUserTags($userId)
    {
        $tagsArray = Array();
        $data = Db::query("SELECT id,tag FROM user_tags WHERE user_id = '" . $userId . "'");

        while ($tag = $data->fetch(2)) {
            $tagsArray[$tag['id']] = $tag['tag'];
        }

        return $tagsArray;
    }

    public static function Is_Online($userId)
    {
        $result = Db::query("SELECT `online` FROM `users` WHERE `id` = ? LIMIT 1", $userId);
        return $result->fetchColumn();
    }

    public static function haveWidget($Id, $var)
    {
        $check = Db::query("SELECT id FROM homes_items WHERE data = '" . $var . "' AND owner_id = '" . $Id . "' LIMIT 1")->rowCount();

        if ($check > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function IsValidEmail($email = '')
    {
        if (Db::query("SELECT count(id) FROM users WHERE mail = ? LIMIT 1", $email)->fetchColumn())
            return true;

        return preg_match("/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i", $email);
    }

    public function IsUserOnline($id)
    {
        return $this->GetUserVar($id, 'online') == '1';
    }

    /**************************************************************************************************/

    public function GetUserVar($id, $var, $allowCache = true)
    {
        if ($allowCache && isset($_SESSION["user_$id"][$var])) {
            return $_SESSION["user_$id"][$var];
        }
        $val = Db::query("SELECT $var FROM users WHERE id = ? LIMIT 1", $id)->fetchColumn();
        $_SESSION["user_$id"][$var] = $val;
        return $val;
    }

    public function IsValidName($nm = ''): bool
    {
        return $nm !== '' && preg_match('/^[a-z0-9]+$/i', $nm) && strlen($nm) <= 32;
    }

    /**************************************************************************************************/

    public function IsValidPassword($pass1 = ''): bool
    {
        return $pass1 !== '' && strlen($pass1) <= 32;
    }

    public function IsNameTaken($nm = ''): bool
    {
        return Db::query("SELECT count(id) FROM users WHERE username = ? LIMIT 1", $nm)->fetchColumn() > 0;
    }

    public function IsEmailTaken($nm = '')
    {
        return ((mysql_rowCount()(Db::query("SELECT NULL FROM users WHERE mail = '" . $nm . "' LIMIT 1")) > 0) ? true : false);
    }

    /**************************************************************************************************/

    public function IdExists($id = 0)
    {
        return Db::query("SELECT NULL FROM users WHERE id = '" . $id . "' LIMIT 1")->rowCount() > 0;
    }

    public function IsNameBlocked($nm = '')
    {
        foreach ($this->blockedNames as $bl) {
            if (strtolower($nm) == strtolower($bl)) {
                return true;
            }
        }

        foreach ($this->blockedNameParts as $bl) {
            if (strpos(strtolower($nm), strtolower($bl)) !== false) {
                return true;
            }
        }

        return false;
    }

    public function Add($username = '', $passwordHash = '', $email = 'default@localhost', $rank = 1, $figure = '', $sex = 'M', $real = null)
    {
        if ($real == null) $real = $username;
        Db::query('INSERT INTO users (username,real_name,password,mail,rank,look,gender,account_created) VALUES (?,?,?,?,?,?,?,?)', $username, $real, $passwordHash, $email, $rank, $figure, $sex, date('d-M-Y'));

        $id = Db::GetId();

        Db::query("INSERT INTO user_info (user_id,bans,cautions,reg_timestamp,login_timestamp,cfhs,cfhs_abusive) VALUES (?,'0','0','" . time() . "','" . time() . "','0','0')", $id);

        return $id;
    }

    /**************************************************************************************************/

    public function Name2id($username = '')
    {
        return (int)Db::query("SELECT id FROM users WHERE username = ? LIMIT 1", $username)->fetchColumn();
    }

    public function Delete($id)
    {
        Db::query("DELETE FROM messenger_friendships WHERE user_one_id = '" . $id . "' OR user_two_id = '" . $id . "'");
        Db::query("DELETE FROM messenger_requests WHERE to_id = '" . $id . "' OR from_id = '" . $id . "'");
        Db::query("DELETE FROM users WHERE id = '" . $id . "' LIMIT 1");
        Db::query("DELETE FROM user_subscriptions WHERE user_id = '" . $id . "'");
        Db::query("DELETE FROM user_info WHERE user_id = '" . $id . "' LIMIT 1");
        Db::query("DELETE FROM user_items WHERE user_id = '" . $id . "'");
    }

    public function ValidateLogin($user_mail, $password)
    {
        if ($user = $this->ValidateUser($user_mail, $password))
            return array(1, 0, 1);
        else if ($emails = $this->ValidateUserByEmail($user_mail, $password))
            return array(1, 1, $emails);
        else
            return array(0, null, null);
    }

    // do not remove - still used in hk

    public function ValidateUser($username, $password)
    {
        return Db::query("SELECT count(id) FROM users WHERE username =? AND password = ? LIMIT 1", $username, $password)->fetchColumn() > 0;
    }
    // do not remove - still used in hk

    /**************************************************************************************************/

    public function ValidateUserByEmail($email, $password)
    {
        return Db::query("SELECT NULL FROM users WHERE mail = '" . $email . "' AND password = '" . $password . "' LIMIT 1")->rowCount();
    }

    public function Id2name($id = -1)
    {
        if (isset($_SESSION["user_$id"]['username'])) {
            return $_SESSION["user_$id"]['username'];
        }

        $name = Db::query("SELECT username FROM users WHERE id = ? LIMIT 1", $id)->fetchColumn();
        $_SESSION["user_$id"]['username'] = $name;
        return $name;
    }

    public function Email2id($email = '')
    {
        return (int)Db::query("SELECT id FROM users WHERE mail = ? LIMIT 1", $email)->fetchColumn();
    }

    public function CacheUser($id)
    {
        $data = Db::query("SELECT username,credits,activity_points,rank,motto,last_online FROM users WHERE id = ? LIMIT 1", $id)->fetch(2);

        foreach ($data as $key => $value) {
            if (!isset($_SESSION["user_$id"][$key]))
                $_SESSION["user_$id"][$key] = $value;
        }
    }

    public function SetUserVar($id, $var, $value): void
    {
        Db::query("UPDATE users SET $var = ? WHERE id = ? LIMIT 1", $value, $id);
        $_SESSION["user_$id"][$var] = $value;
    }

    /**************************************************************************************************/

    public function formatUsername($id, $link = true, $styles = true): string
    {
        $data = Db::query('SELECT id,`rank`,username FROM users WHERE id = ? LIMIT 1', $id)->fetch(2);

        if (!$data) {
            return '<s>Usuario Desconhecido</s>';
        }
        $prefix = '';
        $name = $data['username'];
        $suffix = '';

        if ($link) {
            $prefix .= '<a href="/home/' . clean($data['username']) . '">';
            $suffix .= '</a>';
        }

        if ($styles) {

            $rankData = Db::query('SELECT prefix,suffix FROM ranks WHERE id = ? LIMIT 1', $data['rank']);

            if ($rankData) {
                $prefix .= $rankData['prefix'];
                $suffix .= $rankData['suffix'];
            }
        }

        return clean($prefix . $name . $suffix, true);
    }

    /**************************************************************************************************/

    public function getRankName($rankId)
    {
        return $this->getRankVar($rankId, 'name');
    }

    public function getRankVar($rankId, $var)
    {
        return Db::query("SELECT " . $var . " FROM ranks WHERE id = ? LIMIT 1", $rankId)->fetchColumn();
    }

    /**************************************************************************************************/

    public function hasFuse($id, $fuse)
    {
        return Db::query('SELECT count(rank) FROM fuserights WHERE rank <= ? AND fuse = ? LIMIT 1',
                $this->getRank($id), $fuse)->fetchColumn() > 0;
    }

    public function getRank($id)
    {
        if (isset($_SESSION["user_$id"]['rank'])) {
            return $_SESSION["user_$id"]['rank'];
        }

        $rankId = Db::query("SELECT rank FROM users WHERE id = ? LIMIT 1", $id)->fetchColumn();
        $_SESSION["user_$id"]['rank'] = $rankId;
        return $rankId;
    }

    public function GetFriendRequests($id)
    {
        $amount = Db::query("SELECT count(id) FROM messenger_requests WHERE `to_id` = ?", $id)->fetchColumn();
        return $amount > 0;

    }

    public function GetFriendCount($id, $onlineOnly = false)
    {
        $i = 0;
        $q = Db::query("SELECT user_two_id FROM messenger_friendships WHERE user_one_id = ?", $id);

        while ($friend = $q->fetch(2)) {
            if (!$onlineOnly) {
                $i++;
            } else {
                $isOnline = Db::query("SELECT online FROM users WHERE id = ? LIMIT 1", $friend['user_two_id'])->fetchColumn();

                if ($isOnline == "1") {
                    $i++;
                }
            }
        }

        return $i;
    }

    public function CheckSSO($id)
    {
        Db::query("UPDATE users SET auth_ticket = '" . uberCore::GenerateTicket($this->getUserVar($id, 'username')) . "' WHERE id = '" . $id . "' LIMIT 1");

    }

    public function AddOrUpdateClub($id, $subID, $sec) // HC/VIP Subscription Function
    {
        $sql = Db::query("SELECT * FROM user_subscriptions WHERE user_id = '" . $id . "' LIMIT 1"); // Select Subscription

        $secInit = 1310696790; // Beginning Of Subscription
        $secEnd = 1313288790; // End Of Subscription

        if (mysql_rowCount()($sql) > 0) {
            $data = mysql_fetch_assoc($sql); // Mysql Data
            $sec = 1310696790; // Unix TimeStamp (The same from uberEmu)

            // Build new sistem Date Remaint

            Db::query("UPDATE user_subscriptions SET timestamp_expire =  '" . $secEnd . "', subscription_id = '" . $subID . "' WHERE user_id = '" . $id . "'  LIMIT 1");  // Renew Subscription -> Not Funcional but here's the example code.

            //Db::query("UPDATE users SET rank = '2' WHERE rank = '1' AND  id = '" . $id . "' LIMIT 1"); -> Maybe for buy VIP on uberCms?

        } else {
            Db::query("INSERT INTO user_subscriptions (user_id,timestamp_expire,timestamp_activated,subscription_id) VALUES ('" . $id . "','" . $secEnd . "','" . $secInit . "','" . $subID . "')"); // Insert Subscription buy into his table with her respective User and subscription data.
        }
    }

    public function giveCredits($id, $amount)
    {
        global $core;

        return $this->setCredits($id, ($this->getCredits($id) + $amount));
        $core->Mus('updateCredits:' . $id);
    }

    public function setCredits($id, $newAmount)
    {
        global $core;

        Db::query("UPDATE users SET credits = '" . $newAmount . "' WHERE id = '" . $id . "' LIMIT 1");
        $core->Mus('updateCredits:' . $id);
    }

    public function getCredits($id)
    {
        return $this->getUserVar($id, 'credits');
    }

    /**************************************************************************************************/

    public function takeCredits($id, $amount)
    {
        global $core;

        return $this->setCredits($id, ($this->getCredits($id) - $amount));
        $core->Mus('updateCredits:' . $id);
    }

    public function renderHabboImage($id, $size = 'b', $dir = 2, $head_dir = 3, $action = 'wlk', $gesture = 'sml')
    {
        $look = $this->getUserVar($id, 'look');

        return 'http://www.habbo.es/habbo-imaging/avatarimage?figure=' . $look . '&size=' . $size . '&action=' . $action . ',&gesture=' . $gesture . '&direction=' . $dir . '&head_direction=' . $head_dir;
    }

    public function getUserIP()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $ip = $_SERVER['REMOTE_ADDR'];

        if (isset($_SERVER['HTTP_CF_CONNECTING_IP']) && filter_var($_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP)) {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        }

        return $ip;
    }

    /**************************************************************************************************/

    public function hasVIP($id)
    {
        $sql = Db::query("SELECT activated FROM user_subscriptions WHERE subscription_id = 'club_habbo' AND user_id = '" . $id . "' LIMIT 1");

        if ($sql->rowCount() <= 0) {
            return 0;
        }
        $data = strtotime($sql->fetchColumn());
        $diff = $data - time();

        if ($diff <= 0) {
            return 0;
        }

        return ceil($diff / 86400);
    }

    /**************************************************************************************************/

    public function hasClub($id)
    {
        return $this->getClubDays($id) > 0;
    }

    public function getClubDays($id)
    {
        $row = Db::query("SELECT activated,months FROM user_subscriptions WHERE user_id = '" . $id . "' LIMIT 1")->fetch(2);

        if (!$row) {
            return 0;
        }
        $data = strtotime($row['activated']) + 2678400 * $row['months'];
        $diff = $data - time();

        if ($diff <= 0) {
            return 0;
        }

        return ceil($diff / 86400);
    }

    public function EatCredits(int $id, int $credits, bool $restar = true)
    {
        if ($restar) {
            Db::query("UPDATE users SET credits = credits - " . $credits . " WHERE id = '" . $id . "' LIMIT 1");
        } else {
            Db::query("UPDATE users SET credits = " . $credits . " WHERE id = '" . $id . "' LIMIT 1");
        }
        return true;
    }

}


?>