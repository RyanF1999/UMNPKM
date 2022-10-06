<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class PkmYearItemWidget extends Widget
{
    // items contain
    // year
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
            $url = Url::to(['listpkm', 'year' => $item]);
            
            // print array of year
            echo "<div class='card card-body mb-2'>";
                echo "<a href='{$url}'>{$item}</a>";
            echo "</div>";
        }
    }
}

?>