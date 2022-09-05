<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class BlogItem {
    public $title;
    public $deskripsi;
    public $img;

    public function  __construct($title, $deskripsi, $img) {
        $this->title = $title;
        $this->deskripsi = $deskripsi;
        $this->img = $img;
    }
}

class BlogItemWidget extends Widget
{
    // items contain
    // title, deskripsi, img
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
            // print card parent div
            echo '<div class="card mb-3">';

                // print row div
                echo '<div class="row no-gutters">';
                    // print col card body
                    echo '<div class="col-8 blogbody">';
                        echo "<h5 class='card-title blogtitle'>{$item->title}</h5>";
                        echo "<p class='card-text blogcontent'>{$item->deskripsi}</p>";
                    echo "</div>";

                    // print image col
                    echo '<div class="col-4 embed-responsive">';
                        echo "<img class='img-fluid blogimg' src='{$item->img}'/>";
                    echo "</div>";
                echo "</div>";
            
            echo "</div>";
        }
    }
}

?>