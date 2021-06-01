<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductsPropertiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Данные продукции');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-properties-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить свойство'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['label' => 'Название товара', 'value' => 'productName.name'],
            'volume',
            'amount',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{edit} {paid}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                        return Html::a('Просмотреть', ['properties/view', 'id' => $model->id]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
