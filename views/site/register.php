<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Регистрация';
?>

<style>
    #main {
        background: #333;
    }
</style>

<div class="site-register">
    <p class="title">Регистрация</p>

    <!-- Register form -->

    <div id="message"><?= Yii::$app->session->getFlash('success-register') ?></div>

    <div class="register-form">
        <?php $form = ActiveForm::begin(['id' => 'form-register', 'enableAjaxValidation' => true]) ?>

        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'surname') ?>
        <?= $form->field($model, 'patronymic') ?>
        <?= $form->field($model, 'phone')->input('tel') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= Html::submitButton('Регистрация', ['class' => 'btn-register']) ?>

        <?php ActiveForm::end() ?>
    </div>
</div>