<?php


$this->title = Yii::t('common',$data['title']);
$this->params['breadcrumbs'][] = ['label'=>Yii::t('common','Post'),'url'=>['post/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-9">
        <div class="page-title">
            <h1><?=$data['title'] ?></h1>
            <span >作者：<?=$data['user_name'] ?></span>
            <span >发布：<?=date('Y-m-d',$data['created_at'])?></span>
            <span >作者：<?=$data['user_name'] ?>次</span>
        </div>
        <div class="page-content"><?= $data['content'] ?></div>
        <div class="page-tag">
            标签：
            <?php foreach($data['tags'] as $tag): ?>
                <span><a href="#"><?=$tag ?></a></span>
            <?php endforeach;?>
        </div>
    </div>
    <div class="col-lg-3">

    </div>
</div>
