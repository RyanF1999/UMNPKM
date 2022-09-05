<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class ProfilTable {
    public $foto;
    public $nama;
    public $jabatan;

    public function  __construct($foto, $nama, $jabatan) {
        $this->foto = $foto;
        $this->nama = $nama;
        $this->jabatan = $jabatan;
    }
}

class ProfilTableWidget extends Widget
{
    // items contain
    // foto, nama, jabatan
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
        $i = 1;
        foreach($this->items as $item) {
            // konten profil table secara berurut adalah
            // foto, nama, jabatan
            echo "<tr>";
                echo "<th scope='row'>{$i}</th>";
                echo "<td><img class='profiltableimg' src='{$item->foto}'/></td>";
                echo "<td>{$item->nama}</td>";
                echo "<td>{$item->jabatan}</td>";
            echo "</tr>";

            $i += 1;
        }
    }
}

?>