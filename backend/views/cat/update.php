<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CatModel */

$this->title = Yii::t('common','Update').Yii::t('common','Category').': ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Category'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="cat-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
