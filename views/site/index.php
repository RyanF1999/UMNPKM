<?php

/** @var yii\web\View $this */
use yii\bootstrap4\Carousel;
use app\components\BlogItemWidget;

$this->title = 'Home';
?>

<div class="d-flex justify-content-center">
    <?php
        function convertToImg($v) {
            return "<img src='{$v}'/>";
        }

        echo Carousel::widget([
            'items' => array_map("convertToImg", $carousel)
        ]);
    ?>
</div>

<div class="container">
    <div class="row">
        <div class="col-9">
            <h2>Kegiatan PKM</h2>
            <div class="element" data-config='{ "type": "list", "limit": 3, "element": "div", "more": "↓ show more", "less": "↑ less", "number": true }'>
            <?php
                // render widget BlogItem for acara
                echo BlogItemWidget::widget(['items' => $kegiatan]);
            ?>
            </div>

            <h2>Pengumuman</h2>
            <div class="element" data-config='{ "type": "list", "limit": 3, "element": "div", "more": "↓ show more", "less": "↑ less", "number": true }'>
            <?php
                // render widget BlogItem for pengumuman
                echo BlogItemWidget::widget(['items' => $pengumuman]);
            ?>
            </div>
        </div>
        <div class="col">
            <h2>List PKM</h2>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/tomik23/show-more@1.1.5/dist/js/showMore.min.js"></script>
<script>
    new ShowMore('.element');
</script>