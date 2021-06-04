<?php

use app\models\Products;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductProperties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-properties-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!Yii::$app->request->get()): ?>

        <?= $form->field($model, 'product_id')->dropDownList([
            'Выберите услугу' => ArrayHelper::map(Products::find()->
            where('products.id NOT IN (SELECT product_id FROM product_properties)')->all(), 'id', 'name'),
        ]); ?>

    <?php endif; ?>

    <?= $form->field($model, 'volume')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Сохранить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
