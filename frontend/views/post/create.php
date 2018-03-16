<?php
use \yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('common','Create Post');
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Post'),'url'=>['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="panel-title box-title">
            <span><?php echo Yii::t('common','Create Post');?></span>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin() ?>
              <?= $form->field($model,'title')->textinput(['maxlength'=>true])  ?>

              <?= $form->field($model,'cat_id')->dropDownList($cats)  ?>

              <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
                'config'=>[
                    //图片上传的一些配置，不写调用默认配置
                ]
              ]) ?>

              <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
                    'options'=>[
                        'initialFrameHeight' => 300,
                    ]
              ]) ?>

              <?=$form->field($model,'tags')->widget('common\widgets\tags\TagWidget')  ?>

              <div class="form-group">
                  <?=Html::submitButton(Yii::t('common','Publish'),['class'=>'btn btn-success']) ?>
              </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>


    <div class="col-lg-3"></div>
</div>
