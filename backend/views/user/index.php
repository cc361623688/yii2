<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('common','User').Yii::t('common','List');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('common','Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            // 'email_validate_token:email',
            // 'email:email',
            // 'role',
             'status'=>[
                 'label'=>Yii::t('common','Status'),
                 'attribute' => 'status',
                 'value'=> function($model){
                       return ($model->status == 10) ? Yii::t('common','Active') : Yii::t('common','Inactive');
                 },
                 'filter'=>[0 =>Yii::t('common','Inactive'),10=>Yii::t('common','Active')],
             ],
            // 'avatar',
            // 'vip_lv',
            'created_at:datetime',
            'updated_at:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
