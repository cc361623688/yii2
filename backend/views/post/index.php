<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Post Models';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="post-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title'=>[
                 'attribute'=>'title',
                 'format'=>'raw',
                 'value'=>function($model){
                     return '<a href="'.Yii::$app->params['frontend']['unsecure_url'].Url::to(['post/view','id'=>$model->id]).'">'.$model->title.'</a>';
                 }
            ],
            'summary',
            //'content:ntext',
            //'label_img',
            'cat.cat_name',
            //'user_id',
            'user_name',
            'is_valid'=>[
                'attribute'=>'is_valid',
                 'value'=>function($model){
                     return ($model->is_valid ==1) ? '有效':'无效';
                 },
                 'filter'=>[0=>'无效',1=>'有效'],
            ],
            'created_at:datetime',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
