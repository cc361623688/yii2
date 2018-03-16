<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
            'title',
            'summary',
            'content:ntext',
            'label_img',
            // 'cat_id',
            // 'user_id',
            // 'user_name',
            // 'is_valid',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
