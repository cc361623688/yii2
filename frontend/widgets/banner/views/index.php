<?php
use yii\helpers\Url;
?>
<div class="panel">
    <div id="myCarousel" class="carousel slide post-index-myCarousel">
        <!-- 轮播（Carousel）指标 -->
        <ol class="carousel-indicators">
            <?php foreach($data['items'] as $key => $item):  ?>
                <li data-target="#myCarousel" data-slide-to="<?=$key ?>" <?=isset($item['active']) && $item['active'] ? 'class="active"': ''?>></li>
            <?php endforeach;  ?>
        </ol>
        <!-- 轮播（Carousel）项目 -->
        <div class="carousel-inner">
            <?php foreach($data['items'] as $key => $item):  ?>
                <div class="item <?=isset($item['active']) && $item['active'] ? 'active': ''?>">
                    <a href="<?=Url::to($item['url']) ?>">
                        <img src="<?=Url::to($item['img_url']) ?>" alt="First slide">
                    </a>
                    <div class="carousel-caption"><?=$item['html'] ?></div>
                </div>
            <?php endforeach;  ?>
        </div>
        <!-- 轮播（Carousel）导航 -->
        <a class="carousel-control left" href="#myCarousel"
           data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#myCarousel"
           data-slide="next">&rsaquo;</a>
    </div>
</div>

