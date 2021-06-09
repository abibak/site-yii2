<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Records */

$this->title = 'Запись - ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="records-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Удалить запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Пользователь',
                'value' => Html::a('Перейти', ['/admin/users/view', 'id' => $model->client_id]),
                'format' => 'html',
            ],
            [
                'label' => 'Парикмахер',
                'value' => Html::a('Перейти', ['/admin/employees/view', 'id' => $model->hairdresser_id]),
                'format' => 'html',
            ],
            [
                'label' => 'Услуга',
                'attribute' => 'service.name'
            ],
            'date',
            'time',
        ],
    ]) ?>

</div>
