<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductProperties */

$this->title = Yii::t('app', 'Create Product Properties');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-properties-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
