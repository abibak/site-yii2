<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserRequests */

$this->title = Yii::t('app', 'Create User Requests');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-requests-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
