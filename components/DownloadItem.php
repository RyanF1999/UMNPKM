<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class DownloadItem {
    public $title;
    public $href;

    public function  __construct($title, $href) {
        $this->title = $title;
        $this->href = $href;
    }
}

class DownloadItemWidget extends Widget
{
    // items contain
    // title, href
    public $items;

    public function init()
    {
        parent::init();
        if ($this->items === null) {
            $this->items = [];
        }
    }

    public function run()
    {
        foreach($this->items as $item) {
            // print array of download berkas
            echo "<a href='{$item->href}' class='list-group-item list-group-item-action'>";
                echo $item->title;
            echo "</a>";
        }
    }
}

?>