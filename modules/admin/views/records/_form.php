<?php

use app\models\Employee;
use app\models\Services;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Records */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="records-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hairdresser_id')->dropDownList([
            'Выберите сотрудника' => ArrayHelper::map(Employee::find()->all(), 'id', 'FullName'),
    ]); ?>

    <?= $form->field($model, 'service_id')->dropDownList([
            'Выберите услугу' => ArrayHelper::map(Services::find()->all(), 'id', 'name'),
    ]); ?>

    <?= $form->field($model, 'date')->textInput()->input('date', ['min' => date('Y-m-d'), 'max' => date('Y-m-t')]) ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true])->input('time', ['min' => '9:00', 'max' => '20:00']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
