<?php

use app\models\Employee;
use app\widgets\Alert;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;

$date = date("Y-m-d");
$last_day = date('Y-m-t');

$data_employees = Employee::find()->select('id, name, surname')->all();
$query = new yii\db\Query();
$data_services = $query->from(['e' => 'service_tariffs'])
    ->join('INNER JOIN', 'services', 'e.service_id = services.id')->all();

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

<!-- modal record -->
<div class="modal-record">
    <div class="record-online">
        <span>Запись онлайн <i class="fas fa-times close-modal"></i></span>
    </div>

    <div class="content-modal">
        <?php if (Yii::$app->user->isGuest) { ?>

            <p>Для того, чтобы записаться онлайн,
                нужно <?= Html::a('войти', '/site/login', ['class' => 'model-link-login']) ?> в аккаунт</p>

        <?php } else { ?>

            <p class="text-employee">Выбранный сотрудник</p>
            <div class="selected-master"></div>

            <div class="employee-selection">
                <p class="open-employees">Выберите сотрудника <i class="fas fa-chevron-down"></i></p>

                <div class="block-masters">
                    <?php foreach ($data_employees as $employee): ?>

                        <div class="master" data-master-id="<?= $employee['id'] ?>"
                             data-master-name="<?= $employee['name'] ?>">
                            <span class="name-master"><?= $employee['name'] . ' ' . $employee['surname'] ?></span>
                            <span class="prof">Мастер</span>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>

            <p class="selected-services">Выбранные услуги</p>
            <div class="list-select"></div>

            <p class="open-list">EREN STYLE услуги <i class="fas fa-chevron-down"></i></p>
            <div class="container-services">

                <?php foreach ($data_services as $service): ?>

                    <div class="service-card">
                        <i class="far fa-circle" data-service-id="<?= $service['id'] ?>">
                            <span class="name-service"><?= $service['name'] ?></span>
                            <span class="price-service"><?= $service['price'] ?></span>
                            <span class="time"><?= $service['work_time'] ?></span>
                        </i>
                    </div>

                <?php endforeach; ?>

            </div>

            <div class="date-picker">
                <label for="date">Выберите дату</label>
                <input type="date" id="date" name="date-record" min="<?= $date ?>" max="<?= $last_day ?>">
            </div>

            <div class="timing">
                <p>Выберите время</p>
                <div class="block-time">
                </div>
            </div>

            <button class="model-btn-record">Записаться</button>
        <?php } ?>
    </div>

    <div class="result-sum">
        <span>Выбрано (<span class="number">0</span>)</span>
        <span><span class="sum">0</span> Р. </span>
        <span class="selected-time">Время: <span class="result-time-show"></span></span>
    </div>
</div>

<div class="modal-cart">
    <div class="container-cart">
        <p>Корзина покупок</p>
    </div>
</div>

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
