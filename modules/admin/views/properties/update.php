<?php

use app\models\Products;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductProperties */

$this->title = Yii::t('app', 'Обновление данных товара - {name}', [
    'name' => Products::find()->select('name')->where(['id' => $model->product_id])->all()[0]['name'],
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-properties-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
