<?php

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Связь с администрцией';

/* @var $this yii\web\View */
/* @var $model app\models\UserRequests */
/* @var $form ActiveForm */
?>

<style>
    #main {
        background: none #333;
    }
</style>


<div class="site-contact">
    <?php $form = ActiveForm::begin(['id' => 'form-contact']); ?>

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'email')->input('email') ?>
    <?= $form->field($model, 'subject') ?>
    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- contact_admin -->
