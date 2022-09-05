<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use app\components\ProfilTableWidget;

$this->title = 'Profil';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <h2>Visi dan Misi</h2>
    <h5 class="profiltitle">Visi</h5>
    <p class="profilitem"><?php echo $visi; ?></p>

    <h5 class="profiltitle">Misi</h5>
    <ul style="list-style-type:disc;">
    <?php 
        function convertToList($v) {
            return "<li class='profilitem'>{$v}</li>";
        }

        $items = array_map("convertToList", $misi);
        foreach($items as $item) {
            echo $item; 
        }
    ?>
    </ul>

    <h2>Struktur Organisasi</h2>
    <img class="profilimg" src="<?php echo $img; ?>"/>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Foto</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
            </tr>
        </thead>
        <tbody>
            <?php
                echo ProfilTableWidget::widget(['items' => $table])
            ?>
        </tbody>
    </table>

    <!-- <h2>Tugas dan Fungsi</h2>
    <ul style="list-style-type:disc;">
    <?php
        $items = array_map("convertToList", $tugasfungsi);
        foreach($items as $item) {
            //echo $item; 
        } 
    ?>
    </ul>
    -->
</div>