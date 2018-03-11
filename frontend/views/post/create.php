<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('common','Create');

$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Post'),'url'=>['post/index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title"><span><?php echo Yii::t('common','Create Post');?></span></div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model,'title')->textinput(['maxlength'=>true]); ?>
            <?= $form->field($model,'cat_id')->dropDownList($cats); ?>
            <?= $form->field($model,'label_img')->textinput(['maxlength'=>true]); ?>
            <?= $form->field($model,'content')->textinput(['maxlength'=>true]); ?>
            <?= $form->field($model,'tags')->textinput(['maxlength'=>true]); ?>
            <div class="form-group">
                <?=Html::submitButton(Yii::t('common','Publish'),['class'=>'btn btn-success']);?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>

    </div>
    <div class="col-lg-3">
        <div class="panel-title box-title"><span><?php echo Yii::t('common','Notice');?></span></div>
        <div class="panel-body">
            <span>1.aaaaa</span><br/>
            <span>1.bbbbb</span>

        </div>
    </div>

</div>
