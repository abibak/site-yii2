<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Товары');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Добавить товар'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'label' => 'Категория',
                'value' => 'category.category_name'
            ],
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{edit}',
                'buttons' => [
                    'edit' => function ($url, $model, $key) {
                        return Html::a('Просмотреть', ['products/view/', 'id' => $model->id]);
                    }
                ],
            ],
        ],
    ]); ?>


</div>
