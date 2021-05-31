<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Авторизация';

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */
?>

<style>
    #main {
        background-color: #333;
    }
</style>

<!-- site-login -->
<div class="site-login">
    <p class="title">Авторизация</p>

    <div class="login-form">

        <?php $form = ActiveForm::begin(['id' => 'form-login', 'enableAjaxValidation' => true]); ?>

        <?= $form->field($model, 'phone')->input('tel') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= Html::a('Регистрация', ['/site/register'], ['class' => 'main-link']) ?>

        <?= Html::button('Авторизация', ['class' => 'btn-login']) ?>

        <?php ActiveForm::end(); ?>

    </div>

</div>
