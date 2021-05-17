<?php

use yii\helpers\Html;
use app\assets\AppAsset;

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
<div class="admin-basic">
    <div class="left-navbar">
        <p class="text-admin-panel h3">Админ панель</p>
        <ul>
            <li class=""><?= Html::a('Главная', ['/admin'], ['class' => '']) ?></li>
            <li class=""><?= Html::a('Продукция', [''], ['class' => '']) ?></li>
            <li class=""><?= Html::a('Сотрудники', [''], ['class' => '']) ?></li>
        </ul>
    </div>

    <div class="content-admin">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
<?php $this->endPage() ?>

