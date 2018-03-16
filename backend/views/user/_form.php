<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput()->dropDownList([0 =>Yii::t('common','Inactive'),10=>Yii::t('common','Active')])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create') : Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
