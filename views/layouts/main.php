<?php

use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="bg-main"></div>
<div id="fx-background" class="active bg-image"></div>
<div class="bg-image2"></div>
<div id="slide-top"><i class="fas fa-arrow-up"></i></div>

<!-- main content -->
<div id="main">
    <div class="wrap container">

        <!-- header -->
        <div class="navbar">
            <ul>
                <li class="item-link"><?= Html::a('Главная', ['/'], ['class' => 'main-link']) ?></li>
                <li class="item-link"><?= Html::a('Товары', ['/site/products'], ['class' => 'main-link']) ?></li>
                <li class="item-link"><?= Html::a('Услуги', ['/site/service'], ['class' => 'main-link']) ?></li>

                <?php if (Yii::$app->user->isGuest) { ?>

                    <li class="item-link"><?= Html::a('Авторизация', ['/site/login'], ['class' => 'main-link']) ?></li>

                <?php } else { ?>
                    <li class="item-link"><?= Html::a('Выход', ['/site/logout'], ['class' => 'main-link']) ?></li>
                <?php } ?>
            </ul>

            <?= Html::img('@web/images/logo-white.png', ['class' => 'logo-png', 'alt' => 'Logo']) ?>

            <a class="record" href="">Онлайн запись</a>
        </div>
    </div>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        </div>
    </footer>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
