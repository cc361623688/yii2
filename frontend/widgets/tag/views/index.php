<?php
use yii\helpers\Url;
?>
<div class="panel">
    <div class="panel-title box-title">
        <span><strong><?=$data['title']?></strong></span>
    </div>
    <div class="panel-body padding-left-0">
        <div class="tag-cloud">
            <?php if($data['body']):?>
            <?php foreach ($data['body'] as $list):?>
                <?php if(!isset($list['tag_name'])){  continue;  }?>
                <a href="<?=Url::to(['post/index','tag'=>$list['tag_name']])?>"><?=$list['tag_name']?></a>
            <?php endforeach;?>
            <?php endif;?>
        </div>
    </div>
</div>
