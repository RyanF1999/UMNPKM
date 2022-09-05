<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use app\components\DownloadItemWidget;

$this->title = 'Download';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <ul class="list-group">
        <li class="list-group-item active" aria-current="true">Download List</li>
        <?php
            echo DownloadItemWidget::widget(['items' => $berkas]);
        ?>
    </ul>
</div>