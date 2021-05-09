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
            <div class="products-block">
                <?= Html::img('@web/images/' . $element['image'], ['class' => 'img-product', 'alt' => 'logo product']) ?>
                <p class="name-products"><?= $element['title'] ?></p>
                <p class="description"><span><?= $element['description'] ?></span></p>
                <p class="price"><?= $element['price'] ?> р.</p>

                <a class="add-cart" href="#"><span>в корзину</span></a>
            </div>
        <?php endforeach; ?>

        <div class="products-block">
            <?= Html::img('@web/images/shampoo1.png', ['class' => 'img-product', 'alt' => 'logo product']) ?>
            <p class="name-products">Заголовок продукта</p>
            <p class="description"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi aperiam autem blanditiis commodi culpa deserunt distinctio dolorum eius exercitationem facere illum in laborum, maiores molestias mollitia nemo quae voluptatibus?</span>
            </p>
            <p class="price">500 р.</p>

            <a class="add-cart" href="#"><span>в корзину</span></a>
        </div>


        <div class="products-block">
            <?= Html::img('@web/images/shampoo2.png', ['class' => 'img-product', 'alt' => 'logo product']) ?>
            <p class="name-products">Заголовок продукта</p>
            <p class="description"><span>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab aliquam delectus eum ex exercitationem labore nobis obcaecati odio perferendis tenetur! Asperiores esse harum magnam magni nobis, omnis quia sint vero!</span>
            </p>
            <p class="price">500 р.</p>

            <a class="add-cart" href="#"><span>в корзину</span></a>
        </div>

    </div>
</div>
