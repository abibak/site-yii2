<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Requests');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-requests-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'subject',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{edit}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                        return Html::a('Просмотреть', ['request/view/', 'id' => $model->id]);
                    }
                ],
            ],
        ],
    ]); ?>


</div>
