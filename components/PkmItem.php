<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class PkmItem {
    public $no;
    public $pelaksana;
    public $judul;

    public function  __construct($no, $pelaksana, $judul) {
        $this->no = $no;
        $this->pelaksana = $pelaksana;
        $this->judul = $judul;
    }
}

class PkmItemWidget extends Widget
{
    // items contain
    // no, pelaksana, judul
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
            // nomor urutan, pelaksana pkm, judul
            echo "<tr>";
                echo "<th scope='row'>{$item->no}</th>";
                echo "<td>{$item->pelaksana}</td>";
                echo "<td>{$item->judul}</td>";
            echo "</tr>";
        }
    }
}

?>