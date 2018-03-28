<?php
use frontend\widgets\post\PostWidget;
use yii\base\Widget;
use frontend\widgets\hot\HotWidget;
use frontend\widgets\chat\ChatWidget;
?>
<div class="row">
    <div class="col-lg-9">
        <?=PostWidget::widget(['limit'=>3,'page'=>true]) ?>
    </div>


    <div class="col-lg-3">
        <!--    留言板   -->
        <?=ChatWidget::widget() ?>

        <!--    热门浏览   -->
        <?=HotWidget::widget() ?>

        <!--    标签云    -->
        <?=\frontend\widgets\tag\TagWidget::widget()  ?>
    </div>

</div>

