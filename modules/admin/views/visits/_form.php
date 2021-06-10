<?php

use app\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Visits */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visits-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList([
           'Выберите пользователя' => ArrayHelper::map(Users::find()->all(), 'id', 'FullName'),
    ]) ?>

    <?= $form->field($model, 'date_visit')->textInput()->input('datetime-local', ['min' => date('Y-m-d')."T09:00", 'max' => date('Y-m-t')."T20:00"]) ?>

    <?= $form->field($model, 'payment_amount')->textInput()->input('number') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Добавить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
