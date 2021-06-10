<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Visits */

$this->title = 'Посещение - '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="visits-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Удалить посещение?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            ['label' => 'Имя', 'attribute' => 'client.name'],
            ['label' => 'Фамилия', 'attribute' => 'client.surname'],
            ['label' => 'Отчество', 'attribute' => 'client.patronymic'],
            'date_visit',
            'payment_amount',
        ],
    ]) ?>

</div>
