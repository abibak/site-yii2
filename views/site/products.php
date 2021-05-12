<?php

use yii\helpers\Html;

$this->title = 'Товары';
?>

<style>
    #main {
        background: none #e0e0d8;
    }

    .navbar ul li a {
        color: #000;
    }

    .navbar ul li .main-link:hover {
        color: #828282;
    }
</style>

<div class="site-products">
    <p class="title"><?= $this->title ?></p>

    <div class="section-products">

        <?php foreach ($products as $element): ?>
            <div class="products-block" data-id-product="<?= $element['id'] ?>">
                <?= Html::img('@web/images/' . $element['image'], ['class' => 'img-product', 'alt' => 'logo product']) ?>
                <p class="name-products"><?= $element['name'] ?></p>
                <p class="description"><span><?= $element['description'] ?></span></p>
                <p class="price"><?= $element['price'] ?> Р.</p>

                <a class="add-cart" href="#"><span>в корзину</span></a>
            </div>
        <?php endforeach; ?>

    </div>
</div>
