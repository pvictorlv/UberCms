<?php

class HomesManager
{
    public static function HomeExists($linkType, $linkId): bool
    {
        return db::query("SELECT NULL FROM homes WHERE link_type = '" . strtolower($linkType) . "' AND link_id = ? LIMIT 1", $linkId)->rowCount() > 0;
    }

    public static function GetHomeId($linkType, $linkId)
    {
        if (!self::HomeExists($linkType, $linkId)) {
            return 0;
        }

        return (int)db::query("SELECT home_id FROM homes WHERE link_type = '" . strtolower($linkType) . "' AND link_id = ? LIMIT 1", $linkId)->fetchColumn();
    }

    public static function CreateHome($linkType, $linkId)
    {
        db::query("INSERT INTO homes (home_id,link_type,link_id,allow_display) VALUES (?,?,?,'1')",
            $linkId, strtolower($linkType), $linkId);

        $homeId = self::GetHomeId($linkType, $linkId);
        $home = self::GetHome($homeId);
        if ($home === null) {
            return;
        }

        $home->AddItem('widget', 463, 39, 1, 'ProfileWidget', 'w_skin_defaultskin', $linkId);
        $home->AddItem('stickie', 42, 48, 2, 'Olá e bem-vindo a sua Habbo Home. Para começar, clique em Editar. Lá você vai encontrar o seu inventário e o catálogo. O inventário lista todos os elementos que podem ser colocados na sua página, incluindo etiquetas, fundos e widgets. O catálogo é onde você pode comprar novos itens. Verifique regularmente para encontrar novos itens.', 'n_skin_noteitskin', $linkId);
        $home->AddItem('sticker', 593, 11, 4, 's_sticker_arrow_down', '', $linkId);
        $home->AddItem('sticker', 252, 12, 5, 's_paper_clip_1', '', $linkId);
        $home->AddItem('sticker', 341, 353, 6, 's_sticker_spaceduck', '', $linkId);
        $home->AddItem('sticker', 27, 32, 7, 's_needle_3', '', $linkId);

    }

    public static function GetHomeDataRow($id)
    {
        return db::query("SELECT * FROM homes WHERE home_id = ? LIMIT 1", $id)->fetch(2);
    }

    public static function GetHome($id)
    {
        $data = self::GetHomeDataRow($id);

        if ($data === null) {
            return null;
        }

        return new Home($data['home_id'], $data['link_type'], $data['link_id']);
    }
}

class Home
{
    public $id = 0;
    public $linkType = '';
    public $linkId = 0;

    public function __construct($id, $linkType, $linkId)
    {
        $this->id = $id;
        $this->linkType = $linkType;
        $this->linkId = $linkId;
    }

    public function AddItem($type, $x, $y, $z, $data, $skin, $ownerId)
    {
        db::query('INSERT INTO homes_items (home_id,type,x,y,z,data,skin,owner_id) VALUES (?,?,?,?,?,?,?,?)',
        $this->id, $type, $x, $y, $z, $data, $skin, $ownerId);
    }

    public function GetItems($id = false)
    {
        if (!$id) {
            $list = Array();
            $get = db::query('SELECT * FROM homes_items WHERE home_id = ? ORDER BY type ASC', $this->id);

            while ($item = $get->fetch(2)) {
                $list[] = new HomeItem($item['id'], $item['home_id'], $item['type'], $item['data'], $item['skin'], $item['x'], $item['y'], $item['z'], $item['owner_id']);
            }
        } else {
            $get = db::query("SELECT * FROM homes_items WHERE id = ? LIMIT 1", $id);

            $item = $get->fetch(2);

            $list = new HomeItem($item['id'], $item['home_id'], $item['type'], $item['data'], $item['skin'], $item['x'], $item['y'], $item['z'], $item['owner_id']);

        }
        return $list;
    }


}

class HomeItem
{
    public $id = 0;
    public $homeId = 0;

    public $type = '';
    public $data = '';
    public $skin = '';

    public $x = 0;
    public $y = 0;
    public $z = 0;

    public $ownerId = 0;

    public function __construct($id, $homeId, $type, $data, $skin, $x, $y, $z, $ownerId)
    {
        $this->id = $id;
        $this->homeId = $homeId;
        $this->type = $type;
        $this->data = $data;
        $this->skin = $skin;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->ownerId = $ownerId;
    }

