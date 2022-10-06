<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use app\components\PkmItemWidget;

$this->title = 'List PKM';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <table class="table">
        <thead class="thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pelaksana PKM</th>
                <th scope="col">Judul</th>
            </tr>
        </thead>
        <tbody>
            <?php
                echo PkmItemWidget::widget(['items' => $list])
            ?>
        </tbody>
    </table>
</div>