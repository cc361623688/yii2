<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TagModel */

$this->title = Yii::t('common','Update').Yii::t('common','Tag').Yii::t('common','Id').' : ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' =>Yii::t('common','Tag'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="tag-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
