<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use app\components\KontakItemWidget;

$this->title = 'Kontak';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <table class="table">
        <thead class="thead">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Kategori/Jabatan</th>
                <th scope="col">Nama</th>
                <th scope="col">E-Mail</th>
            </tr>
        </thead>
        <tbody>
            <?php
                echo KontakItemWidget::widget(['items' => $kontak])
            ?>
        </tbody>
    </table>
</div>