    public function GetHome()
    {
        return HomesManager::GetHome($this->homeId);
    }

    public static function UpdateItem($skinId, $stickieId)
    {

        db::query("UPDATE homes_items SET skin = ? WHERE id = ?", $skinId, $stickieId);

        $sql = db::query("SELECT * FROM homes_items WHERE id = ?", $stickieId);
        $item = $sql->fetch(2);
        $list = new HomeItem($item['id'], $item['home_id'], $item['type'], $item['data'], $item['skin'], $item['x'], $item['y'], $item['z'], $item['owner_id']);

        return $list->GetHtml();
    }

    public function GetHtml()
    {
        switch ($this->type) {
            case 'widget':

                $widget = null;

                switch (strtolower($this->data)) {
                    case 'profilewidget':
                        $widget = new Template('widget-profile');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                    case 'guestbookwidget':
                        $widget = new Template('widget-GuestbookWidget');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                    case 'badgeswidget':
                        $widget = new Template('widget-BadgesWidget');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                    case 'traxplayerwidget':
                        $widget = new Template('widget-TraxPlayerWidget');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                    case 'roomswidget':
                        $widget = new Template('widget-RoomsWidget');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                    case 'friendswidget':
                        $widget = new Template('widget-FriendsWidget');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                    case 'ratingwidget':
                        $widget = new Template('widget-RatingWidget');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                    case 'groupswidget':
                        $widget = new Template('widget-GroupsWidget');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                    default:
                        $widget = new Template('widget-Workingonit');
                        $widget->SetParam('user_id', $this->GetHome()->linkId);
                        break;
                }

                $widget->SetParam('id', $this->id);
                $widget->SetParam('pos-x', $this->x);
                $widget->SetParam('pos-y', $this->y);
                $widget->SetParam('pos-z', $this->z);
                $widget->SetParam('skin', $this->skin);

                return $widget->GetHtml();
            case 'stickie':
                $editimg = '';
                if (isset($_SESSION['startSessionEditHome'])) {
                    if ($_SESSION['startSessionEditHome'] == $this->ownerId) {
                        $editimg = '<img src="' . WWW . '/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="' . $this->type . '-' . $this->id . '-edit">
<script type="text/javascript">
var editButtonCallback = function(e) { openEditMenu(e, ' . $this->id . ', "' . $this->type . '", "' . $this->type . '-' . $this->id . '-edit"); };
Event.observe("' . $this->type . '-' . $this->id . '-edit", "click", editButtonCallback);
Event.observe("' . $this->type . '-' . $this->id . '-edit", "editButton:click", editButtonCallback); 
</script>';
                    }
                }

                return '<div class="movable stickie ' . $this->skin . '-c" style="left: ' . $this->x . 'px; top: ' . $this->y . 'px; z-index: ' . $this->z . ';" id="stickie-' . $this->id . '"><div class="' . $this->skin . '" ><div class="stickie-header"><h3>' . $editimg . '</h3><div class="clear"></div></div><div class="stickie-body"><div class="stickie-content"><div class="stickie-markup">' . fixText(BBcode($this->data), false, false, true, false, true) . '</div><div class="stickie-footer"></div></div></div></div></div>';

            case 'sticker':
                $editimg = '';
                if (isset($_SESSION['startSessionEditHome'])) {
                    if ($_SESSION['startSessionEditHome'] == $this->ownerId) {
                        $editimg = '<img src="/web-gallery/images/myhabbo/icon_edit.gif" width="19" height="18" class="edit-button" id="sticker-' . $this->id . '-edit"><script type="text/javascript">var editButtonCallback = function(e) { openEditMenu(e, ' . $this->id . ', "sticker", "sticker-' . $this->id . '-edit"); };Event.observe("sticker-' . $this->id . '-edit", "click", editButtonCallback);Event.observe("sticker-' . $this->id . '-edit", "editButton:click", editButtonCallback); </script>';
                    }
                }
                return '<div class="movable sticker ' . clean($this->data) . '" style="left: ' . $this->x . 'px; top: ' . $this->y . 'px; z-index: ' . $this->z . ';" id="sticker-' . $this->id . '">' . $editimg . '</div>';
        }
        return null;
    }
}

?>