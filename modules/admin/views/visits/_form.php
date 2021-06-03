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
            ArrayHelper::map(Users::find()->all(), 'id', 'name'),
    ]) ?>

    <?= $form->field($model, 'date_visit')->textInput()->input('datetime-local') ?>

    <?= $form->field($model, 'payment_amount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Добавить'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
