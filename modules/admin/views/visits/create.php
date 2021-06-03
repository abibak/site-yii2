<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Visits */

$this->title = Yii::t('app', 'Добавить посещение');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Visits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
