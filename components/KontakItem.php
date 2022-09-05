<?php

namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;

class KontakItem {
    public $kategori;
    public $nama;
    public $email;

    public function  __construct($kategori, $nama, $email) {
        $this->kategori = $kategori;
        $this->nama = $nama;
        $this->email = $email;
    }
}

class KontakItemWidget extends Widget
{
    // items contain
    // kategori, nama, wa, email
    // wa adalah nomor hp
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
            // konten kontak item secara berurut adalah
            // nomor urutan, kategori/jabatan, nama, no hp/wa, email
            echo "<tr>";
                echo "<th scope='row'>{$i}</th>";
                echo "<td>{$item->kategori}</td>";
                echo "<td>{$item->nama}</td>";
                echo "<td>{$item->email}</td>";
            echo "</tr>";

            $i += 1;
        }
    }
}

?>