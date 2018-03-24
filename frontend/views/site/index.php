<?php
use yii\base\Widget;
use frontend\widgets\banner\BannerWidget;
use frontend\widgets\post\PostWidget;
use frontend\widgets\chat\ChatWidget;
use frontend\widgets\hot\HotWidget;

$this->title = Yii::t('common','Blog').'-'.Yii::t('common','Home');
$items = [
    ['label'=>'demo1','img_url'=>'/statics/images/banner/b-1.jpg','url'=>['site/index'],'html'=>'picture1','active'=>'active'],
    ['label'=>'demo2','img_url'=>'/statics/images/banner/b-2.jpg','url'=>['site/index'],'html'=>'picture2','active'=>''],
    ['label'=>'demo3','img_url'=>'/statics/images/banner/b-3.jpg','url'=>['site/index'],'html'=>'picture3','active'=>''],
    ['label'=>'demo4','img_url'=>'/statics/images/banner/b-4.jpg','url'=>['site/index'],'html'=>'picture4','active'=>''],
    ['label'=>'demo5','img_url'=>'/statics/images/banner/b-5.jpg','url'=>['site/index'],'html'=>'picture5','active'=>''],
];
?>
<div class="row">
    <div class="col-lg-9">
        <!--    图片轮播    -->
        <?=BannerWidget::widget(
              //  ['items'=>$items]
        ); ?>

        <!--   文章列表     -->
        <?=PostWidget::widget() ?>
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
