<?php
$this->title = 'Услуги';
?>

<style>
    #main {
        background: none #333;
    }
</style>

<div class="site-service">
    <p class="title">Стоимость услуг</p>

    <div class="list-services">
        <div class="service-block">
            <?php foreach ($services as $service): ?>

                <p class="name-service"><?= $service['name']; ?> <span class="price-service"><?= $service['price']; ?></span></p>

            <?php endforeach; ?>
        </div>
    </div>

</div>
