<?php

use app\models\Services;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceTariffs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-tariffs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (!Yii::$app->request->get()): ?>

        <?= $form->field($model, 'service_id')->dropDownList([
            'Выберите услугу' => ArrayHelper::map(Services::find()->
            where('services.id NOT IN (SELECT service_id FROM service_tariffs)')->all(), 'id', 'name'),
        ]); ?>

    <?php endif; ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
